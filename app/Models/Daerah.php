<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Daerah extends Model
{
    protected $table = 'daerahs';

    protected $fillable = [
        'kode',
        'nama',
    ];

    /**
     * Get all kotas in this daerah
     */
    public function kotas(): HasMany
    {
        return $this->hasMany(Kota::class);
    }

    /**
     * Get all kabupatens in this daerah
     */
    public function kabupatens(): HasMany
    {
        return $this->hasMany(Kabupaten::class);
    }
}
