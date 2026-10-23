<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsorsiumModel extends Model
{
    protected $table            = 'konsorsium';
    protected $primaryKey       = 'id_konsorsium';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_konsorsium',
        'target_hs_code',
        'total_kapasitas_gabungan',
        'target_kapasitas_gabungan',
        'status_kuota',
    ];

    /**
     * Hitung ulang total dari data anggota, lalu tentukan status.
     * - Hanya menyentuh status Terbuka/Penuh (Dipesan dst. tidak ditimpa).
     * - Konsorsium tanpa anggota dihapus agar tidak ada grup kosong.
     */
    public function sinkronkan(int $idKonsorsium): bool
    {
        $k = $this->find($idKonsorsium);
        if (! $k) {
            return false;
        }

        if (! in_array($k['status_kuota'], ['Terbuka', 'Penuh'], true)) {
            return true;
        }

        $row = $this->db->table('anggota_konsorsium')
            ->select('COALESCE(SUM(kontribusi_kapasitas),0) AS total, COUNT(*) AS jumlah', false)
            ->where('id_konsorsium', $idKonsorsium)
            ->get()->getRowArray();

        $total  = (int) $row['total'];
        $jumlah = (int) $row['jumlah'];

        if ($jumlah === 0) {
            return (bool) $this->delete($idKonsorsium);
        }

        $target = (int) ($k['target_kapasitas_gabungan'] ?: 20000);

        return (bool) $this->update($idKonsorsium, [
            'total_kapasitas_gabungan' => $total,
            'status_kuota'             => $total >= $target ? 'Penuh' : 'Terbuka',
        ]);
    }

    /**
     * Daftar UMKM pengisi konsorsium untuk Buyer (tanpa email/kontak).
     */
    public function getAnggota(int $idKonsorsium): array
    {
        return $this->db->table('anggota_konsorsium a')
            ->select('u.nama, u.trust_score, a.kontribusi_kapasitas')
            ->join('users u', 'u.id_user = a.id_user')
            ->where('a.id_konsorsium', $idKonsorsium)
            ->orderBy('u.trust_score', 'DESC')
            ->get()->getResultArray();
    }
    
    /**
     * Konsorsium terbaru yang diikuti satu UMKM beserta anggotanya.
     * Mengembalikan null jika UMKM belum tergabung.
     */
    public function getDetailByUser(int $idUser): ?array
    {
        $m = $this->db->table('anggota_konsorsium')
            ->select('id_konsorsium')
            ->where('id_user', $idUser)
            ->orderBy('id_anggota', 'DESC')
            ->get()->getRowArray();

        if (! $m) {
            return null;
        }

        $konsorsium = $this->find((int) $m['id_konsorsium']);
        if (! $konsorsium) {
            return null;
        }

        $anggota = $this->db->table('anggota_konsorsium a')
            ->select('a.*, u.nama AS nama_umkm, u.email')
            ->join('users u', 'u.id_user = a.id_user')
            ->where('a.id_konsorsium', (int) $m['id_konsorsium'])
            ->get()->getResultArray();

        $target = (int) ($konsorsium['target_kapasitas_gabungan'] ?: 20000);
        $total  = (int) ($konsorsium['total_kapasitas_gabungan'] ?? 0);

        return [
            'konsorsium'     => $konsorsium,
            'anggota'        => $anggota,
            'totalAnggota'   => count($anggota),
            'targetFcl'      => $target,
            'totalKapasitas' => $total,
            // PERBAIKAN: Gunakan tanda kurang (-) untuk sisa kuota
            'sisaKuota'      => max(0, $target - $total),
            // PERBAIKAN: Gunakan tanda kali (*) untuk persentase
            'persentase'     => min(100, round(($total / $target) * 100, 1)),
        ];
    }
}