<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WilayahController extends Controller
{
    /**
     * Display listing of both kota and kabupaten
     */
    public function index(): View
    {
        $kotas = Kota::latest()->paginate(10);
        $kabupatens = Kabupaten::latest()->paginate(10);
        $type = request('type', 'kota');
        
        if ($type === 'kabupaten') {
            $data = $kabupatens;
        } else {
            $data = $kotas;
        }
        
        return view('wilayah.index', compact('kotas', 'kabupatens', 'data', 'type'));
    }

    /**
     * Show create form with type selector
     */
    public function create(): View
    {
        return view('wilayah.create');
    }

    /**
     * Store kota
     */
    public function storeKota(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kotas,nama',
        ]);

        Kota::create($validated);

        return redirect()->route('wilayah.index', ['type' => 'kota'])
            ->with('success', 'Kota berhasil ditambahkan.');
    }

    /**
     * Store kabupaten
     */
    public function storeKabupaten(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kabupatens,nama',
        ]);

        Kabupaten::create($validated);

        return redirect()->route('wilayah.index', ['type' => 'kabupaten'])
            ->with('success', 'Kabupaten berhasil ditambahkan.');
    }

    /**
     * Show edit form for kota
     */
    public function editKota(Kota $kota): View
    {
        return view('wilayah.edit-kota', compact('kota'));
    }

    /**
     * Show edit form for kabupaten
     */
    public function editKabupaten(Kabupaten $kabupaten): View
    {
        return view('wilayah.edit-kabupaten', compact('kabupaten'));
    }

    /**
     * Update kota
     */
    public function updateKota(Request $request, Kota $kota): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kotas,nama,' . $kota->id,
        ]);

        $kota->update($validated);

        return redirect()->route('wilayah.index', ['type' => 'kota'])
            ->with('success', 'Kota berhasil diubah.');
    }

    /**
     * Update kabupaten
     */
    public function updateKabupaten(Request $request, Kabupaten $kabupaten): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kabupatens,nama,' . $kabupaten->id,
        ]);

        $kabupaten->update($validated);

        return redirect()->route('wilayah.index', ['type' => 'kabupaten'])
            ->with('success', 'Kabupaten berhasil diubah.');
    }

    /**
     * Destroy kota
     */
    public function destroyKota(Kota $kota): RedirectResponse
    {
        $kota->delete();

        return redirect()->route('wilayah.index', ['type' => 'kota'])
            ->with('success', 'Kota berhasil dihapus.');
    }

    /**
     * Destroy kabupaten
     */
    public function destroyKabupaten(Kabupaten $kabupaten): RedirectResponse
    {
        $kabupaten->delete();

        return redirect()->route('wilayah.index', ['type' => 'kabupaten'])
            ->with('success', 'Kabupaten berhasil dihapus.');
    }
}
