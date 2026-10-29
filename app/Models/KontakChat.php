<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakChat extends Model
{
    protected $table = 'kontak_chat';

    protected $fillable = [
        'label',
        'nomor_wa',
        'keterangan',
        'jam_layanan',
        'urutan',
        'status',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    /** Tautan WhatsApp (wa.me) dengan pesan awal. */
    public function tautanWa(?string $pesan = null): string
    {
        $nomor = preg_replace('/\D+/', '', (string) $this->nomor_wa);

        if (str_starts_with($nomor, '0')) {
            $nomor = '62'.substr($nomor, 1);
        }

        $url = 'https://wa.me/'.$nomor;

        return $pesan ? $url.'?text='.rawurlencode($pesan) : $url;
    }
}
