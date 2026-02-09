<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use App\Models\Daerah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanRapatController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->query('bulan');
        if (!is_string($bulan) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = Carbon::now()->format('Y-m');
        }

        $daerahId = $request->query('daerah');

        $baseQuery = Rapat::query()->where('bulan', $bulan)->with(['user', 'daerah']);

        if ($daerahId && is_numeric($daerahId)) {
            $baseQuery->where(function ($q) use ($daerahId) {
                $q->where('daerah_id', (int) $daerahId)
                  ->orWhereHas('user', function ($q2) use ($daerahId) {
                      $q2->where('daerah_id', (int) $daerahId);
                  });
            });
        }

        $rapats = (clone $baseQuery)
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->paginate(20)
            ->withQueryString();

        $daerahs = Daerah::orderBy('nama')->get();

        // compute readable bulan label
        try {
            $bulanLabel = Carbon::createFromFormat('Y-m', $bulan)
                ->locale('id')
                ->translatedFormat('F Y');
        } catch (\Throwable $e) {
            $bulanLabel = $bulan;
        }

        // compute daerah name for messaging
        $daerahName = 'Semua Daerah';
        if ($daerahId && is_numeric($daerahId)) {
            $d = Daerah::find((int) $daerahId);
            if ($d) {
                $daerahName = $d->nama . ' - ' . $d->kode;
            } else {
                $daerahName = '-';
            }
        }

        if ($request->ajax()) {
            return view('laporan.partials.rapat_list', compact('rapats', 'bulanLabel', 'daerahName'));
        }

        return view('laporan.rapat', compact('bulan', 'rapats', 'daerahs', 'daerahId', 'bulanLabel', 'daerahName'));
    }
}

