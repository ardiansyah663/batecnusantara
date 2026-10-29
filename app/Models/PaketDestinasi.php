<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;

class PaketDestinasi extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'paket_destinasi';

    protected $fillable = [
        'paket_id',
        'mitra_id',
        'urutan',
        'judul_kunjungan',
        'deskripsi_kunjungan',
        'jam_mulai',
        'jam_selesai',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')->singleFile();
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketTour::class, 'paket_id')->withTrashed();
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(MitraWisata::class, 'mitra_id')->withTrashed();
    }
}
