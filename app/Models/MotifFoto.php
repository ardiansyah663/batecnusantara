<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class MotifFoto extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'motif_foto';

    protected $fillable = [
        'motif_id',
        'caption',
        'urutan',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')->singleFile();
    }

    public function motif(): BelongsTo
    {
        return $this->belongsTo(MotifTenun::class, 'motif_id');
    }
}
