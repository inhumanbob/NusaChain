<?php

namespace App\Controllers;

use App\Models\PesananEksporModel;

class Admin extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Dasbor Utama Administrator
     */
    public function dashboard()
    {
        // 1. Ambil seluruh data mitra non-admin (UMKM & Buyer)
        $daftarUser = $this->db->table('users')
            ->where('role !=', 'Admin')
            ->orderBy('id_user', 'DESC')
            ->get()
            ->getResultArray();

        // 2. Ambil SEMUA kargo laut konsolidasi beserta data pembayaran Escrow
        $daftarKargo = $this->db->table('pesanan_ekspor')
            ->select('pesanan_ekspor.*, konsorsium.nama_konsorsium, konsorsium.target_hs_code')
            ->join('konsorsium', 'konsorsium.id_konsorsium = pesanan_ekspor.id_konsorsium')
            ->orderBy('pesanan_ekspor.id_pesanan', 'DESC')
            ->get()
            ->getResultArray();

        // 3. Filter entitas bisnis berdasarkan status verifikasi KYB
        $pendingUsers       = array_filter($daftarUser, fn($u) => ($u['status_verifikasi'] ?? 'Pending') === 'Pending');
        $terverifikasiUsers = array_filter($daftarUser, fn($u) => ($u['status_verifikasi'] ?? '') === 'Terverifikasi');
        $ditolakUsers       = array_filter($daftarUser, fn($u) => ($u['status_verifikasi'] ?? '') === 'Ditolak');

        // 4. Hitung kargo yang siap inspeksi (status Diproses) dan pembayaran yang butuh konfirmasi
        $kargoSiapInspeksi  = count(array_filter($daftarKargo, fn($k) => ($k['status_pemesanan'] ?? '') === 'Diproses'));
        $pembayaranPending  = count(array_filter($daftarKargo, fn($k) => ($k['status_pembayaran'] ?? '') === 'Menunggu Verifikasi'));

        $data = [
            // Data pengguna untuk tab navigasi (Pending, Terverifikasi, Ditolak)
            'daftarUser'         => $daftarUser,
            'pengajuanUsers'     => $pendingUsers,
            'listPending'        => $pendingUsers,
            'listTerverifikasi'  => $terverifikasiUsers,
            'listDitolak'        => $ditolakUsers,

            // Metrik kartu statistik
            'verifikasiPending'  => count($pendingUsers),
            'totalTerverifikasi' => count($terverifikasiUsers),
            'totalDitolak'       => count($ditolakUsers),
            'totalUmkm'          => count(array_filter($daftarUser, fn($u) => $u['role'] === 'UMKM')),
            'totalBuyer'         => count(array_filter($daftarUser, fn($u) => $u['role'] === 'Buyer')),

            // Data kargo laut (seluruh status) & metrik pembayaran
            'kargoSiapKirim'     => $kargoSiapInspeksi,
            'pembayaranPending'  => $pembayaranPending,
            'daftarKargo'        => $daftarKargo,
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Eksekusi Verifikasi Legalitas Bisnis (KYB)
     */
    public function prosesVerifikasi($idUser, $status)
    {
        $statusBaru = ucfirst(strtolower((string) $status));

        if (! in_array($statusBaru, ['Terverifikasi', 'Ditolak', 'Pending'], true)) {
            return redirect()->back()->with('error', 'Status verifikasi tidak valid.');
        }

        $this->db->table('users')
            ->where('id_user', (int) $idUser)
            ->update([
                'status_verifikasi' => $statusBaru,
            ]);

        return redirect()->back()->with(
            'success',
            "Status legalitas entitas berhasil diperbarui menjadi: {$statusBaru}."
        );
    }

    /**
     * Verifikasi Dana Rekening Bersama (Escrow) oleh Konsolidator Admin
     */
    public function verifikasiPembayaran($idPesanan)
    {
        $pesananModel = new PesananEksporModel();
        $pesanan      = $pesananModel->find((int) $idPesanan);

        if (! $pesanan) {
            return redirect()->back()->with('error', 'Data pesanan kargo tidak ditemukan.');
        }

        // Tandai status pembayaran menjadi 'Lunas' (Dana aman di rekening penampung NusaChain)
        $pesananModel->update((int) $idPesanan, [
            'status_pembayaran' => 'Lunas',
        ]);

        $noOrder = '#ORD-' . str_pad((string) $idPesanan, 4, '0', STR_PAD_LEFT);

        return redirect()->back()->with(
            'success',
            "Dana Escrow untuk kargo {$noOrder} berhasil diverifikasi dan diamankan di rekening konsolidator!"
        );
    }

    /**
     * Eksekusi Keberangkatan Kargo FCL (Otoritas Administrator Pelabuhan)
     */
    public function berangkatkanKargo($idPesanan)
    {
        $pesananModel = new PesananEksporModel();
        $pesanan      = $pesananModel->find((int) $idPesanan);

        if (! $pesanan || $pesanan['status_pemesanan'] !== 'Diproses') {
            return redirect()->back()->with('error', 'Kargo belum siap atau data tidak ditemukan.');
        }

        // Proteksi Finansial: Pastikan dana Escrow sudah lunas sebelum kargo diizinkan berlayar
        if (($pesanan['status_pembayaran'] ?? 'Belum Bayar') !== 'Lunas') {
            return redirect()->back()->with(
                'error',
                'Izin layar ditolak: Dana Escrow dari Buyer belum diverifikasi (Lunas). Pastikan pembayaran telah diterima konsolidator.'
            );
        }

        // Inspeksi lolos & dana aman, kontainer resmi berlayar
        $pesananModel->updateStatusPesanan((int) $idPesanan, 'Dikirim');

        return redirect()->back()->with(
            'success',
            'Inspeksi pelabuhan selesai dan izin layar diterbitkan! Kargo resmi diberangkatkan (Dikirim).'
        );
    }
}