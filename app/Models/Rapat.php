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
        'kota_id',
        'kabupaten_id',
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
    ];

    protected $casts = [
        'tanggal' => 'date',
        'rapat_dptd' => 'boolean',
        'rapat_phdpd' => 'boolean',
        'rapat_pimpinan' => 'boolean',
        'rapat_bidang' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class);
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }
}

