<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
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

        $rapats = Rapat::query()
            ->where('bulan', $bulan)
            ->with(['user', 'kota', 'kabupaten'])
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->paginate(20)
            ->withQueryString();

        return view('laporan.rapat', compact('bulan', 'rapats'));
    }
}

