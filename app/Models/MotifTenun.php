<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;

class MotifTenun extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'motif_tenun';

    protected $fillable = [
        'nama_motif',
        'slug',
        'deskripsi',
        'filosofi',
        'narasumber_id',
        'link_marketplace',
        'status',
        'unggulan',
    ];

    protected function casts(): array
    {
        return [
            'unggulan' => 'boolean',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gambar')->singleFile();
    }

    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit');
    }

    public function scopeUnggulan($query)
    {
        return $query->where('unggulan', true);
    }

    public function narasumber(): BelongsTo
    {
        return $this->belongsTo(Narasumber::class, 'narasumber_id');
    }

    public function galeri(): HasMany
    {
        return $this->hasMany(MotifFoto::class, 'motif_id')->orderBy('urutan');
    }
}
