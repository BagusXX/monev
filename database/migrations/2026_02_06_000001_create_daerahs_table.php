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
        Schema::create('daerahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // e.g., 33
            $table->string('nama'); // e.g., Jawa Tengah
            $table->timestamps();
        });

        // Add daerah_id to kotas and kabupatens
        Schema::table('kotas', function (Blueprint $table) {
            $table->foreignId('daerah_id')->nullable()->constrained('daerahs')->onDelete('set null');
        });

        Schema::table('kabupatens', function (Blueprint $table) {
            $table->foreignId('daerah_id')->nullable()->constrained('daerahs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kotas', function (Blueprint $table) {
            $table->dropForeignKey(['daerah_id']);
            $table->dropColumn('daerah_id');
        });

        Schema::table('kabupatens', function (Blueprint $table) {
            $table->dropForeignKey(['daerah_id']);
            $table->dropColumn('daerah_id');
        });

        Schema::dropIfExists('daerahs');
    }
};
