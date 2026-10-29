<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;

class Narasumber extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'narasumber';

    protected $fillable = [
        'nama',
        'peran',
        'bio',
        'kontak',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')->singleFile();
    }

    public function konten(): BelongsToMany
    {
        return $this->belongsToMany(KontenBudaya::class, 'konten_narasumber', 'narasumber_id', 'konten_budaya_id')
            ->withPivot('urutan');
    }

    public function motif(): HasMany
    {
        return $this->hasMany(MotifTenun::class, 'narasumber_id');
    }

    /** Masih dipakai di konten budaya atau motif tenun? (untuk blokir hapus) */
    public function masihDipakai(): bool
    {
        return $this->konten()->exists() || $this->motif()->exists();
    }
}
