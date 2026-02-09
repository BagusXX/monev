<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Daerah;
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
        $daerahs = Daerah::query()->orderBy('nama')->get();
        return view('setup.create-user', compact('daerahs'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'daerah_id' => $request->input('daerah_id'),
            'is_approved' => true,
        ]);

        return redirect()->route('setup')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        $daerahs = Daerah::query()->orderBy('nama')->get();
        return view('setup.edit-user', compact('user', 'daerahs'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'daerah_id' => $request->input('daerah_id'),
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

    /**
     * Approve a pending user (only accessible by main admin via UI).
     */
    public function approve(User $user): RedirectResponse
    {
        // only main admin can approve
        if (!auth()->user() || !auth()->user()->is_main_admin) {
            abort(403);
        }

        $user->update(['is_approved' => true]);

        return redirect()->route('setup')
            ->with('success', 'User berhasil disetujui.');
    }

    /**
     * Reject a pending user (only accessible by main admin via UI).
     */
    public function reject(User $user): RedirectResponse
    {
        // only main admin can reject
        if (!auth()->user() || !auth()->user()->is_main_admin) {
            abort(403);
        }

        $user->update(['is_rejected' => true, 'is_approved' => false]);

        return redirect()->route('setup')
            ->with('success', 'User berhasil ditolak.');
    }
}
