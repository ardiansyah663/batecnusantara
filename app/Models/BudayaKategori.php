<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudayaKategori extends Model
{
    protected $table = 'budaya_kategori';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'urutan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
        ];
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function konten(): HasMany
    {
        return $this->hasMany(KontenBudaya::class, 'kategori_id');
    }
}
