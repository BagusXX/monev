<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kota_id',
        'kabupaten_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kota(): BelongsTo
    {
        return $this->belongsTo(Kota::class);
    }

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function getWilayahLabelAttribute(): string
    {
        if ($this->relationLoaded('kota') && $this->kota) {
            return 'Kota '.$this->kota->nama;
        }
        if ($this->relationLoaded('kabupaten') && $this->kabupaten) {
            return 'Kabupaten '.$this->kabupaten->nama;
        }

        // fallback tanpa eager load
        if ($this->kota_id && $this->kota) {
            return 'Kota '.$this->kota->nama;
        }
        if ($this->kabupaten_id && $this->kabupaten) {
            return 'Kabupaten '.$this->kabupaten->nama;
        }

        return '-';
    }
}
