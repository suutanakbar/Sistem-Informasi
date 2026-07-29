<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            // Handle both cases: column might already be named 'password'
            // or still named 'kata_sandi' from older schema
            if (Schema::hasColumn('admin', 'kata_sandi')) {
                $table->renameColumn('kata_sandi', 'password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->renameColumn('password', 'kata_sandi');
        });
    }
};