<?php

namespace App\Http\Controllers;

use App\Http\Requests\KotaStoreRequest;
use App\Http\Requests\KotaUpdateRequest;
use App\Models\Kota;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kotas = Kota::latest()->paginate(10);
        return view('kota.index', compact('kotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KotaStoreRequest $request): RedirectResponse
    {
        Kota::create($request->validated());

        return redirect()->route('kota.index')
            ->with('success', 'Kota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Kota $kota): View
    {
        return view('kota.edit', compact('kota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KotaUpdateRequest $request, Kota $kota): RedirectResponse
    {
        $kota->update($request->validated());

        return redirect()->route('kota.index')
            ->with('success', 'Kota berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kota $kota): RedirectResponse
    {
        $kota->delete();

        return redirect()->route('kota.index')
            ->with('success', 'Kota berhasil dihapus.');
    }
}
