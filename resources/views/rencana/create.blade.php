<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ✏️ {{ __('Buat Rencana Kegiatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Isi detail rencana kegiatan yang akan dilaksanakan</p>
            </div>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ $bulanLabel ?? 'Bulan Berjalan' }}</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <form method="POST" action="{{ route('rencana.store') }}" class="space-y-6">
                    @csrf

                    <!-- Tema Utama -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            📌 Tema Utama <span class="text-red-500">*</span>
                        </label>
                        <select name="tema" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('tema') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                            <option value="" disabled {{ old('tema') ? '' : 'selected' }}>-- Pilih tema --</option>
                            <option value="kaderisasi" {{ old('tema') === 'kaderisasi' ? 'selected' : '' }}>🎓 Kaderisasi</option>
                            <option value="strukturisasi" {{ old('tema') === 'strukturisasi' ? 'selected' : '' }}>🏢 Strukturisasi</option>
                            <option value="citra partai" {{ old('tema') === 'citra partai' ? 'selected' : '' }}>⭐ Citra Partai</option>
                        </select>
                        @error('tema')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bidang -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            🏛️ Bidang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bidang" value="{{ old('bidang') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('bidang') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="Contoh: Bidang Organisasi" />
                        @error('bidang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Pelaksanaan -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            📅 Tanggal Pelaksanaan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('tanggal_pelaksanaan') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
                        @error('tanggal_pelaksanaan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Kegiatan -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            🎯 Nama Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('nama_kegiatan') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="Contoh: Rapat Koordinasi Bulanan" />
                        @error('nama_kegiatan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pelaksana -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            👤 Pelaksana <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="pelaksana" value="{{ old('pelaksana') }}" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('pelaksana') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="Nama pelaksana kegiatan" />
                        @error('pelaksana')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Peserta -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            👥 Jumlah Peserta <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="jumlah_peserta" value="{{ old('jumlah_peserta', 0) }}" min="0" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('jumlah_peserta') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" />
                        @error('jumlah_peserta')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Anggaran -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            💰 Anggaran (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="anggaran" value="{{ old('anggaran', 0) }}" min="0" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('anggaran') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="Contoh: 2500000" />
                        @error('anggaran')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan (Opsional) -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            📌 Keterangan (Opsional)
                        </label>
                        <textarea name="keterangan" rows="3"
                            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm"
                            placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a href="{{ route('rencana.index') }}"
                            class="px-6 py-2.5 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium">
                            ← Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                            ✓ Simpan & Lanjut ke Realisasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm">
                    <h4 class="font-semibold text-blue-900 mb-2">ℹ️ Alur Workflow</h4>
                    <ol class="space-y-2 text-blue-800 text-xs">
                        <li class="flex items-start gap-2"><span class="font-bold bg-blue-200 px-2 py-0.5 rounded">1</span> <span><strong>📍 Anda di sini:</strong> Isi form rencana kegiatan</span></li>
                        <li class="flex items-start gap-2"><span class="font-bold bg-green-200 px-2 py-0.5 rounded">2</span> <span>Klik <strong>"✓ Simpan & Lanjut ke Realisasi"</strong></span></li>
                        <li class="flex items-start gap-2"><span class="font-bold bg-orange-200 px-2 py-0.5 rounded">3</span> <span>Langsung masuk ke <strong>🚀 Realisasi Kegiatan</strong></span></li>
                        <li class="flex items-start gap-2"><span class="font-bold bg-purple-200 px-2 py-0.5 rounded">4</span> <span>Tandai "✓ Terealisasi" dan upload foto</span></li>
                    </ol>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 text-sm">
                    <h4 class="font-semibold text-amber-900 mb-2">⚠️ Catatan Penting</h4>
                    <ul class="space-y-1 text-amber-800 text-xs list-disc list-inside">
                        <li>Pastikan semua data sudah benar sebelum simpan</li>
                        <li>Tidak bisa mengedit setelah disimpan</li>
                        <li>Keterangan bersifat opsional</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
