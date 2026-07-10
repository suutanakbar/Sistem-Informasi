<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    use HasFactory;

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