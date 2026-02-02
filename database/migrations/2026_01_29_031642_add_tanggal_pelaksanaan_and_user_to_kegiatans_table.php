<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            if (!Schema::hasColumn('kegiatans', 'tanggal_pelaksanaan')) {
                $table->date('tanggal_pelaksanaan')->nullable()->index()->after('tema');
            }

            if (!Schema::hasColumn('kegiatans', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->cascadeOnDelete()
                    ->after('bulan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatans', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('kegiatans', 'tanggal_pelaksanaan')) {
                $table->dropColumn('tanggal_pelaksanaan');
            }
        });
    }
};