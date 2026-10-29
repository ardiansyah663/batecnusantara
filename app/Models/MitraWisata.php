<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MitraWisata extends Model
{
    use SoftDeletes;

    protected $table = 'mitra_wisata';

    protected $fillable = [
        'nama',
        'kategori',
        'alamat',
        'latitude',
        'longitude',
        'deskripsi',
        'penanggung_jawab',
        'whatsapp',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
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

    public function galeri(): HasMany
    {
        return $this->hasMany(MitraFoto::class, 'mitra_id')->orderBy('urutan');
    }

    public function destinasi(): HasMany
    {
        return $this->hasMany(PaketDestinasi::class, 'mitra_id');
    }
}
