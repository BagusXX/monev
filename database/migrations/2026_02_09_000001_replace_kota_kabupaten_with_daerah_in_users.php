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
        Schema::table('users', function (Blueprint $table) {
            // Add daerah_id if it doesn't exist
            if (!Schema::hasColumn('users', 'daerah_id')) {
                $table->foreignId('daerah_id')->nullable()->constrained('daerahs')->nullOnDelete()->after('id');
            }
        });

        // Drop old kota_id and kabupaten_id if they exist
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'kota_id')) {
                $table->dropConstrainedForeignId('kota_id');
            }
            if (Schema::hasColumn('users', 'kabupaten_id')) {
                $table->dropConstrainedForeignId('kabupaten_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'daerah_id')) {
                $table->dropConstrainedForeignId('daerah_id');
            }
            // Note: Cannot easily restore old kota_id and kabupaten_id without data
        });
    }
};
