<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PesananTour extends Model
{
    protected $table = 'pesanan_tour';

    protected $fillable = [
        'paket_id',
        'kode_pesanan',
        'nama_wisatawan',
        'whatsapp',
        'tanggal_tour',
        'catatan',
        'harga_saat_pesan',
        'persetujuan_pada',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_tour' => 'date',
            'harga_saat_pesan' => 'integer',
            'persetujuan_pada' => 'datetime',
        ];
    }

    public const STATUS = ['pending', 'approved', 'cancelled', 'completed'];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketTour::class, 'paket_id')->withTrashed();
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(NotifikasiMitra::class, 'pesanan_id');
    }
}
