<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            if (Schema::hasColumn('pengumuman', 'dibuat_oleh')) {
                $table->renameColumn('dibuat_oleh', 'admin_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            if (Schema::hasColumn('pengumuman', 'admin_id')) {
                $table->renameColumn('admin_id', 'dibuat_oleh');
            }
        });
    }
};