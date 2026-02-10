<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add PKS columns if they don't exist
        if (!Schema::hasColumn('rapats', 'rapat_pks')) {
            Schema::table('rapats', function (Blueprint $table) {
                $table->boolean('rapat_pks')->default(false)->after('rapat_dewan');
            });
        }
        
        if (!Schema::hasColumn('rapats', 'uraian_pks')) {
            Schema::table('rapats', function (Blueprint $table) {
                $table->text('uraian_pks')->nullable()->after('rapat_pks');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapats', function (Blueprint $table) {
            if (Schema::hasColumn('rapats', 'rapat_pks')) {
                $table->dropColumn('rapat_pks');
            }
            if (Schema::hasColumn('rapats', 'uraian_pks')) {
                $table->dropColumn('uraian_pks');
            }
        });
    }
};
