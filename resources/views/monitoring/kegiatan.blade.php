<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    🚀 {{ __('Realisasi Kegiatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Tindaklanjuti rencana kegiatan yang sudah ditandai ✓</p>
            </div>
            <span class="px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">{{ $bulanLabel ?? 'Bulan Berjalan' }}</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-lg p-4 shadow-sm animate-pulse">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 text-yellow-800 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <span>{{ session('warning') }}</span>
                    </div>
                </div>
            @endif

            <!-- Filter & Action Header -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1 flex items-center gap-2">
                            <span class="text-2xl">🔍</span> Filter Bulan
                        </h3>
                        <p class="text-sm text-gray-600">Lihat kegiatan yang sudah ditandai untuk direalisasikan.</p>
                    </div>

                    <form method="GET" action="{{ route('monitoring.kegiatan') }}" class="w-full md:w-auto flex flex-col sm:flex-row items-end gap-3">
                        <div class="w-full sm:w-auto">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Bulan</label>
                            <input type="month" name="bulan" value="{{ $bulan }}"
                                class="w-full sm:w-auto px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition" />
                        </div>

                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-700 text-white rounded-lg hover:shadow-lg font-bold transition">
                            🔎 Tampilkan
                        </button>

                        <a href="{{ route('rencana.index') }}"
                            class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg font-bold transition text-center">
                            ← Kembali ke Rencana
                        </a>
                    </form>
                </div>
            </div>

            <!-- Kegiatan List untuk Realisasi -->
            @if ($kegiatans->count() > 0)
                <div class="space-y-4">
                    @foreach ($kegiatans as $kegiatan)
                        <div class="bg-white border-2 {{ $kegiatan->is_realized ? 'border-green-200 bg-green-50' : 'border-orange-200' }} rounded-xl p-6 shadow-sm hover:shadow-md transition">
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header dengan Status Badge -->
                                    <div class="flex items-start gap-3 mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h3 class="font-bold text-lg text-gray-900">{{ $kegiatan->nama_kegiatan }}</h3>
                                                @if($kegiatan->is_realized)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                        ✓ Terealisasi
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-800">
                                                        🚀 Sedang Direalisasi
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-600">{{ $kegiatan->tema }} • {{ $kegiatan->bidang }}</p>
                                        </div>
                                    </div>

                                    <!-- Grid Info -->
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4 text-sm">
                                        <div class="bg-gray-100 rounded-lg p-3">
                                            <span class="text-xs font-semibold text-gray-600 block">📅 Tanggal</span>
                                            <span class="text-gray-900 font-bold">{{ \Carbon\Carbon::parse($kegiatan->tanggal_pelaksanaan)->locale('id')->format('d M Y') }}</span>
                                        </div>
                                        <div class="bg-gray-100 rounded-lg p-3">
                                            <span class="text-xs font-semibold text-gray-600 block">👤 Pelaksana</span>
                                            <span class="text-gray-900 font-bold">{{ $kegiatan->pelaksana }}</span>
                                        </div>
                                        <div class="bg-gray-100 rounded-lg p-3">
                                            <span class="text-xs font-semibold text-gray-600 block">👥 Peserta</span>
                                            <span class="text-gray-900 font-bold">{{ $kegiatan->jumlah_peserta }} orang</span>
                                        </div>
                                        <div class="bg-gray-100 rounded-lg p-3">
                                            <span class="text-xs font-semibold text-gray-600 block">💰 Anggaran</span>
                                            <span class="text-gray-900 font-bold">Rp {{ number_format($kegiatan->anggaran, 0, ',', '.') }}</span>
                                        </div>
                                        @if($kegiatan->is_realized && $kegiatan->realized_at)
                                            <div class="bg-green-100 rounded-lg p-3">
                                                <span class="text-xs font-semibold text-green-700 block">📍 Terealisasi</span>
                                                <span class="text-green-900 font-bold">{{ \Carbon\Carbon::parse($kegiatan->realized_at)->locale('id')->format('d M Y') }}</span>
                                            </div>
                                            <div class="bg-blue-100 rounded-lg p-3">
                                                <span class="text-xs font-semibold text-blue-700 block">⏱️ Durasi</span>
                                                <span class="text-blue-900 font-bold">{{ \Carbon\Carbon::parse($kegiatan->tanggal_pelaksanaan)->diffInDays(\Carbon\Carbon::parse($kegiatan->realized_at)) }} hari</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Rentang Tanggal & Keterangan -->
                                    @if($kegiatan->is_realized && $kegiatan->realized_at)
                                        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg mb-4">
                                            <p class="text-xs font-semibold text-green-700 mb-2">📅 Rentang Pelaksanaan:</p>
                                            <p class="text-sm text-green-900 leading-relaxed font-bold">
                                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_pelaksanaan)->locale('id')->format('d M Y') }} 
                                                <span class="text-gray-600">hingga</span>
                                                {{ \Carbon\Carbon::parse($kegiatan->realized_at)->locale('id')->format('d M Y') }}
                                                <span class="inline-block ml-2 px-2 py-1 bg-green-200 text-green-800 rounded text-xs font-semibold">
                                                    {{ \Carbon\Carbon::parse($kegiatan->tanggal_pelaksanaan)->diffInDays(\Carbon\Carbon::parse($kegiatan->realized_at)) }} hari
                                                </span>
                                            </p>
                                        </div>
                                    @endif

                                    <!-- Isi Rencana Kegiatan -->
                                    @if($kegiatan->rencana_kegiatan)
                                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg mb-4">
                                            <p class="text-xs font-semibold text-blue-700 mb-2">📝 Isi Rencana Kegiatan:</p>
                                            <p class="text-sm text-blue-900 leading-relaxed">{{ $kegiatan->rencana_kegiatan }}</p>
                                        </div>
                                    @endif

                                    @if($kegiatan->keterangan)
                                        <p class="text-xs text-gray-600 italic mb-4">💬 {{ $kegiatan->keterangan }}</p>
                                    @endif

                                    <!-- Foto Section -->
                                    @if($kegiatan->is_realized)
                                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                            <h4 class="font-semibold text-gray-900 mb-3">📸 Foto Kegiatan</h4>
                                            @if($kegiatan->photos && $kegiatan->photos->count() > 0)
                                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
                                                    @foreach($kegiatan->photos as $photo)
                                                        <div class="relative group">
                                                            <img src="{{ asset('storage/' . $photo->foto_path) }}" alt="Foto" 
                                                                class="w-full h-32 object-cover rounded-lg" />
                                                            <form action="{{ route('monitoring.kegiatan.deletePhoto', $photo->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
                                                                    onclick="return confirm('Hapus foto ini?')">
                                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-sm text-gray-600 italic">Belum ada foto kegiatan</p>
                                            @endif

                                            <!-- Upload Foto Form -->
                                            <form action="{{ route('monitoring.kegiatan.uploadPhoto', $kegiatan) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                                @csrf
                                                <div class="flex gap-2">
                                                    <input type="file" name="fotos[]" accept="image/*" multiple required
                                                        class="flex-1 px-3 py-2 text-sm border-2 border-gray-300 rounded-lg file:mr-3 file:py-1 file:px-2 file:rounded file:bg-gray-200 file:text-gray-700 file:font-semibold file:cursor-pointer" />
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-sm transition">
                                                        📤 Upload
                                                    </button>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max: 5MB per file.</p>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col gap-2 w-full lg:w-auto lg:flex-shrink-0">
                                    @if(!$kegiatan->is_realized)
                                        <!-- Tombol Tandai Terealizasi -->
                                        <form action="{{ route('monitoring.kegiatan.markAsRealized', $kegiatan) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-full px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg font-semibold transition flex items-center justify-center gap-2"
                                                onclick="return confirm('Tandai kegiatan ini sebagai sudah terealisasi?')">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                <span>✓ Terealisasi</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="px-4 py-2.5 bg-green-50 border-2 border-green-200 text-green-700 rounded-lg text-center font-semibold text-sm">
                                            ✓ Sudah Terealisasi
                                        </div>
                                        
                                        <!-- Tombol Lanjut ke Laporan -->
                                        <a href="{{ route('laporan.kegiatan', ['bulan' => $kegiatan->bulan]) }}"
                                            class="w-full px-4 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:shadow-lg font-semibold transition text-center flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V6a1 1 0 00-1-1h3a1 1 0 000-2 2 2 0 01-2-2V3a1 1 0 00-1-1H4zm12.95 13H4.05V6H17v12z" clip-rule="evenodd"/></svg>
                                            📊 Lihat di Laporan
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('monitoring.kegiatan.destroy', $kegiatan) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full px-4 py-2.5 border-2 border-red-500 text-red-600 rounded-lg hover:bg-red-50 font-semibold transition"
                                                onclick="return confirm('Hapus kegiatan ini? Tindakan ini tidak bisa dibatalkan.')">
                                                ❌ Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $kegiatans->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-12 text-center shadow-sm">
                    <div class="text-6xl mb-3">📭</div>
                    <h4 class="font-bold text-xl text-gray-900 mb-2">Belum Ada Kegiatan untuk Direalisasi</h4>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">Belum ada kegiatan yang ditandai siap untuk direalisasikan di bulan {{ $bulanLabel }}. Mari buat rencana kegiatan terlebih dahulu.</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('rencana.index', ['bulan' => $bulan]) }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:shadow-lg font-bold transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L7.707 10.707a1 1 0 01-1.414-1.414l4-4z" clip-rule="evenodd"/></path></svg>
                            📋 Lihat Rencana Kegiatan
                        </a>
                        <a href="{{ route('rencana.create') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 font-bold transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/></svg>
                            ➕ Buat Rencana Baru
                        </a>
                    </div>
                </div>
            @endif

            <!-- Info Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-info-50 border border-info-200 rounded-lg p-4 text-sm">
                    <h4 class="font-semibold text-info-900 mb-2">ℹ️ Alur Proses</h4>
                    <ol class="space-y-1 text-info-800 text-xs">
                        <li class="flex items-start gap-2"><span class="font-bold">1.</span> <span>Buat rencana kegiatan</span></li>
                        <li class="flex items-start gap-2"><span class="font-bold">2.</span> <span>Tandai dengan ✓ saat siap dilaksanakan</span></li>
                        <li class="flex items-start gap-2"><span class="font-bold">3.</span> <span><strong>📍 Anda di sini:</strong> Kegiatan muncul di halaman Realisasi</span></li>
                        <li class="flex items-start gap-2"><span class="font-bold">4.</span> <span>Tandai "Sudah Terealisasi"</span></li>
                        <li class="flex items-start gap-2"><span class="font-bold">5.</span> <span>Tambah foto bukti kegiatan (optional)</span></li>
                        <li class="flex items-start gap-2"><span class="font-bold">6.</span> <span>Kegiatan masuk ke Laporan</span></li>
                    </ol>
                </div>

                <div class="bg-warning-50 border border-warning-200 rounded-lg p-4 text-sm">
                    <h4 class="font-semibold text-warning-900 mb-2">⚠️ Catatan Penting</h4>
                    <ul class="space-y-1 text-warning-800 text-xs list-disc list-inside">
                        <li>Hanya kegiatan dengan status "Sedang Direalisasi" yang ditampilkan di sini</li>
                        <li>Foto adalah optional - bisa ditambahkan setelah ditandai terealisasi</li>
                        <li>Setelah ditandai "✓ Terealisasi", kegiatan masuk ke Laporan Kegiatan</li>
                        <li>Anda bisa menambah/menghapus foto kapan saja</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
