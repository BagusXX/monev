<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kota;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'kotas' => Kota::query()->orderBy('nama')->get(['id', 'nama']),
            'kabupatens' => Kabupaten::query()->orderBy('nama')->get(['id', 'nama']),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jenis_wilayah' => ['nullable', Rule::in(['kota', 'kabupaten'])],
            'kota_id' => [
                'nullable',
                'integer',
                'exists:kotas,id',
                'required_if:jenis_wilayah,kota',
                'prohibited_unless:jenis_wilayah,kota',
            ],
            'kabupaten_id' => [
                'nullable',
                'integer',
                'exists:kabupatens,id',
                'required_if:jenis_wilayah,kabupaten',
                'prohibited_unless:jenis_wilayah,kabupaten',
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kota_id' => $request->jenis_wilayah === 'kota' ? $request->kota_id : null,
            'kabupaten_id' => $request->jenis_wilayah === 'kabupaten' ? $request->kabupaten_id : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('setup', absolute: false));
    }
}
