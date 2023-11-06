<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user', 'pass', 'nama', 'role'];
    // protected $useTimestamps = true;
}
