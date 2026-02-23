<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RencanaKegiatanController extends Controller
{
    /**
     * Tampilkan form edit rencana kegiatan
     */
    public function edit(Kegiatan $rencana): View
    {
        // Pastikan user hanya bisa edit miliknya sendiri
        if ($rencana->user_id !== request()->user()->id) {
            abort(403, 'Anda tidak memiliki akses ke rencana ini.');
        }

        // Hanya bisa edit jika masih status planning
        if ($rencana->status !== 'planning') {
            abort(403, 'Rencana yang sudah ditandai tidak bisa diubah.');
        }

        return view('rencana.edit', compact('rencana'));
    }

    /**
     * Update rencana kegiatan
     */
    public function update(Kegiatan $rencana, Request $request): RedirectResponse
    {
        // Pastikan user hanya bisa update miliknya sendiri
        if ($rencana->user_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke rencana ini.');
        }

        // Hanya bisa update jika masih status planning
        if ($rencana->status !== 'planning') {
            return redirect()->back()->with('error', 'Rencana yang sudah ditandai tidak bisa diubah.');
        }

        $validated = $request->validate([
            'tema' => 'required|string',
            'bidang' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_pelaksanaan' => 'required|date',
            'pelaksana' => 'required|string',
            'jumlah_peserta' => 'required|integer|min:0',
            'anggaran' => 'required|integer|min:0',
            'rencana_kegiatan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $dt = Carbon::createFromFormat('Y-m-d', $validated['tanggal_pelaksanaan']);
            $bulan = $dt->format('Y-m');
        } catch (\Throwable $e) {
            $bulan = $rencana->bulan;
        }

        $rencana->update([
            'bulan' => $bulan,
            'tema' => $validated['tema'],
            'bidang' => $validated['bidang'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'pelaksana' => $validated['pelaksana'],
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'anggaran' => $validated['anggaran'],
            'rencana_kegiatan' => $validated['rencana_kegiatan'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()->route('rencana.index', ['bulan' => $bulan])
            ->with('success', 'Rencana kegiatan berhasil diperbarui.');
    }

    /**
     * Tampilkan daftar rencana kegiatan
     */
    public function index(Request $request): View
    {
        $bulan = $request->query('bulan');
        if (!is_string($bulan) || !preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $bulan)) {
            $bulan = Carbon::now()->format('Y-m');
        }

        $rencanas = Kegiatan::query()
            ->where('bulan', $bulan)
            ->where('status', 'realisasi')  // Tampilkan hanya yang sudah masuk realisasi
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

        return view('rencana.index', compact('bulan', 'bulanLabel', 'rencanas'));
    }

    /**
     * Tampilkan form buat rencana kegiatan baru
     */
    public function create(): View
    {
        $bulan = Carbon::now()->format('Y-m');
        try {
            $bulanLabel = Carbon::createFromFormat('Y-m', $bulan)
                ->locale('id')
                ->translatedFormat('F Y');
        } catch (\Throwable $e) {
            $bulanLabel = $bulan;
        }

        return view('rencana.create', compact('bulan', 'bulanLabel'));
    }

    /**
     * Simpan rencana kegiatan baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tema' => 'required|string',
            'bidang' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_pelaksanaan' => 'required|date',
            'pelaksana' => 'required|string',
            'jumlah_peserta' => 'required|integer|min:0',
            'anggaran' => 'required|integer|min:0',
            'rencana_kegiatan' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $dt = Carbon::createFromFormat('Y-m-d', $validated['tanggal_pelaksanaan']);
            $bulan = $dt->format('Y-m');
        } catch (\Throwable $e) {
            $bulan = Carbon::now()->format('Y-m');
        }

        Kegiatan::create([
            'bulan' => $bulan,
            'user_id' => $request->user()->id,
            'status' => 'realisasi',
            'rencana_kegiatan' => $validated['rencana_kegiatan'] ?? null,
            'tema' => $validated['tema'],
            'bidang' => $validated['bidang'],
            'tanggal_pelaksanaan' => $validated['tanggal_pelaksanaan'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'pelaksana' => $validated['pelaksana'],
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'anggaran' => $validated['anggaran'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()
            ->route('monitoring.kegiatan', ['bulan' => $bulan])
            ->with('success', 'Rencana kegiatan disimpan! Sekarang tandai sudah terealisasi dan upload foto bukti kegiatan.');
    }

    /**
     * Tandai rencana kegiatan sebagai siap untuk realisasi (tombol centang)
     * METHOD DEPRECATED - Workflow langsung dari form ke realisasi
     */
    public function markAsReady(Kegiatan $rencana): RedirectResponse
    {
        // This method is no longer needed as tasks go directly to realisasi on creation
        return redirect()->route('monitoring.kegiatan', ['bulan' => $rencana->bulan]);
    }

    /**
     * Hapus rencana kegiatan
     */
    public function destroy(Kegiatan $rencana): RedirectResponse
    {
        // Pastikan user hanya bisa menghapus miliknya sendiri
        if ($rencana->user_id !== request()->user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke rencana ini.');
        }

        // Hanya bisa menghapus jika masih status planning
        if ($rencana->status !== 'planning') {
            return redirect()->back()->with('error', 'Hanya rencana kegiatan yang belum ditandai yang bisa dihapus.');
        }

        $bulan = $rencana->bulan;
        $rencana->delete();

        return redirect()->route('rencana.index', ['bulan' => $bulan])
            ->with('success', 'Rencana kegiatan berhasil dihapus.');
    }
}
