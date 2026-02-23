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
            if (!Schema::hasColumn('kegiatans', 'realized_at')) {
                $table->timestamp('realized_at')->nullable()->after('is_realized')->comment('Waktu kegiatan ditandai terealisasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('realized_at');
        });
    }
};
