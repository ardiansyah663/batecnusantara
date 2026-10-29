<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BeritaKategori extends Model
{
    protected $table = 'berita_kategori';

    protected $fillable = [
        'nama',
        'slug',
        'urutan',
        'status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}
