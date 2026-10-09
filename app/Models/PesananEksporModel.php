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
        'id_user',
        'id_konsorsium',
        'total_moq',
        'tanggal_pengiriman',
        'status_pemesanan', // 'Pending', 'Diproses', 'Selesai'
        'trust_score',
    ];
}