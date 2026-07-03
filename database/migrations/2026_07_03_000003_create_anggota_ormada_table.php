<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_ormada', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_ormada_id')->constrained('profil_ormada')->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('nim', 50);
            $table->string('program_studi');
            $table->enum('status_aktif', ['fungsionaris', 'mahasiswa_biasa', 'demisioner', 'alumni']);
            $table->string('jabatan')->nullable();
            $table->string('is_pengurus', 5)->default('TIDAK');
            $table->date('tanggal_masuk_kuliah')->nullable();
            $table->date('tanggal_lulus_kuliah')->nullable();
            $table->date('tanggal_mulai_jabatan')->nullable();
            $table->date('tanggal_akhir_jabatan')->nullable();
            $table->date('tanggal_demisioner')->nullable();
            $table->date('tanggal_lulus')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->index(['profil_ormada_id', 'status_aktif']);
            $table->index(['profil_ormada_id', 'is_pengurus']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_ormada');
    }
};
