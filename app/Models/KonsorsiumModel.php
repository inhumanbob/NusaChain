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
        'status_kuota', // 'Terbuka', 'Penuh'
    ];
}