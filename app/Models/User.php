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
        'daerah_id',
        'is_approved',
        'is_main_admin',
        'is_rejected',
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
            'is_approved' => 'boolean',
            'is_main_admin' => 'boolean',
            'is_rejected' => 'boolean',
        ];
    }

    public function daerah(): BelongsTo
    {
        return $this->belongsTo(Daerah::class);
    }

    public function getDaerahLabelAttribute(): string
    {
        if ($this->relationLoaded('daerah') && $this->daerah) {
            return $this->daerah->nama . ' - ' . $this->daerah->kode;
        }

        // fallback tanpa eager load
        if ($this->daerah_id && $this->daerah) {
            return $this->daerah->nama . ' - ' . $this->daerah->kode;
        }

        if ($this->is_main_admin) {
            return 'Admin Utama';
        }

        return '-';
    }
}
