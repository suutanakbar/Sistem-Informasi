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
        'nik',
        'nim',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'golongan_darah',
        'program_studi',
        'fakultas',
        'prodi',
        'angkatan',
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
        'alamat',
        'email',
        'cv_path',
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
            'tanggal_lahir' => 'date',
        ];
    }

    public function profilOrmada(): BelongsTo
    {
        return $this->belongsTo(ProfilOrmada::class);
    }

    public function getStatusAktifLabelAttribute(): string
    {
        $status = $this->status_aktif;

        if (! $status) {
            if ($this->tanggal_lulus_kuliah) {
                return 'Lulus';
            }

            return $this->is_pengurus === 'YA' ? 'Fungsionaris' : 'Mahasiswa';
        }

        return match ($status) {
            'alumni' => 'Lulus',
            'mahasiswa' => 'Mahasiswa',
            'fungsionaris' => 'Fungsionaris',
            default => ucfirst(str_replace('_', ' ', $status)),
        };
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
