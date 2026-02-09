<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rapat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pengisi_nama',
        'daerah_id',
        'bulan',
        'tanggal',
        'waktu',
        'rapat_dptd',
        'uraian_dptd',
        'rapat_phdpd',
        'uraian_phdpd',
        'rapat_pimpinan',
        'uraian_pimpinan',
        'rapat_bidang',
        'uraian_bidang',
        'rapat_kpd',
        'uraian_kpd',
        'rapat_dewan',
        'uraian_dewan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'rapat_dptd' => 'boolean',
        'rapat_phdpd' => 'boolean',
        'rapat_pimpinan' => 'boolean',
        'rapat_bidang' => 'boolean',
        'rapat_kpd' => 'boolean',
        'rapat_dewan' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daerah(): BelongsTo
    {
        return $this->belongsTo(Daerah::class);
    }
}

