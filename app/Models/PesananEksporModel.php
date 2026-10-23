<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananEksporModel extends Model
{
    protected $table            = 'pesanan_ekspor';
    protected $primaryKey       = 'id_pesanan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'id_user',              // ID Buyer pemesan
        'id_konsorsium',
        'total_moq',
        'total_tagihan',        // Tambahan: Nominal tagihan kargo FCL (Rp)
        'tanggal_pengiriman',
        'status_pemesanan',     // 'Pending', 'Diproses', 'Dikirim', 'Selesai'
        'status_pembayaran',    // Tambahan: 'Belum Bayar', 'Menunggu Verifikasi', 'Lunas'
        'bukti_bayar',          // Tambahan: Tautan Google Drive / Cloud bukti transfer
    ];

    /**
     * Riwayat pesanan milik satu Buyer beserta info konsorsiumnya.
     */
    public function getByBuyer(int $idUser): array
    {
        return $this->select('pesanan_ekspor.*, konsorsium.nama_konsorsium, konsorsium.target_hs_code')
            ->join('konsorsium', 'konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium')
            ->where('pesanan_ekspor.id_user', $idUser)
            ->orderBy('pesanan_ekspor.id_pesanan', 'DESC')
            ->findAll();
    }

    /**
     * Mengambil semua pesanan dari konsorsium
     * yang diikuti oleh UMKM.
     */
    public function getByUmkm(int $idUser): array
    {
        return $this->select('pesanan_ekspor.*, konsorsium.nama_konsorsium')
            ->join('konsorsium', 'konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium')
            ->join('anggota_konsorsium', 'anggota_konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium')
            ->where('anggota_konsorsium.id_user', $idUser)
            ->distinct()
            ->orderBy('pesanan_ekspor.id_pesanan', 'DESC')
            ->findAll();
    }

    /**
     * Memperbarui status pesanan dan otomatis mendongkrak Trust Score UMKM 
     * yang terlibat di dalam konsorsium jika pesanan berstatus 'Selesai'.
     */
    public function updateStatusPesanan(int $idPesanan, string $statusBaru): bool
    {
        $pesanan = $this->find($idPesanan);
        if (! $pesanan) {
            return false;
        }

        $statusLama = $pesanan['status_pemesanan'];
        
        // Update status pesanan
        $updated = $this->update($idPesanan, ['status_pemesanan' => $statusBaru]);

        if ($updated && strtolower($statusBaru) === 'selesai' && strtolower($statusLama) !== 'selesai') {
            $idKonsorsium = $pesanan['id_konsorsium'];

            // Ambil semua ID UMKM (user) yang tergabung dalam konsorsium ini
            $db = \Config\Database::connect();
            $anggota = $db->table('anggota_konsorsium')
                ->select('id_user')
                ->where('id_konsorsium', $idKonsorsium)
                ->get()
                ->getResultArray();

            // Tambahkan Trust Score (+5 poin per ekspor FCL yang sukses)
            $userModel = new \App\Models\UserModel();
            foreach ($anggota as $member) {
                $idUmkm = (int) $member['id_user'];
                $user   = $userModel->find($idUmkm);
                
                if ($user) {
                    $skorSekarang = (int) ($user['trust_score'] ?? 50);
                    $skorBaru     = min(100, $skorSekarang + 5); 
                    
                    $userModel->update($idUmkm, ['trust_score' => $skorBaru]);
                }
            }
        }

        return $updated;
    }

    /**
     * Helper praktis untuk memperbarui data pembayaran Escrow
     */
    public function updatePembayaran(int $idPesanan, string $statusBayar, ?string $buktiBayar = null): bool
    {
        $data = ['status_pembayaran' => $statusBayar];
        if ($buktiBayar !== null) {
            $data['bukti_bayar'] = $buktiBayar;
        }

        return $this->update($idPesanan, $data);
    }
}