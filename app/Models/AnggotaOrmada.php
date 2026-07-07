<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggotaOrmada extends Model
{
    use HasFactory;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'anggota_ormada';

    protected $fillable = [
        'profil_ormada_id',
        'nama_lengkap',
        'nim',
        'program_studi',
        'status_aktif',
        'jabatan',
        'is_pengurus',
        'tanggal_masuk_kuliah',
        'tanggal_lulus_kuliah',
        'tanggal_mulai_jabatan',
        'tanggal_akhir_jabatan',
        'tanggal_demisioner',
        'tanggal_lulus',
        'no_hp',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_masuk_kuliah' => 'date',
            'tanggal_lulus_kuliah' => 'date',
            'tanggal_mulai_jabatan' => 'date',
            'tanggal_akhir_jabatan' => 'date',
            'tanggal_demisioner' => 'date',
            'tanggal_lulus' => 'date',
        ];
    }

    public function profilOrmada(): BelongsTo
    {
        return $this->belongsTo(ProfilOrmada::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function (Builder $query, string $search): void {
            $query->where(function (Builder $query) use ($search): void {
                $query
                    ->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        });
    }
}
