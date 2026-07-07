<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            // Modify the kategori column to ensure it has the correct enum values
            $table->enum('kategori', ['kegiatan_ormada', 'kegiatan_pemda', 'baksos', 'pendidikan', 'kesehatan', 'lingkungan', 'lainnya'])
                  ->after('tempat')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            // Revert to a more limited set if needed
            $table->enum('kategori', ['kegiatan_ormada', 'kegiatan_pemda', 'baksos', 'pendidikan', 'kesehatan', 'lingkungan', 'lainnya'])
                  ->after('tempat')
                  ->change();
        });
    }
};