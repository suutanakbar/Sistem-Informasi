<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('postingan')) {
            return;
        }

        Schema::create('postingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
            $table->string('judul');
            $table->text('isi_konten');
            $table->string('foto')->nullable(); // Foto postingan
            $table->enum('jenis_konten', ['berita', 'pengumuman', 'prestasi']); // Jenis konten
            $table->boolean('is_published')->default(false); // Status publish
            $table->timestamp('tanggal_publish')->nullable(); // Kapan dipublish
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->index('admin_id');
            $table->index('jenis_konten');
            $table->index('is_published');
            $table->index('tanggal_publish');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postingan');
    }
};