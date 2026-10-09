<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'Users';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = ['nama', 'email', 'password', 'role', 'koordinat_lokasi', 'trust_score'];
    protected $useTimestamps    = false; // Set true jika nanti ada kolom created_at/updated_at
}