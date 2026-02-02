<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ✏️ {{ __('Edit User') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Ubah informasi pengguna</p>
            </div>
            <a href="{{ route('setup') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-8 text-gray-900">
                    @php
                        $defaultJenis = $user->kota_id ? 'kota' : ($user->kabupaten_id ? 'kabupaten' : null);
                        $jenis = old('jenis_wilayah', $defaultJenis);
                    @endphp

                    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Name -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">👤 Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Masukkan nama lengkap" />
                            @error('name')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">📧 Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="nama@email.com" />
                            @error('email')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wilayah -->
                        <div class="border-2 border-purple-200 rounded-lg p-5 bg-gradient-to-br from-purple-50 to-pink-50">
                            <div class="font-bold text-gray-800 mb-1 flex items-center gap-2">
                                <span class="text-xl">🗺️</span> Wilayah User
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Pilih asal wilayah pengguna (Kota atau Kabupaten)</p>

                            <div class="flex flex-wrap gap-6 mb-4">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="jenis_wilayah" value="kota"
                                        {{ $jenis === 'kota' ? 'checked' : '' }}
                                        onclick="toggleWilayah('kota')" class="w-5 h-5">
                                    <span class="text-gray-700 font-medium">🏙️ Kota</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="radio" name="jenis_wilayah" value="kabupaten"
                                        {{ $jenis === 'kabupaten' ? 'checked' : '' }}
                                        onclick="toggleWilayah('kabupaten')" class="w-5 h-5">
                                    <span class="text-gray-700 font-medium">🏞️ Kabupaten</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div id="pilihKota" class="hidden">
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Pilih Kota <span class="text-red-500">*</span></label>
                                    <select id="kota_id" name="kota_id"
                                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                                        <option value="">-- Pilih Kota --</option>
                                        @foreach($kotas ?? [] as $kota)
                                            <option value="{{ $kota->id }}"
                                                {{ (string)old('kota_id', $user->kota_id) === (string)$kota->id ? 'selected' : '' }}>
                                                {{ $kota->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="pilihKabupaten" class="hidden">
                                    <label class="text-sm font-semibold text-gray-700 block mb-2">Pilih Kabupaten <span class="text-red-500">*</span></label>
                                    <select id="kabupaten_id" name="kabupaten_id"
                                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                                        <option value="">-- Pilih Kabupaten --</option>
                                        @foreach($kabupatens ?? [] as $kabupaten)
                                            <option value="{{ $kabupaten->id }}"
                                                {{ (string)old('kabupaten_id', $user->kabupaten_id) === (string)$kabupaten->id ? 'selected' : '' }}>
                                                {{ $kabupaten->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @error('kota_id')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                            @error('kabupaten_id')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🔐 Password Baru <span class="text-gray-500 font-normal">(kosongkan jika tidak ingin mengubah)</span></label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Biarkan kosong jika tidak ingin mengubah" />
                            @error('password')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🔐 Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Ulangi password baru" />
                            @error('password_confirmation')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200">
                            <a href="{{ route('setup') }}" 
                                class="inline-flex items-center gap-2 px-6 py-2.5 border-2 border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition font-bold text-sm">
                                <span>❌</span> Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-7 py-2.5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <span>💾</span> Simpan Perubahan
                            </button>
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
