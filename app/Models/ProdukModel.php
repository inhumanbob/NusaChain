<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'Produk';
    protected $primaryKey       = 'id_produk';
    protected $allowedFields    = ['id_user', 'nama_produk', 'hs_code', 'kapasitas_bulanan', 'satuan'];
    protected $useTimestamps    = false;
}   