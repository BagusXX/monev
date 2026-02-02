<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapats', function (Blueprint $table) {
            $table->id();
            // format: YYYY-MM (contoh: 2026-01)
            $table->string('bulan', 7)->index();
            $table->date('tanggal')->index();
            $table->time('waktu')->nullable();

            $table->boolean('rapat_dptd')->default(false);
            $table->text('uraian_dptd')->nullable();

            $table->boolean('rapat_phdpd')->default(false);
            $table->text('uraian_phdpd')->nullable();

            $table->boolean('rapat_pimpinan')->default(false);
            $table->text('uraian_pimpinan')->nullable();

            $table->boolean('rapat_bidang')->default(false);
            $table->text('uraian_bidang')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapats');
    }
};

