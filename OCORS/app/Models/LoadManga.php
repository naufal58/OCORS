<?php

namespace App\Models;

use CodeIgniter\Model;

class LoadManga extends Model
{
    protected $table = 'manga';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama','harga','deskripsi','genre','visited','coverImage'];
    
}