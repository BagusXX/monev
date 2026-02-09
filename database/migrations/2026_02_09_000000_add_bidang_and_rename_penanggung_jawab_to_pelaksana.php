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
            // Add bidang column if it doesn't exist
            if (!Schema::hasColumn('kegiatans', 'bidang')) {
                $table->string('bidang')->nullable()->after('tema');
            }
            
            // Rename penanggung_jawab to pelaksana if needed
            if (Schema::hasColumn('kegiatans', 'penanggung_jawab') && !Schema::hasColumn('kegiatans', 'pelaksana')) {
                $table->renameColumn('penanggung_jawab', 'pelaksana');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatans', 'pelaksana')) {
                $table->renameColumn('pelaksana', 'penanggung_jawab');
            }
            
            if (Schema::hasColumn('kegiatans', 'bidang')) {
                $table->dropColumn('bidang');
            }
        });
    }
};
