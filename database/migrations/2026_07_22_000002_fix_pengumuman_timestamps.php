<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            // Rename default timestamps to model conventions
            if (Schema::hasColumn('pengumuman', 'created_at')) {
                $table->renameColumn('created_at', 'dibuat_pada');
            }
            if (Schema::hasColumn('pengumuman', 'updated_at')) {
                $table->renameColumn('updated_at', 'diperbarui_pada');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            if (Schema::hasColumn('pengumuman', 'dibuat_pada')) {
                $table->renameColumn('dibuat_pada', 'created_at');
            }
            if (Schema::hasColumn('pengumuman', 'diperbarui_pada')) {
                $table->renameColumn('diperbarui_pada', 'updated_at');
            }
        });
    }
};