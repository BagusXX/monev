<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Daerah;
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

        $daerahId = $request->query('daerah');

        $baseQuery = Kegiatan::query()->where('bulan', $bulan);

        if ($daerahId && is_numeric($daerahId)) {
            $baseQuery->whereHas('user', function ($q) use ($daerahId) {
                $q->where('daerah_id', (int) $daerahId);
            });
        }

        $kegiatans = (clone $baseQuery)
            ->with('user.daerah', 'photos')
            ->orderBy('nama_kegiatan')
            ->paginate(20)
            ->withQueryString();

        $totalPeserta = (int) (clone $baseQuery)->sum('jumlah_peserta');
        $totalAnggaran = (int) (clone $baseQuery)->sum('anggaran');

        $daerahs = Daerah::orderBy('nama')->get();

        if ($request->ajax()) {
            return view('laporan.partials.kegiatan_list', compact('kegiatans', 'bulan', 'daerahId'));
        }

        return view('laporan.kegiatan', compact('bulan', 'kegiatans', 'totalPeserta', 'totalAnggaran', 'daerahs', 'daerahId'));
    }
}

