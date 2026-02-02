<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanKegiatanController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->query('bulan');
        if (!is_string($bulan) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = Carbon::now()->format('Y-m');
        }

        $kegiatans = Kegiatan::query()
            ->where('bulan', $bulan)
            ->orderBy('nama_kegiatan')
            ->paginate(20)
            ->withQueryString();

        $totalPeserta = (int) Kegiatan::query()->where('bulan', $bulan)->sum('jumlah_peserta');
        $totalAnggaran = (int) Kegiatan::query()->where('bulan', $bulan)->sum('anggaran');

        return view('laporan.kegiatan', compact('bulan', 'kegiatans', 'totalPeserta', 'totalAnggaran'));
    }
}

