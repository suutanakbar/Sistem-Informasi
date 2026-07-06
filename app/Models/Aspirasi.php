<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'aspirasi';

    protected $fillable = [
        'profil_ormada_id',
        'topik_aspirasi',
        'detail_aspirasi',
        'file',
        'tanggapan_pemda',
        'tanggal_tanggapan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_tanggapan' => 'datetime',
        ];
    }

    // Relasi ke Profil Ormada
    public function profilOrmada(): BelongsTo
    {
        return $this->belongsTo(ProfilOrmada::class);
    }

    // Relasi ke Admin (pengaju) melalui profil ormada
    public function pengaju(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id')->through('profilOrmada');
    }

    // Scope untuk aspirasi publik (SEMUA aspirasi untuk transparansi)
    public function scopePublik(Builder $query): Builder
    {
        return $query->with('profilOrmada')
            ->orderByDesc('dibuat_pada');
    }

    // Scope untuk filter by status
    public function scopeByStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, fn (Builder $query, string $status) => $query->where('status', $status));
    }
}