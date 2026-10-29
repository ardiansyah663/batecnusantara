<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    protected $table = 'halaman';

    protected $fillable = [
        'kunci',
        'judul',
        'isi',
        'meta_deskripsi',
    ];
}
