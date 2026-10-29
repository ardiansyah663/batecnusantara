<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class PaketFoto extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'paket_foto';

    protected $fillable = [
        'paket_id',
        'urutan',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')->singleFile();
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketTour::class, 'paket_id')->withTrashed();
    }
}
