<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class Berita extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'kategori_id',
        'penulis_id',
        'status',
        'terbit_pada',
    ];

    protected function casts(): array
    {
        return [
            'terbit_pada' => 'datetime',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('sampul')->singleFile();
    }

    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit')
            ->where(function ($q) {
                $q->whereNull('terbit_pada')->orWhere('terbit_pada', '<=', now());
            });
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(BeritaKategori::class, 'kategori_id');
    }

    public function penulis(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
