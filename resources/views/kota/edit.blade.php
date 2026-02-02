<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ✏️ {{ __('Edit Kota') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Ubah informasi kota: {{ $kota->nama }}</p>
            </div>
            <a href="{{ route('kota.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('kota.update', $kota) }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🏙️ Nama Kota <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama', $kota->nama) }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Masukkan nama kota" />
                            @error('nama')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200">
                            <a href="{{ route('kota.index') }}" 
                                class="inline-flex items-center gap-2 px-6 py-2.5 border-2 border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition font-bold text-sm">
                                <span>❌</span> Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-7 py-2.5 bg-gradient-to-r from-yellow-600 to-amber-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <span>💾</span> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

