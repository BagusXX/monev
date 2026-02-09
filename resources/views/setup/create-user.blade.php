<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ➕ {{ __('Tambah User Baru') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Buat akun pengguna baru untuk sistem</p>
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
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">👤 Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                placeholder="Masukkan nama lengkap" />
                            @error('name')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">📧 Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                placeholder="nama@email.com" />
                            @error('email')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Daerah -->
                        <div class="border-2 border-yellow-200 rounded-lg p-5 bg-gradient-to-br from-yellow-50 to-yellow-50">
                            <div class="font-bold text-gray-800 mb-1 flex items-center gap-2">
                                <span class="text-xl">🗺️</span> Daerah User
                            </div>
                            <p class="text-sm text-gray-600 mb-4">Pilih asal daerah pengguna</p>

                            <div>
                                <label class="text-sm font-semibold text-gray-700 block mb-2">Pilih Daerah <span class="text-red-500">*</span></label>
                                <select id="daerah_id" name="daerah_id"
                                    class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                                    <option value="">-- Pilih Daerah --</option>
                                    @foreach($daerahs ?? [] as $daerah)
                                        <option value="{{ $daerah->id }}" {{ (string)old('daerah_id') === (string)$daerah->id ? 'selected' : '' }}>
                                            {{ $daerah->nama }} - {{ $daerah->kode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('daerah_id')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🔐 Password <span class="text-red-500">*</span></label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                placeholder="Minimal 8 karakter" />
                            @error('password')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🔐 Konfirmasi Password <span class="text-red-500">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                placeholder="Ulangi password" />
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
                                class="inline-flex items-center gap-2 px-7 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <span>✅</span> Simpan User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>
