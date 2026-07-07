<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'admin';

    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'peran',
        'terakhir_masuk',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    protected function casts(): array
    {
        return [
            'terakhir_masuk' => 'datetime',
            'kata_sandi' => 'hashed',
        ];
    }

    public function getAuthPassword(): string
    {
        return $this->kata_sandi;
    }

    public function getAuthPasswordName(): string
    {
        return 'kata_sandi';
    }

    public function profilOrmada(): HasOne
    {
        return $this->hasOne(ProfilOrmada::class);
    }

    public function profilOrmadas(): HasMany
    {
        return $this->hasMany(ProfilOrmada::class);
    }

    public function isAdmin(): bool
    {
        return $this->peran === 'admin';
    }

    public function isPemda(): bool
    {
        return $this->peran === 'pemda';
    }

    public function isPengurusOrmada(): bool
    {
        return $this->peran === 'pengurus_ormada';
    }
}
