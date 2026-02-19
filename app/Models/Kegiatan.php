<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'user_id',
        'tema',
        'bidang',
        'tanggal_pelaksanaan',
        'nama_kegiatan',
        'pelaksana',
        'jumlah_peserta',
        'anggaran',
        'foto',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(KegiatanPhoto::class);
    }
}

