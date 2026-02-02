<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'user_id',
        'tema',
        'tanggal_pelaksanaan',
        'nama_kegiatan',
        'penanggung_jawab',
        'jumlah_peserta',
        'anggaran',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

