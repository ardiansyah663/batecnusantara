<?php

namespace App\Models\Concerns;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Media Library + konversi otomatis ke WebP untuk koleksi gambar.
 * Konversi dijalankan langsung (nonQueued) agar tidak butuh queue worker.
 */
trait HasWebpMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $koleksi = ['sampul', 'foto', 'gambar', 'logo', 'thumbnail'];

        $this->addMediaConversion('webp')
            ->fit(Fit::Max, 1600, 1600)
            ->format('webp')
            ->quality(80)
            ->performOnCollections(...$koleksi)
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->fit(Fit::Max, 400, 400)
            ->format('webp')
            ->quality(80)
            ->performOnCollections(...$koleksi)
            ->nonQueued();
    }
}
