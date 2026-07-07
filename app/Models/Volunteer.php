<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Volunteer extends Model
{
    use HasFactory;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'volunteers';

    protected $fillable = [
        'agenda_id',
        'nama',
        'email',
        'no_hp',
        'alasan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }

    // Relasi ke Agenda
    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
    }

    // Scope untuk filter by status
    public function scopeByStatus($query, ?string $status)
    {
        return $query->when($status, function ($query, $status) {
            return $query->where('status', $status);
        });
    }
}