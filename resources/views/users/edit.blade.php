<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Daerah -->
                        <div class="border rounded-lg p-4">
                            <div class="font-semibold text-gray-800 mb-1">Daerah User</div>
                            <p class="text-sm text-gray-500 mb-3">Pilih asal daerah user (contoh: Kota Semarang - 33.74).</p>

                            <div>
                                <x-input-label for="daerah_id" :value="__('Daerah')" />
                                <select id="daerah_id" name="daerah_id" class="block mt-1 w-full rounded-md border-gray-300">
                                    <option value="">- Pilih Daerah -</option>
                                    @foreach($daerahs ?? [] as $daerah)
                                        <option value="{{ $daerah->id }}"
                                            {{ (string)old('daerah_id', $user->daerah_id) === (string)$daerah->id ? 'selected' : '' }}>
                                            {{ $daerah->nama }} - {{ $daerah->kode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <x-input-error :messages="$errors->get('daerah_id')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password Baru (kosongkan jika tidak ingin mengubah)')" />
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-end gap-4">
                            <a href="{{ route('setup') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button class="w-full sm:w-auto justify-center">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>
