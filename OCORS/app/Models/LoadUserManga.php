<?php

namespace App\Models;

use CodeIgniter\Model;

class LoadUserManga extends Model
{
    protected $table = 'userManga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['userId','mangaId'];
}