<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This migration may be re-run after a partial failure (e.g. columns got created,
        // but one of the foreign keys failed because referenced tables weren't created yet).
        // So we add missing columns and (re)create the expected constraints safely.

        if (!Schema::hasColumn('rapats', 'user_id')
            || !Schema::hasColumn('rapats', 'kota_id')
            || !Schema::hasColumn('rapats', 'kabupaten_id')) {
            Schema::table('rapats', function (Blueprint $table) {
                if (!Schema::hasColumn('rapats', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }

                if (!Schema::hasColumn('rapats', 'kota_id')) {
                    $table->unsignedBigInteger('kota_id')->nullable()->after('user_id');
                }

                if (!Schema::hasColumn('rapats', 'kabupaten_id')) {
                    $table->unsignedBigInteger('kabupaten_id')->nullable()->after('kota_id');
                }
            });
        }

        foreach ([
            'rapats_user_id_foreign',
            'rapats_kota_id_foreign',
            'rapats_kabupaten_id_foreign',
        ] as $foreignKey) {
            try {
                DB::statement("ALTER TABLE `rapats` DROP FOREIGN KEY `$foreignKey`");
            } catch (\Throwable $e) {
                // ignore: foreign key doesn't exist yet
            }
        }

        Schema::table('rapats', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('kota_id')->references('id')->on('kotas')->nullOnDelete();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->nullOnDelete();
        });
    }

    public function down(): void
    {
        foreach ([
            'rapats_kabupaten_id_foreign',
            'rapats_kota_id_foreign',
            'rapats_user_id_foreign',
        ] as $foreignKey) {
            try {
                DB::statement("ALTER TABLE `rapats` DROP FOREIGN KEY `$foreignKey`");
            } catch (\Throwable $e) {
                // ignore
            }
        }

        Schema::table('rapats', function (Blueprint $table) {
            if (Schema::hasColumn('rapats', 'kabupaten_id')) {
                $table->dropColumn('kabupaten_id');
            }
            if (Schema::hasColumn('rapats', 'kota_id')) {
                $table->dropColumn('kota_id');
            }
            if (Schema::hasColumn('rapats', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};

