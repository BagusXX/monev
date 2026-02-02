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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            // format: YYYY-MM (contoh: 2026-01)
            $table->string('bulan', 7)->index();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('tema');
            $table->date('tanggal_pelaksanaan')->nullable()->index();
            $table->string('nama_kegiatan');
            $table->string('penanggung_jawab');
            $table->unsignedInteger('jumlah_peserta')->default(0);
            // Rupiah (tanpa desimal)
            $table->unsignedBigInteger('anggaran')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};

