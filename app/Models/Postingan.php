<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postingan extends Model
{
    use HasFactory;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'postingan';

    protected $fillable = [
        'admin_id',
        'judul',
        'isi_konten',
        'foto',
        'jenis_konten',
        'is_published',
        'tanggal_publish',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publish' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    // Relasi ke Admin (pembuat postingan)
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    // Scope untuk postingan yang sudah dipublish
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('tanggal_publish')
            ->orderByDesc('tanggal_publish');
    }

    // Scope untuk filter by jenis konten
    public function scopeByJenis($query, ?string $jenis)
    {
        return $query->when($jenis, function ($query, $jenis) {
            return $query->where('jenis_konten', $jenis);
        });
    }
}