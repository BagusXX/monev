<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'daerah_id',
    ];

    /**
     * Get the daerah that owns this kota
     */
    public function daerah(): BelongsTo
    {
        return $this->belongsTo(Daerah::class);
    }
}
