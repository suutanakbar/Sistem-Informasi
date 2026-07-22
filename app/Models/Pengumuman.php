<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    use HasFactory;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'foto',
        'file',
        'tanggal_publish',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publish' => 'date',
        ];
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'dibuat_oleh');
    }

    public function scopePublik(Builder $query): Builder
    {
        return $query->orderByDesc('tanggal_publish')->orderByDesc('dibuat_pada');
    }
}