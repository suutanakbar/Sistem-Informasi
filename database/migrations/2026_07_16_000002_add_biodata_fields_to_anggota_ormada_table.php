<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota_ormada', function (Blueprint $table) {
            $table->string('nik')->nullable()->after('nim');
            $table->string('tempat_lahir')->nullable()->after('nik');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('agama')->nullable()->after('tanggal_lahir');
            $table->string('golongan_darah')->nullable()->after('agama');
            $table->string('angkatan')->nullable()->after('prodi');
        });
    }

    public function down(): void
    {
        Schema::table('anggota_ormada', function (Blueprint $table) {
            $table->dropColumn(['nik', 'tempat_lahir', 'tanggal_lahir', 'agama', 'golongan_darah', 'angkatan']);
        });
    }
};