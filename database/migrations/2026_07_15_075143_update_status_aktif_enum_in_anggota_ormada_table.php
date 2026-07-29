<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Skip sql_mode setting for SQLite (testing)
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement('SET SESSION sql_mode = ""');
        }

        // Update existing data
        \DB::table('anggota_ormada')->where('status_aktif', 'mahasiswa_biasa')->update(['status_aktif' => 'mahasiswa']);
        \DB::table('anggota_ormada')->where('status_aktif', 'demisioner')->update(['status_aktif' => 'mahasiswa']);
        \DB::table('anggota_ormada')->where('status_aktif', 'alumni')->update(['status_aktif' => 'mahasiswa']);

        // Change enum using raw SQL for MySQL
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement("ALTER TABLE anggota_ormada MODIFY COLUMN status_aktif ENUM('mahasiswa', 'fungsionaris') NOT NULL");
        }
    }

    public function down(): void
    {
        // Skip sql_mode setting for SQLite (testing)
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement('SET SESSION sql_mode = ""');
        }

        // Revert data
        \DB::table('anggota_ormada')->where('status_aktif', 'mahasiswa')->update(['status_aktif' => 'mahasiswa_biasa']);

        // Change back to original enum
        if (\DB::getDriverName() !== 'sqlite') {
            \DB::statement("ALTER TABLE anggota_ormada MODIFY COLUMN status_aktif ENUM('fungsionaris', 'mahasiswa_biasa', 'demisioner', 'alumni') NOT NULL");
        }
    }
};