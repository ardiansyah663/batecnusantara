<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'kunci',
        'nilai',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('pengaturan.semua'));
        static::deleted(fn () => Cache::forget('pengaturan.semua'));
    }

    /** Ambil satu nilai pengaturan (di-cache). */
    public static function ambil(string $kunci, mixed $default = null): mixed
    {
        $semua = Cache::rememberForever(
            'pengaturan.semua',
            fn () => static::query()->pluck('nilai', 'kunci')->all()
        );

        $nilai = $semua[$kunci] ?? null;

        return ($nilai === null || $nilai === '') ? $default : $nilai;
    }

    /** Ambil nilai yang disimpan sebagai JSON (mis. tautan footer). */
    public static function ambilJson(string $kunci, array $default = []): array
    {
        $nilai = static::ambil($kunci);

        if (! is_string($nilai)) {
            return $default;
        }

        $hasil = json_decode($nilai, true);

        return is_array($hasil) ? $hasil : $default;
    }

    /** Simpan nilai; array otomatis dijadikan JSON. */
    public static function simpan(string $kunci, mixed $nilai): void
    {
        static::query()->updateOrCreate(
            ['kunci' => $kunci],
            ['nilai' => is_array($nilai) ? json_encode($nilai, JSON_UNESCAPED_UNICODE) : $nilai]
        );
    }
}
