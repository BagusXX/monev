<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KegiatanPhoto extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_photos';

    protected $fillable = [
        'kegiatan_id',
        'foto_path',
    ];

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
