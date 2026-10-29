<?php

namespace App\Models;

use App\Models\Concerns\HasWebpMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Tokoh extends Model implements HasMedia
{
    use HasWebpMedia;

    protected $table = 'tokoh';

    protected $fillable = [
        'nama',
        'jabatan',
        'ucapan',
        'urutan',
        'status',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto')->singleFile();
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }
}
