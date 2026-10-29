<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinimasaRitual extends Model
{
    protected $table = 'linimasa_ritual';

    protected $fillable = [
        'konten_budaya_id',
        'urutan',
        'judul_tahap',
        'deskripsi',
        'waktu_estimasi',
    ];

    public function konten(): BelongsTo
    {
        return $this->belongsTo(KontenBudaya::class, 'konten_budaya_id');
    }
}
