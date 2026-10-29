<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class MediaBudaya extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'media_budaya';

    protected $fillable = [
        'konten_budaya_id',
        'tipe',
        'youtube_url',
        'ukuran_kb',
        'caption',
        'urutan',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->singleFile();
    }

    public function konten(): BelongsTo
    {
        return $this->belongsTo(KontenBudaya::class, 'konten_budaya_id');
    }
}
