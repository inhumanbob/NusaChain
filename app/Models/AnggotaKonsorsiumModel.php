<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaKonsorsiumModel extends Model
{
    protected $table            = 'anggota_konsorsium';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_konsorsium',
        'id_user',
        'kontribusi_kapasitas',
        'tanggal_bergabung',
    ];
}