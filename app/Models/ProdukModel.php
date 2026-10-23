<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_user', 'nama_produk', 'hs_code', 'kapasitas_bulanan', 'satuan'];
    protected $useTimestamps    = false;
}