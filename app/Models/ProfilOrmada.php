<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilOrmada extends Model
{
    use HasFactory, SoftDeletes;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'profil_ormada';

    protected $fillable = [
        'admin_id',
        'nama_universitas',
        'alamat_universitas',
        'total_mahasiswa_univ',
        'logo',
        'deskripsi',
    ];

    protected function casts(): array
    {
        return [
            'total_mahasiswa_univ' => 'integer',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function anggota(): HasMany
    {
        return $this->hasMany(AnggotaOrmada::class);
    }
}
