<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;

class PaketTour extends Model implements HasMedia
{
    use SoftDeletes, HasWebpMedia;

    protected $table = 'paket_tour';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'harga',
        'durasi',
        'status',
        'unggulan',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'integer',
            'unggulan' => 'boolean',
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

    public function galeri(): HasMany
    {
        return $this->hasMany(PaketFoto::class, 'paket_id')->orderBy('urutan');
    }

    public function destinasi(): HasMany
    {
        return $this->hasMany(PaketDestinasi::class, 'paket_id')->orderBy('urutan');
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(PesananTour::class, 'paket_id');
    }
}
