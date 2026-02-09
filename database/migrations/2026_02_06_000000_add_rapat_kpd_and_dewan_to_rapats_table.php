<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rapats', function (Blueprint $table) {
            // Tambah kolom untuk rapat bersama KPD
            $table->boolean('rapat_kpd')->default(false)->after('rapat_bidang');
            $table->text('uraian_kpd')->nullable()->after('rapat_kpd');

            // Tambah kolom untuk rapat bersama anggota Dewan
            $table->boolean('rapat_dewan')->default(false)->after('uraian_kpd');
            $table->text('uraian_dewan')->nullable()->after('rapat_dewan');
        });
    }

    public function down(): void
    {
        Schema::table('rapats', function (Blueprint $table) {
            $table->dropColumn(['rapat_kpd', 'uraian_kpd', 'rapat_dewan', 'uraian_dewan']);
        });
    }
};
