<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            ✏️ {{ __('Edit Daerah') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg border-2 border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-primary-600 to-primary-600 px-6 sm:px-8 py-6 sm:py-8">
                    <h3 class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                        <span>🏛️</span> {{ $daerah->nama }}
                    </h3>
                </div>

                <form action="{{ route('daerah.update', $daerah) }}" method="POST" class="p-6 sm:p-8">
                    @csrf
                    @method('PATCH')

                    <!-- Kode Daerah -->
                    <div class="mb-6">
                        <label for="kode" class="block text-sm font-bold text-gray-700 mb-2">
                            📌 Kode Daerah <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                            id="kode" 
                            name="kode" 
                            value="{{ old('kode', $daerah->kode) }}"
                            class="w-full px-4 py-2.5 rounded-lg border-2 @error('kode') border-red-500 @else border-gray-300 @enderror focus:border-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-200 transition"
                            required>
                        @error('kode')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Daerah -->
                    <div class="mb-6">
                        <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">
                            🗺️ Nama Daerah <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                            id="nama" 
                            name="nama" 
                            value="{{ old('nama', $daerah->nama) }}"
                            class="w-full px-4 py-2.5 rounded-lg border-2 @error('nama') border-red-500 @else border-gray-300 @enderror focus:border-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-200 transition"
                            required>
                        @error('nama')
                            <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons (mobile-friendly) -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t-2 border-gray-200">
                        <a href="{{ route('daerah.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-bold text-sm">
                            <span>⬅️</span> Kembali
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                            <span>✅</span> Update Daerah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
