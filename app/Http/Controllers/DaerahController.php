<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DaerahController extends Controller
{
    /**
     * Display listing of all daerah
     */
    public function index(): View
    {
        $daerahs = Daerah::latest()->paginate(15);
        
        return view('daerah.index', compact('daerahs'));
    }

    /**
     * Show create form
     */
    public function create(): View
    {
        return view('daerah.create');
    }

    /**
     * Store new daerah
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:daerahs,kode',
            'nama' => 'required|string|max:255|unique:daerahs,nama',
        ], [
            'kode.required' => 'Kode daerah wajib diisi',
            'kode.unique' => 'Kode daerah sudah terdaftar',
            'nama.required' => 'Nama daerah wajib diisi',
            'nama.unique' => 'Nama daerah sudah terdaftar',
        ]);

        Daerah::create($validated);

        return redirect()->route('daerah.index')
            ->with('success', 'Daerah berhasil ditambahkan!');
    }

    /**
     * Show edit form
     */
    public function edit(Daerah $daerah): View
    {
        return view('daerah.edit', compact('daerah'));
    }

    /**
     * Update daerah
     */
    public function update(Request $request, Daerah $daerah): RedirectResponse
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:daerahs,kode,' . $daerah->id,
            'nama' => 'required|string|max:255|unique:daerahs,nama,' . $daerah->id,
        ], [
            'kode.required' => 'Kode daerah wajib diisi',
            'kode.unique' => 'Kode daerah sudah terdaftar',
            'nama.required' => 'Nama daerah wajib diisi',
            'nama.unique' => 'Nama daerah sudah terdaftar',
        ]);

        $daerah->update($validated);

        return redirect()->route('daerah.index')
            ->with('success', 'Daerah berhasil diperbarui!');
    }

    /**
     * Delete daerah
     */
    public function destroy(Daerah $daerah): RedirectResponse
    {
        // Check if daerah has related kota/kabupaten
        if ($daerah->kotas()->count() > 0 || $daerah->kabupatens()->count() > 0) {
            return redirect()->route('daerah.index')
                ->with('error', 'Tidak bisa menghapus daerah yang masih memiliki kota/kabupaten!');
        }

        $daerah->delete();

        return redirect()->route('daerah.index')
            ->with('success', 'Daerah berhasil dihapus!');
    }
}
