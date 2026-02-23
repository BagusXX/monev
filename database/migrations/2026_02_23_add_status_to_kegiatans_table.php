<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            // Tambah kolom status: planning (rencana) -> realisasi (implementasi) -> reported (laporan)
            $table->enum('status', ['planning', 'realisasi', 'reported'])->default('planning')->after('user_id');
            
            // Tambah kolom untuk rencana kegiatan
            $table->text('rencana_kegiatan')->nullable()->after('status');
            
            // Tambah kolom untuk tandatangan realisasi
            $table->boolean('is_realized')->default(false)->after('rencana_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('rencana_kegiatan');
            $table->dropColumn('is_realized');
        });
    }
};
