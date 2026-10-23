<?php

namespace App\Libraries;

use App\Models\AnggotaKonsorsiumModel;
use App\Models\KonsorsiumModel;

/**
 * "Sistem_Engine" pada Class Diagram.
 * Tahap: (1) konversi ke kg -> (2) cek ekspor mandiri ->
 * (3) cari grup HS Code sama yang sisa kuotanya cukup -> (4) gabung / buat baru.
 */
class MatchmakingService
{
    public const TARGET_KG = 20000;

    protected $db;
    protected KonsorsiumModel $konsorsiumModel;
    protected AnggotaKonsorsiumModel $anggotaModel;

    public function __construct()
    {
        $this->db              = \Config\Database::connect();
        $this->konsorsiumModel = new KonsorsiumModel();
        $this->anggotaModel    = new AnggotaKonsorsiumModel();
    }

    public static function keKg(int $kapasitas, string $satuan): int
    {
        // Perbaikan: Penulisan logika perkalian yang benar
        return strtolower($satuan) === 'ton' ? $kapasitas * 1000 : $kapasitas;
    }

    /** WAJIB dipanggil di dalam transaksi milik pemanggil (memakai FOR UPDATE). */
    public function tempatkan(array $produk): array
    {
        $kontribusi = self::keKg((int) $produk['kapasitas_bulanan'], (string) $produk['satuan']);

        // Kapasitas sudah cukup satu kontainer: tidak perlu konsorsium
        if ($kontribusi >= self::TARGET_KG) {
            return [
                'ok'      => true,
                'pesan'   => 'Produk tersimpan. Kapasitas Anda sudah mencukupi satu kontainer, sehingga tidak perlu bergabung ke konsorsium.',
            ];
        }

        // Cari grup Terbuka, HS Code sama, sisa kuota cukup (baris dikunci)
        $grup = $this->db->query(
            "SELECT id_konsorsium FROM konsorsium
             WHERE target_hs_code = ? AND status_kuota = 'Terbuka'
               AND target_kapasitas_gabungan >= COALESCE(total_kapasitas_gabungan, 0) + ?
             ORDER BY id_konsorsium ASC LIMIT 1 FOR UPDATE",
            [$produk['hs_code'], $kontribusi]
        )->getRowArray();

        if ($grup) {
            $idKonsorsium = (int) $grup['id_konsorsium'];
            $pesan = 'Produk tersimpan dan digabungkan ke konsorsium yang sudah ada.';
        } else {
            // INSERT AWAL UNTUK MENDAPATKAN ID BARU
            $idKonsorsium = (int) $this->konsorsiumModel->insert([
                'nama_konsorsium'           => 'Menyiapkan Konsorsium...',
                'target_hs_code'            => $produk['hs_code'],
                'total_kapasitas_gabungan'  => 0,
                'target_kapasitas_gabungan' => self::TARGET_KG,
                'status_kuota'              => 'Terbuka',
            ]);

            if ($idKonsorsium <= 0) {
                return ['ok' => false, 'pesan' => 'Gagal membuat konsorsium baru.'];
            }

            // GENERATE NAMA OTOMATIS BERDASARKAN HS CODE DAN ID BATCH
            $tanggal = date('Ymd');
            $namaOtomatis = "Konsorsium Ekspor HS-{$produk['hs_code']} (Batch {$tanggal}-{$idKonsorsium})";

            // UPDATE KONSORSIUM DENGAN NAMA RESMI
            $this->konsorsiumModel->update($idKonsorsium, [
                'nama_konsorsium' => $namaOtomatis,
            ]);
            
            $pesan = 'Produk tersimpan dan konsorsium baru berhasil dibuat.';
        }

        $ok = $this->anggotaModel->insert([
            'id_konsorsium'        => $idKonsorsium,
            'id_user'              => (int) $produk['id_user'],
            'id_produk'            => (int) $produk['id_produk'],
            'kontribusi_kapasitas' => $kontribusi,
            'tanggal_bergabung'    => date('Y-m-d'),
        ]);

        if ($ok === false) {
            return ['ok' => false, 'pesan' => 'Gagal menambahkan produk ke konsorsium.'];
        }

        $this->konsorsiumModel->sinkronkan($idKonsorsium);

        return ['ok' => true, 'pesan' => $pesan, 'id_konsorsium' => $idKonsorsium];
    }
}