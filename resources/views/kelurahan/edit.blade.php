<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ✏️ {{ __('Edit Kelurahan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Ubah data kelurahan yang ada dalam sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200">
                <div class="bg-gradient-to-r from-yellow-600 to-amber-600 p-6">
                    <h3 class="font-bold text-lg text-white">📋 Form Edit Kelurahan</h3>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('kelurahan.update', $kelurahan) }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-bold text-gray-900 mb-2">
                                🏘️ Nama Kelurahan
                            </label>
                            <input 
                                type="text" 
                                id="nama"
                                name="nama"
                                value="{{ old('nama', $kelurahan->nama) }}"
                                placeholder="Masukkan nama kelurahan"
                                required 
                                autofocus
                                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition" 
                            />
                            @error('nama')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                    <span>⚠️</span> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
                            <a href="{{ route('kelurahan.index') }}" class="inline-flex items-center px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-bold transition">
                                ✕ Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-amber-600 text-white rounded-lg hover:shadow-lg font-bold transition">
                                💾 Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
