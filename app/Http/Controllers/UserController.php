<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Kabupaten;
use App\Models\Kota;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(): View
    {
        // Redirect to setup instead
        return redirect()->route('setup');
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        $kotas = Kota::query()->orderBy('nama')->get();
        $kabupatens = Kabupaten::query()->orderBy('nama')->get();
        return view('setup.create-user', compact('kotas', 'kabupatens'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $kotaId = $request->input('kota_id');
        $kabId = $request->input('kabupaten_id');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kota_id' => $kotaId ?: null,
            'kabupaten_id' => $kotaId ? null : ($kabId ?: null),
        ]);

        return redirect()->route('setup')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        $kotas = Kota::query()->orderBy('nama')->get();
        $kabupatens = Kabupaten::query()->orderBy('nama')->get();
        return view('setup.edit-user', compact('user', 'kotas', 'kabupatens'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $kotaId = $request->input('kota_id');
        $kabId = $request->input('kabupaten_id');

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'kota_id' => $kotaId ?: null,
            'kabupaten_id' => $kotaId ? null : ($kabId ?: null),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('setup')
            ->with('success', 'User berhasil diubah.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('setup')
            ->with('success', 'User berhasil dihapus.');
    }
}
