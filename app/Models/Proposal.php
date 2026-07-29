<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use HasFactory, SoftDeletes;

    public const CREATED_AT = 'dibuat_pada';
    public const UPDATED_AT = 'diperbarui_pada';

    protected $table = 'proposal';

    protected $fillable = [
        'admin_id',
        'dinas_tujuan_id',
        'judul_kegiatan',
        'deskripsi_kegiatan',
        'jenis_bantuan',
        'anggaran_dibutuhkan',
        'file_proposal',
        'status',
        'catatan_pemda',
    ];

    protected function casts(): array
    {
        return [
            'anggaran_dibutuhkan' => 'integer',
        ];
    }

    // State machine untuk proposal
    public const STATUS_DIAJUKAN = 'diajukan';
    public const STATUS_DIPROSES_PEMDA = 'diproses_pemda';
    public const STATUS_DANA_CAIR = 'dana_cair';
    public const STATUS_DITOLAK = 'ditolak';

    public const ALLOWED_TRANSITIONS = [
        self::STATUS_DIAJUKAN => [self::STATUS_DIPROSES_PEMDA, self::STATUS_DITOLAK],
        self::STATUS_DIPROSES_PEMDA => [self::STATUS_DANA_CAIR, self::STATUS_DITOLAK],
    ];

    public function canTransitionTo(string $newStatus): bool
    {
        $currentStatus = $this->status;
        
        // Final states cannot be changed
        if (in_array($currentStatus, [self::STATUS_DANA_CAIR, self::STATUS_DITOLAK])) {
            return false;
        }
        
        // Check if transition is allowed
        if (!isset(self::ALLOWED_TRANSITIONS[$currentStatus])) {
            return false;
        }
        
        return in_array($newStatus, self::ALLOWED_TRANSITIONS[$currentStatus]);
    }

    public function pengaju(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function dinasTujuan(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'dinas_tujuan_id');
    }

    public function scopeFilter(Builder $query, ?string $status, ?string $jenisBantuan): Builder
    {
        return $query->when($status, fn (Builder $query, string $status): Builder => $query->where('status', $status))
            ->when($jenisBantuan, fn (Builder $query, string $jenisBantuan): Builder => $query->where('jenis_bantuan', $jenisBantuan));
    }
}