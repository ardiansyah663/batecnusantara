<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotifikasiMitra extends Model
{
    protected $table = 'notifikasi_mitra';

    protected $fillable = [
        'pesanan_id',
        'mitra_id',
        'status_kirim',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(PesananTour::class, 'pesanan_id');
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(MitraWisata::class, 'mitra_id')->withTrashed();
    }
}
