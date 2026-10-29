<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class MitraFoto extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'mitra_foto';

    protected $fillable = [
        'mitra_id',
        'urutan',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')->singleFile();
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(MitraWisata::class, 'mitra_id')->withTrashed();
    }
}
