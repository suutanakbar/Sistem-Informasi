<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('proposal')) {
            return;
        }

        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
            $table->foreignId('dinas_tujuan_id')->constrained('admin')->cascadeOnDelete();
            $table->string('judul_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->enum('jenis_bantuan', ['dana', 'izin', 'tempat', 'fasilitas']);
            $table->unsignedInteger('anggaran_dibutuhkan')->default(0);
            $table->string('file_proposal');
            $table->enum('status', ['diajukan', 'diproses_pemda', 'dana_cair', 'ditolak'])->default('diajukan');
            $table->text('catatan_pemda')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->index(['admin_id', 'status']);
            $table->index(['dinas_tujuan_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};