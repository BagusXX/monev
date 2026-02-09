<?php

namespace App\Http\Controllers;

use App\Http\Requests\RapatStoreRequest;
use App\Models\Rapat;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringRapatController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->query('bulan');
        if (!is_string($bulan) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = Carbon::now()->format('Y-m');
        }

        // nilai default untuk form (dipakai saat page load / filter)
        $tanggal = $request->query('tanggal');
        if (!is_string($tanggal) || $tanggal === '') {
            $tanggal = Carbon::now()->format('Y-m-d');
        }
        return view('monitor', compact('bulan', 'tanggal'));
    }

    public function store(RapatStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();
        $data['user_id'] = $user?->id;
        $data['pengisi_nama'] = $user?->name;
        // Wilayah otomatis mengikuti user
        $data['daerah_id'] = $user?->daerah_id;

        // Jika waktu tidak diisi, pakai jam saat pengisian (sesuai timezone aplikasi)
        if (!isset($data['waktu']) || $data['waktu'] === null || $data['waktu'] === '') {
            $data['waktu'] = Carbon::now()->format('H:i');
        }

        // Normalisasi uraian: kosong -> null
        foreach (['uraian_dptd', 'uraian_phdpd', 'uraian_pimpinan', 'uraian_bidang', 'uraian_kpd', 'uraian_dewan'] as $key) {
            if (!isset($data[$key]) || $data[$key] === '') {
                $data[$key] = null;
            }
        }

        Rapat::create($data);

        return redirect()
            ->route('laporan.rapat', ['bulan' => $data['bulan']])
            ->with('success', 'Monitoring rapat berhasil disimpan dan masuk ke laporan.');
    }
}

