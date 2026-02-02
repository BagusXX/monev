<?php

namespace App\Http\Controllers;

use App\Http\Requests\KecamatanStoreRequest;
use App\Http\Requests\KecamatanUpdateRequest;
use App\Models\Kecamatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kecamatans = Kecamatan::latest()->paginate(10);
        return view('kecamatan.index', compact('kecamatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KecamatanStoreRequest $request): RedirectResponse
    {
        Kecamatan::create($request->validated());

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kecamatan): View
    {
        return view('kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KecamatanUpdateRequest $request, Kecamatan $kecamatan): RedirectResponse
    {
        $kecamatan->update($request->validated());

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan): RedirectResponse
    {
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus.');
    }
}
