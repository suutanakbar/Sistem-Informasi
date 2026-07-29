<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota_ormada', function (Blueprint $table) {
            // Add new columns for alumni and additional data
            $table->string('fakultas')->nullable()->after('program_studi');
            $table->string('prodi')->nullable()->after('fakultas');
            $table->text('alamat')->nullable()->after('no_hp');
            $table->string('email')->nullable()->after('alamat');
            $table->string('cv_path')->nullable()->after('email');
        });

        // Update enum to include alumni
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement('SET SESSION sql_mode = ""');
        }
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement("ALTER TABLE anggota_ormada MODIFY COLUMN status_aktif ENUM('mahasiswa', 'fungsionaris', 'alumni') NOT NULL DEFAULT 'mahasiswa'");
        }
    }

    public function down(): void
    {
        Schema::table('anggota_ormada', function (Blueprint $table) {
            $table->dropColumn(['fakultas', 'prodi', 'alamat', 'email', 'cv_path']);
        });

        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement('SET SESSION sql_mode = ""');
        }
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement("ALTER TABLE anggota_ormada MODIFY COLUMN status_aktif ENUM('mahasiswa', 'fungsionaris') NOT NULL");
        }
    }
};