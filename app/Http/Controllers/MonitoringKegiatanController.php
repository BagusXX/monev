<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanStoreRequest;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
        $files = $request->file('kegiatan_foto') ?? [];

        $savedCount = 0;
        $firstBulan = null;

        foreach ($rows as $index => $row) {
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

            // Create kegiatan
            $kegiatan = Kegiatan::create([
                'bulan' => $bulanForRow,
                'user_id' => $userId,
                'tema' => $row['tema'],
                'bidang' => $row['bidang'],
                'tanggal_pelaksanaan' => $row['tanggal_pelaksanaan'],
                'nama_kegiatan' => $row['nama_kegiatan'],
                'pelaksana' => $row['pelaksana'],
                'jumlah_peserta' => (int) ($row['jumlah_peserta'] ?? 0),
                'anggaran' => (int) ($row['anggaran'] ?? 0),
                'keterangan' => $row['keterangan'] ?? null,
            ]);

            // Handle multiple file uploads for this kegiatan
            if (isset($files[$index]) && is_array($files[$index])) {
                foreach ($files[$index] as $file) {
                    if ($file && $file->isValid()) {
                        // Store file to storage/app/public/kegiatan
                        $fotoPath = $file->store('kegiatan', 'public');
                        // Ensure forward slashes for the path (fixes Windows paths)
                        $fotoPath = str_replace('\\', '/', $fotoPath);
                        
                        // Save to kegiatan_photos table
                        $kegiatan->photos()->create([
                            'foto_path' => $fotoPath,
                        ]);
                    }
                }
            }

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
        
        // Delete associated photo if exists
        if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
            Storage::disk('public')->delete($kegiatan->foto);
        }
        
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus.');
    }
}