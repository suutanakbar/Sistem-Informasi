<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_ormada', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin')->cascadeOnDelete();
            $table->string('nama_universitas');
            $table->string('alamat_universitas');
            $table->unsignedInteger('total_mahasiswa_univ')->default(0);
            $table->string('logo')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->unique('admin_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_ormada');
    }
};
