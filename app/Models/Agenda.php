<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agenda extends Model
{
    use HasFactory;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'agenda';

    protected $fillable = [
        'admin_id',
        'nama_agenda',
        'deskripsi_agenda',
        'gambar_poster',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'kategori',
        'kuota_volunteer',
        'deadline_pendaftaran',
        'is_published',
        'tanggal_publish',
    ];

    protected function casts(): array
    {
        return [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
            'deadline_pendaftaran' => 'datetime',
            'tanggal_publish' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    // Relasi ke Admin (pembuat agenda)
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    // Relasi ke Volunteer pendaftar
    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class, 'agenda_id');
    }

    // Scope untuk agenda yang sudah dipublish
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('tanggal_publish')
            ->orderByDesc('waktu_mulai');
    }

    // Scope untuk agenda yang akan datang
    public function scopeUpcoming($query)
    {
        return $query->where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai');
    }

    // Scope untuk agenda yang membuka volunteer
    public function scopeOpenVolunteer($query)
    {
        return $query->whereNotNull('kuota_volunteer')
            ->where('deadline_pendaftaran', '>=', now())
            ->where('is_published', true);
    }

    // Scope untuk filter by kategori
    public function scopeByKategori($query, ?string $kategori)
    {
        return $query->when($kategori, function ($query, $kategori) {
            return $query->where('kategori', $kategori);
        });
    }
}