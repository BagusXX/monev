<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ➕ {{ __('Tambah Wilayah Baru') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pilih jenis wilayah dan masukkan informasi yang dibutuhkan</p>
            </div>
            <a href="{{ route('wilayah.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Type Selector -->
            <div class="mb-6 grid grid-cols-2 gap-4">
                <label class="relative cursor-pointer">
                    <input type="radio" name="type_selector" value="kota" class="sr-only peer" onchange="switchForm('kota')" checked>
                    <div class="p-4 bg-white border-2 border-gray-300 rounded-lg peer-checked:border-blue-600 peer-checked:bg-blue-50 transition">
                        <div class="text-2xl mb-2">🏙️</div>
                        <div class="font-bold text-gray-900">Kota</div>
                        <div class="text-sm text-gray-600">Tambah data kota</div>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="type_selector" value="kabupaten" class="sr-only peer" onchange="switchForm('kabupaten')">
                    <div class="p-4 bg-white border-2 border-gray-300 rounded-lg peer-checked:border-orange-600 peer-checked:bg-orange-50 transition">
                        <div class="text-2xl mb-2">🌍</div>
                        <div class="font-bold text-gray-900">Kabupaten</div>
                        <div class="text-sm text-gray-600">Tambah data kabupaten</div>
                    </div>
                </label>
            </div>

            <!-- Kota Form -->
            <div id="kota-form" class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('wilayah.store.kota') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🏙️ Nama Kota <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                placeholder="Masukkan nama kota" />
                            @error('nama')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200">
                            <a href="{{ route('wilayah.index') }}" 
                                class="inline-flex items-center gap-2 px-6 py-2.5 border-2 border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition font-bold text-sm">
                                <span>❌</span> Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-7 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <span>✅</span> Simpan Kota
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kabupaten Form -->
            <div id="kabupaten-form" class="hidden bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('wilayah.store.kabupaten') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label class="text-sm font-bold text-gray-700 block mb-2">🌍 Nama Kabupaten <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required autofocus
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                                placeholder="Masukkan nama kabupaten" />
                            @error('nama')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t-2 border-gray-200">
                            <a href="{{ route('wilayah.index') }}" 
                                class="inline-flex items-center gap-2 px-6 py-2.5 border-2 border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition font-bold text-sm">
                                <span>❌</span> Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-7 py-2.5 bg-gradient-to-r from-orange-600 to-amber-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                                <span>✅</span> Simpan Kabupaten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchForm(type) {
            const kotaForm = document.getElementById('kota-form');
            const kabupatenForm = document.getElementById('kabupaten-form');
            
            if (type === 'kota') {
                kotaForm.classList.remove('hidden');
                kabupatenForm.classList.add('hidden');
            } else {
                kotaForm.classList.add('hidden');
                kabupatenForm.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
