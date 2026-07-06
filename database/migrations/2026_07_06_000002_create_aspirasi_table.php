<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('aspirasi')) {
            return;
        }

        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_ormada_id')->constrained('profil_ormada')->cascadeOnDelete();
            $table->string('topik_aspirasi');
            $table->text('detail_aspirasi');
            $table->string('file')->nullable(); // File pendukung aspirasi
            $table->text('tanggapan_pemda')->nullable(); // Tanggapan dari Pemda
            $table->timestamp('tanggal_tanggapan')->nullable(); // Kapan ditanggapi
            $table->enum('status', ['belum_ditanggapi', 'sedang_diproses', 'selesai', 'ditolak'])->default('belum_ditanggapi');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->index('profil_ormada_id');
            $table->index('status');
            $table->index('tanggal_tanggapan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};