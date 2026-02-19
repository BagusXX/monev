<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a user from database or create one
        $user = User::first() ?? User::factory()->create();
        
        $bulanSekarang = Carbon::now()->format('Y-m');
        
        Kegiatan::create([
            'bulan' => $bulanSekarang,
            'user_id' => $user->id,
            'tema' => 'Kesehatan',
            'bidang' => 'Kesehatan Masyarakat',
            'tanggal_pelaksanaan' => Carbon::now()->format('Y-m-d'),
            'nama_kegiatan' => 'Pemeriksaan Kesehatan Rutin',
            'pelaksana' => 'Dinas Kesehatan',
            'jumlah_peserta' => 50,
            'anggaran' => 5000000,
        ]);
    }
}
