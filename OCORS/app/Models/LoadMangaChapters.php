<?php

namespace App\Models;

use CodeIgniter\Model;

class LoadMangaChapters extends Model
{
    protected $table = 'mangaChapters';
    protected $primaryKey = 'id';

    protected $allowedFields = ['mangaId','chapters','readCount'];
}