<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('postingan', function (Blueprint $table) {
            if (!Schema::hasColumn('postingan', 'is_published')) {
                $table->boolean('is_published')->default(false)->after('jenis_konten');
            }
            if (!Schema::hasColumn('postingan', 'tanggal_publish')) {
                $table->timestamp('tanggal_publish')->nullable()->after('is_published');
            }
        });
    }

    public function down(): void
    {
        Schema::table('postingan', function (Blueprint $table) {
            $table->dropColumn(['is_published', 'tanggal_publish']);
        });
    }
};