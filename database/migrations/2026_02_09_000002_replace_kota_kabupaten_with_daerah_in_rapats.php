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
            // Add daerah_id if it doesn't exist
            if (!Schema::hasColumn('rapats', 'daerah_id')) {
                $table->foreignId('daerah_id')->nullable()->constrained('daerahs')->nullOnDelete()->after('bulan');
            }
        });

        // Drop old kota_id and kabupaten_id if they exist
        Schema::table('rapats', function (Blueprint $table) {
            if (Schema::hasColumn('rapats', 'kota_id')) {
                $table->dropConstrainedForeignId('kota_id');
            }
            if (Schema::hasColumn('rapats', 'kabupaten_id')) {
                $table->dropConstrainedForeignId('kabupaten_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapats', function (Blueprint $table) {
            if (Schema::hasColumn('rapats', 'daerah_id')) {
                $table->dropConstrainedForeignId('daerah_id');
            }
        });
    }
};
