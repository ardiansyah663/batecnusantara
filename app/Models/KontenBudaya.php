<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;

class KontenBudaya extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'konten_budaya';

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'deskripsi',
        'status',
        'unggulan',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'unggulan' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('sampul')->singleFile();
    }

    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit');
    }

    public function scopeUnggulan($query)
    {
        return $query->where('unggulan', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(BudayaKategori::class, 'kategori_id');
    }

    public function narasumber(): BelongsToMany
    {
        return $this->belongsToMany(Narasumber::class, 'konten_narasumber', 'konten_budaya_id', 'narasumber_id')
            ->withPivot('urutan')
            ->orderByPivot('urutan');
    }

    /** Daftar item media (foto/audio/video/YouTube). Bukan media() milik Spatie. */
    public function daftarMedia(): HasMany
    {
        return $this->hasMany(MediaBudaya::class, 'konten_budaya_id')->orderBy('urutan');
    }

    public function linimasa(): HasMany
    {
        return $this->hasMany(LinimasaRitual::class, 'konten_budaya_id')->orderBy('urutan');
    }
}
