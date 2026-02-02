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
            $table->foreignId('kota_id')->nullable()->constrained('kotas')->nullOnDelete()->after('id');
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupatens')->nullOnDelete()->after('kota_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kabupaten_id');
            $table->dropConstrainedForeignId('kota_id');
        });
    }
};
