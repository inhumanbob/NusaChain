<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'nama',
        'email',
        'password',
        'role',
        'nomor_izin_usaha',  // Tambahan kolom KYB
        'dokumen_legal',     // Menyimpan link Google Drive / Cloud
        'negara_asal',       // Khusus Buyer
        'pelabuhan_tujuan',  // Khusus Buyer
        'status_verifikasi', // Status verifikasi KYB (Pending/Terverifikasi/Ditolak)
        'catatan_admin',
        'koordinat_lokasi',
        'trust_score',
        'reset_token',
        'reset_expires_at',
    ];

    protected $useTimestamps    = false;

    /**
     * Fungsi untuk menambah atau mengurangi Trust Score pengguna
     * @param int $id_user ID dari pengguna
     * @param int $poin Jumlah poin (Gunakan angka minus untuk penalti, misal -20)
     */
    public function updateTrustScore($id_user, $poin)
    {
        $user = $this->find($id_user);
        
        if ($user) {
            $skorSaatIni = (int) $user['trust_score'];
            $skorBaru    = $skorSaatIni + $poin;

            if ($skorBaru < 0) {
                $skorBaru = 0;
            }

            return $this->update($id_user, [
                'trust_score' => $skorBaru
            ]);
        }
        return false;
    }
}