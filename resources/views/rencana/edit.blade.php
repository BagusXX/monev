<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ✏️ {{ __('Edit Rencana Kegiatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Ubah detail rencana kegiatan</p>
            </div>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ \Carbon\Carbon::parse($rencana->tanggal_pelaksanaan)->locale('id')->format('M Y') }}</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <form method="POST" action="{{ route('rencana.update', $rencana) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Tema Utama -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 block mb-2">
                            📌 Tema Utama <span class="text-red-500">*</span>
                        </label>
                        <select name="tema" required
                            class="w-full px-4 py-2.5 rounded-lg border-2 {{ $errors->has('tema') ? 'border-red-500' : 'border-gray-300' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                            <option value="" disabled>-- Pilih tema --</option>
                            <option value="kaderisasi" {{ $rencana->tema === 'kaderisasi' ? 'selected' : '' }}>🎓 Kaderisasi</option>
                            <option value="strukturisasi" {{ $rencana->tema === 'strukturisasi' ? 'selected' : '' }}>🏢 Strukturisasi</option>
                            <option value="citra partai" {{ $rencana->tema === 'citra partai' ? 'selected' : '' }}>⭐ Citra Partai</option>
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
                        <input type="text" name="bidang" value="{{ $rencana->bidang }}" required
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
                        <input type="date" name="tanggal_pelaksanaan" value="{{ $rencana->tanggal_pelaksanaan->format('Y-m-d') }}" required
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
                        <input type="text" name="nama_kegiatan" value="{{ $rencana->nama_kegiatan }}" required
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
                        <input type="text" name="pelaksana" value="{{ $rencana->pelaksana }}" required
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
                        <input type="number" name="jumlah_peserta" value="{{ $rencana->jumlah_peserta }}" min="0" required
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
                        <input type="number" name="anggaran" value="{{ $rencana->anggaran }}" min="0" required
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
                            placeholder="Catatan tambahan...">{{ $rencana->keterangan }}</textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a href="{{ route('rencana.index') }}"
                            class="px-6 py-2.5 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-medium">
                            ← Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg transition font-semibold">
                            ✓ Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Section -->
            <div class="mt-8 bg-info-50 border border-info-200 rounded-lg p-4 text-sm">
                <h4 class="font-semibold text-info-900 mb-2">ℹ️ Info Penting</h4>
                <ul class="space-y-1 text-info-800 text-xs list-disc list-inside">
                    <li>Anda hanya bisa mengedit rencana yang belum ditandai ✓</li>
                    <li>Setelah ditandai ✓, rencana tidak bisa diubah lagi</li>
                    <li>Pastikan semua data terisi dengan benar sebelum menyimpan</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
