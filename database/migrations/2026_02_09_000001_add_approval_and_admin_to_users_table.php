<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure daerah_id exists first
        if (!Schema::hasColumn('users', 'daerah_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('daerah_id')->nullable()->constrained('daerahs')->nullOnDelete()->after('id');
            });
        }

        // Add is_approved and is_main_admin columns
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_approved')) {
                $table->boolean('is_approved')->default(false)->after('daerah_id');
            }
            if (!Schema::hasColumn('users', 'is_main_admin')) {
                $table->boolean('is_main_admin')->default(false)->after('is_approved');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_approved')) {
                $table->dropColumn('is_approved');
            }
            if (Schema::hasColumn('users', 'is_main_admin')) {
                $table->dropColumn('is_main_admin');
            }
        });
    }
};
