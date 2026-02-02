<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelurahanStoreRequest;
use App\Http\Requests\KelurahanUpdateRequest;
use App\Models\Kelurahan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kelurahans = Kelurahan::latest()->paginate(10);
        return view('kelurahan.index', compact('kelurahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kelurahan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelurahanStoreRequest $request): RedirectResponse
    {
        Kelurahan::create($request->validated());

        return redirect()->route('kelurahan.index')
            ->with('success', 'Kelurahan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelurahan $kelurahan): View
    {
        return view('kelurahan.edit', compact('kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelurahanUpdateRequest $request, Kelurahan $kelurahan): RedirectResponse
    {
        $kelurahan->update($request->validated());

        return redirect()->route('kelurahan.index')
            ->with('success', 'Kelurahan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelurahan $kelurahan): RedirectResponse
    {
        $kelurahan->delete();

        return redirect()->route('kelurahan.index')
            ->with('success', 'Kelurahan berhasil dihapus.');
    }
}
