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
        Schema::table('rapats', function (Blueprint $table) {
            $table->renameColumn('rapat_kpd', 'rapat_kdd');
            $table->renameColumn('uraian_kpd', 'uraian_kdd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapats', function (Blueprint $table) {
            $table->renameColumn('rapat_kdd', 'rapat_kpd');
            $table->renameColumn('uraian_kdd', 'uraian_kpd');
        });
    }
};
