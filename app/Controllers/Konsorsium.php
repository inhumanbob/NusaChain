<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KonsorsiumModel;
use App\Models\AnggotaKonsorsiumModel;

class Konsorsium extends BaseController
{
    protected $konsorsiumModel;
    protected $anggotaModel;
    const TARGET_FCL = 10000; // Target volume 1 kontainer penuh

    public function __construct()
    {
        $this->konsorsiumModel = new KonsorsiumModel();
        $this->anggotaModel    = new AnggotaKonsorsiumModel();
    }

    public function dashboard($idKonsorsium)
    {
        $konsorsium = $this->konsorsiumModel->find($idKonsorsium);

        if (!$konsorsium) {
            return redirect()->to('/umkm/dashboard')->with('error', 'Konsorsium tidak ditemukan.');
        }

        // Ambil daftar anggota beserta nama UMKM-nya
        $db = \Config\Database::connect();
        $anggota = $db->table('anggota_konsorsium')
            ->select('anggota_konsorsium.*, users.nama as nama_umkm, users.email')
            ->join('users', 'users.id_user = anggota_konsorsium.id_user')
            ->where('anggota_konsorsium.id_konsorsium', $idKonsorsium)
            ->get()
            ->getResultArray();

        // Kalkulasi keterisian kontainer
        $totalKapasitas = (int) $konsorsium['total_kapasitas_gabungan'];
        $persentase     = min(100, round(($totalKapasitas / self::TARGET_FCL) * 100, 1));
        $sisaKuota      = max(0, self::TARGET_FCL - $totalKapasitas);

        $data = [
            'konsorsium'     => $konsorsium,
            'anggota'        => $anggota,
            'totalAnggota'   => count($anggota),
            'targetFcl'      => self::TARGET_FCL,
            'totalKapasitas' => $totalKapasitas,
            'persentase'     => $persentase,
            'sisaKuota'      => $sisaKuota,
        ];

        return view('umkm/dashboard_grup', $data);
    }
}