<?php

namespace App\Http\Controllers;

use App\Http\Requests\KabupatenStoreRequest;
use App\Http\Requests\KabupatenUpdateRequest;
use App\Models\Kabupaten;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kabupatens = Kabupaten::latest()->paginate(10);
        return view('kabupaten.index', compact('kabupatens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kabupaten.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KabupatenStoreRequest $request): RedirectResponse
    {
        Kabupaten::create($request->validated());

        return redirect()->route('kabupaten.index')
            ->with('success', 'Kabupaten berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Kabupaten $kabupaten): View
    {
        return view('kabupaten.edit', compact('kabupaten'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KabupatenUpdateRequest $request, Kabupaten $kabupaten): RedirectResponse
    {
        $kabupaten->update($request->validated());

        return redirect()->route('kabupaten.index')
            ->with('success', 'Kabupaten berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten): RedirectResponse
    {
        $kabupaten->delete();

        return redirect()->route('kabupaten.index')
            ->with('success', 'Kabupaten berhasil dihapus.');
    }
}
