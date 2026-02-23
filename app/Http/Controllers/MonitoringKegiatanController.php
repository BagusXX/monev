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
    /**
     * Tampilkan kegiatan dalam fase realisasi (setelah rencana ditandai ✓)
     */
    public function index(Request $request): View
    {
        $bulan = $request->query('bulan');
        if (!is_string($bulan) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = Carbon::now()->format('Y-m');
        }

        // Tampilkan hanya kegiatan dengan status 'realisasi' (sudah ditandai dari rencana)
        $kegiatans = Kegiatan::query()
            ->where('bulan', $bulan)
            ->where('status', 'realisasi')
            ->where('user_id', $request->user()->id)
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

    /**
     * Tandai kegiatan sebagai sudah terealisasi (set is_realized = true, tetap di realisasi)
     */
    public function markAsRealized(Kegiatan $kegiatan, Request $request): RedirectResponse
    {
        // Pastikan user hanya bisa mengubah miliknya sendiri
        if ($kegiatan->user_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kegiatan ini.');
        }

        // Pastikan status masih realisasi
        if ($kegiatan->status !== 'realisasi') {
            return redirect()->back()->with('warning', 'Kegiatan ini sudah diproses atau belum dalam fase realisasi.');
        }

        // Update hanya is_realized dan realized_at, TIDAK mengubah status
        $kegiatan->update([
            'is_realized' => true,
            'realized_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', '✓ Kegiatan ditandai terealisasi! Anda dapat upload foto atau lanjut ke Laporan Kegiatan.');
    }

    /**
     * Upload foto untuk kegiatan yang sudah ditandai terealisasi
     */
    public function uploadPhoto(Kegiatan $kegiatan, Request $request): RedirectResponse
    {
        // Pastikan user hanya bisa upload foto miliknya sendiri
        if ($kegiatan->user_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kegiatan ini.');
        }

        // Pastikan kegiatan sudah terealizasi (opsional - bisa sebelum ditandai terealisasi)
        if (!$kegiatan->is_realized) {
            return redirect()->back()->with('warning', 'Harap tandai kegiatan sebagai terealisasi terlebih dahulu untuk menambah foto.');
        }

        $request->validate([
            'fotos' => 'required|array|min:1',
            'fotos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB per file
        ]);

        $files = $request->file('fotos') ?? [];
        $uploadedCount = 0;

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                // Store file to storage/app/public/kegiatan
                $fotoPath = $file->store('kegiatan', 'public');
                // Ensure forward slashes for the path (fixes Windows paths)
                $fotoPath = str_replace('\\', '/', $fotoPath);
                
                // Save to kegiatan_photos table
                $kegiatan->photos()->create([
                    'foto_path' => $fotoPath,
                ]);
                
                $uploadedCount++;
            }
        }

        $msg = $uploadedCount === 1
            ? 'Foto berhasil diunggah.'
            : "{$uploadedCount} foto berhasil diunggah.";

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Hapus foto kegiatan
     */
    public function deletePhoto($photoId, Request $request): RedirectResponse
    {
        // Import KegiatanPhoto model
        $photo = \App\Models\KegiatanPhoto::findOrFail($photoId);
        $kegiatan = $photo->kegiatan;

        // Pastikan user hanya bisa menghapus miliknya sendiri
        if ($kegiatan->user_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke foto ini.');
        }

        // Delete file dari storage jika ada
        if ($photo->foto_path && Storage::disk('public')->exists($photo->foto_path)) {
            Storage::disk('public')->delete($photo->foto_path);
        }

        $photo->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
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
        
        // Delete associated photos if exist
        if ($kegiatan->photos && $kegiatan->photos->count() > 0) {
            foreach ($kegiatan->photos as $photo) {
                if ($photo->foto_path && Storage::disk('public')->exists($photo->foto_path)) {
                    Storage::disk('public')->delete($photo->foto_path);
                }
                $photo->delete();
            }
        }
        
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus.');
    }
}
