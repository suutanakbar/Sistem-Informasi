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
        'catatan_penolakan',
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

    // State machine untuk volunteer
    public const STATUS_PENDING = 'pending';
    public const STATUS_DITERIMA = 'diterima';
    public const STATUS_DITOLAK = 'ditolak';

    public const ALLOWED_TRANSITIONS = [
        self::STATUS_PENDING => [self::STATUS_DITERIMA, self::STATUS_DITOLAK],
        self::STATUS_DITERIMA => [self::STATUS_DITOLAK, self::STATUS_PENDING],
        self::STATUS_DITOLAK => [self::STATUS_DITERIMA, self::STATUS_PENDING],
    ];

    public function canTransitionTo(string $newStatus): bool
    {
        $currentStatus = $this->status;
        
        // Check if transition is allowed
        if (!isset(self::ALLOWED_TRANSITIONS[$currentStatus])) {
            return false;
        }
        
        return in_array($newStatus, self::ALLOWED_TRANSITIONS[$currentStatus]);
    }
}