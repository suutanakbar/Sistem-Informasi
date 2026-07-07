<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('agenda')) {
            return;
        }

        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
            $table->string('nama_agenda');
            $table->text('deskripsi_agenda');
            $table->string('gambar_poster')->nullable(); // Poster agenda
            $table->dateTime('waktu_mulai'); // Waktu mulai agenda
            $table->dateTime('waktu_selesai'); // Waktu selesai agenda
            $table->string('tempat'); // Lokasi pelaksanaan
            $table->enum('kategori', ['kegiatan_ormada', 'kegiatan_pemda', 'baksos', 'pendidikan', 'kesehatan', 'lingkungan', 'lainnya']); // Kategori acara
            $table->integer('kuota_volunteer')->nullable(); // Kuota volunteer (jika ada)
            $table->dateTime('deadline_pendaftaran')->nullable(); // Deadline pendaftaran volunteer
            $table->boolean('is_published')->default(false); // Status publish
            $table->timestamp('tanggal_publish')->nullable(); // Kapan dipublish
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->index('admin_id');
            $table->index('kategori');
            $table->index('waktu_mulai');
            $table->index('is_published');
            $table->index('kuota_volunteer');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};