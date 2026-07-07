<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            if (!Schema::hasColumn('agenda', 'kuota_volunteer')) {
                $table->integer('kuota_volunteer')->nullable()->after('kategori');
            }
            if (!Schema::hasColumn('agenda', 'deadline_pendaftaran')) {
                $table->timestamp('deadline_pendaftaran')->nullable()->after('kuota_volunteer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            $table->dropColumn(['kuota_volunteer', 'deadline_pendaftaran']);
        });
    }
};