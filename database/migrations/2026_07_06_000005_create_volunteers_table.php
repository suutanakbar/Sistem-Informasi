<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('volunteers')) {
            return;
        }

        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id');
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->text('alasan')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->useCurrentOnUpdate();

            $table->index('agenda_id');
            $table->index('status');
            $table->index('email');

            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};