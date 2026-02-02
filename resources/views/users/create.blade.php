<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Wilayah -->
                        <div class="border rounded-lg p-4">
                            <div class="font-semibold text-gray-800 mb-1">Wilayah User</div>
                            <p class="text-sm text-gray-500 mb-3">Pilih asal wilayah user (contoh: Kota Semarang).</p>

                            <div class="flex flex-wrap gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="jenis_wilayah" value="kota"
                                        {{ old('jenis_wilayah') === 'kota' ? 'checked' : '' }}
                                        onclick="toggleWilayah('kota')">
                                    Kota
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="jenis_wilayah" value="kabupaten"
                                        {{ old('jenis_wilayah') === 'kabupaten' ? 'checked' : '' }}
                                        onclick="toggleWilayah('kabupaten')">
                                    Kabupaten
                                </label>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div id="pilihKota" class="hidden">
                                    <x-input-label for="kota_id" :value="__('Kota')" />
                                    <select id="kota_id" name="kota_id" class="block mt-1 w-full rounded-md border-gray-300">
                                        <option value="">- Pilih Kota -</option>
                                        @foreach($kotas ?? [] as $kota)
                                            <option value="{{ $kota->id }}" {{ (string)old('kota_id') === (string)$kota->id ? 'selected' : '' }}>
                                                {{ $kota->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="pilihKabupaten" class="hidden">
                                    <x-input-label for="kabupaten_id" :value="__('Kabupaten')" />
                                    <select id="kabupaten_id" name="kabupaten_id" class="block mt-1 w-full rounded-md border-gray-300">
                                        <option value="">- Pilih Kabupaten -</option>
                                        @foreach($kabupatens ?? [] as $kabupaten)
                                            <option value="{{ $kabupaten->id }}" {{ (string)old('kabupaten_id') === (string)$kabupaten->id ? 'selected' : '' }}>
                                                {{ $kabupaten->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <x-input-error :messages="$errors->get('kota_id')" class="mt-2" />
                            <x-input-error :messages="$errors->get('kabupaten_id')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('setup') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleWilayah(jenis) {
            const kotaBox = document.getElementById('pilihKota');
            const kabBox = document.getElementById('pilihKabupaten');
            const kotaSelect = document.getElementById('kota_id');
            const kabSelect = document.getElementById('kabupaten_id');

            if (jenis === 'kota') {
                kotaBox.classList.remove('hidden');
                kabBox.classList.add('hidden');
                kabSelect.value = '';
            } else {
                kabBox.classList.remove('hidden');
                kotaBox.classList.add('hidden');
                kotaSelect.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const jenis = document.querySelector('input[name="jenis_wilayah"]:checked')?.value;
            if (jenis) toggleWilayah(jenis);
        });
    </script>
</x-app-layout>
