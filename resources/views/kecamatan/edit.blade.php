<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ✏️ {{ __('Edit Kecamatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui data kecamatan</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200">
                <div class="bg-gradient-to-r from-primary-600 to-primary-600 p-6">
                    <h3 class="font-bold text-lg text-white">📋 Form Edit Kecamatan</h3>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('kecamatan.update', $kecamatan) }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-bold text-gray-900 mb-2">
                                📝 Nama Kecamatan
                            </label>
                            <input 
                                type="text" 
                                id="nama" 
                                name="nama" 
                                value="{{ old('nama', $kecamatan->nama) }}" 
                                placeholder="Masukkan nama kecamatan"
                                required 
                                autofocus
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary-600 focus:ring-2 focus:ring-primary-200 outline-none transition"
                            />
                            @error('nama')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <span>❌</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('kecamatan.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold">
                                ❌ Batal
                            </a>
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-600 text-white rounded-lg hover:shadow-lg transition font-bold">
                                ✅ Perbarui Kecamatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
