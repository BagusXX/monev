<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanStoreRequest;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringKegiatanController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->query('bulan');
        if (!is_string($bulan) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = Carbon::now()->format('Y-m');
        }

        $kegiatans = Kegiatan::query()
            ->where('bulan', $bulan)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // compute readable bulan label
        try {
            $bulanLabel = Carbon::createFromFormat('Y-m', $bulan)
                ->locale('id')
                ->translatedFormat('F Y');
        } catch (\Throwable $e) {
            $bulanLabel = $bulan;
        }

        return view('monitoring.kegiatan', compact('bulan', 'bulanLabel', 'kegiatans'));
    }

    public function store(KegiatanStoreRequest $request): RedirectResponse
    {
        $rows = $request->validated('kegiatan');
        $userId = $request->user()->id;

        $savedCount = 0;
        $firstBulan = null;

        foreach ($rows as $row) {
            // Pastikan tanggal lengkap (input date => YYYY-MM-DD)
            try {
                $dt = Carbon::createFromFormat('Y-m-d', $row['tanggal_pelaksanaan']);
                // gunakan format Y-m untuk kolom bulan
                $bulanForRow = $dt->format('Y-m');
            } catch (\Throwable $e) {
                // fallback jika input tidak valid (seharusnya divalidasi oleh Request)
                $bulanForRow = Carbon::now()->format('Y-m');
            }

            if ($firstBulan === null) {
                $firstBulan = $bulanForRow;
            }

            Kegiatan::create([
                'bulan' => $bulanForRow,
                'user_id' => $userId,
                'tema' => $row['tema'],
                'bidang' => $row['bidang'],
                'tanggal_pelaksanaan' => $row['tanggal_pelaksanaan'],
                'nama_kegiatan' => $row['nama_kegiatan'],
                'pelaksana' => $row['pelaksana'],
                'jumlah_peserta' => (int) ($row['jumlah_peserta'] ?? 0),
                'anggaran' => (int) ($row['anggaran'] ?? 0),
            ]);

            $savedCount++;
        }

        $n = $savedCount;
        $msg = $n === 1
            ? 'Kegiatan berhasil disimpan dan sudah masuk ke laporan.'
            : "{$n} kegiatan berhasil disimpan dan sudah masuk ke laporan.";

        // Redirect ke laporan untuk bulan dari baris pertama yang disimpan
        $redirectBulan = $firstBulan ?? Carbon::now()->format('Y-m');

        return redirect()
            ->route('laporan.kegiatan', ['bulan' => $redirectBulan])
            ->with('success', $msg);
    }

    public function destroy(Kegiatan $kegiatan): RedirectResponse
    {
        $bulan = $kegiatan->bulan;
        $kegiatan->delete();

        return redirect()
            ->route('monitoring.kegiatan', ['bulan' => $bulan])
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}