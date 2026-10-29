<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class Video extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'video';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'kategori_id',
        'sumber',
        'youtube_url',
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
        $this->addMediaCollection('thumbnail')->singleFile();
        $this->addMediaCollection('berkas')->singleFile();
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
        return $this->belongsTo(VideoKategori::class, 'kategori_id');
    }
}
