<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    � {{ __('Buat Rencana Kegiatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Isi form untuk membuat rencana kegiatan baru, kemudian langsung masuk ke halaman realisasi</p>
            </div>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">{{ $bulanLabel ?? 'Bulan Berjalan' }}</span>
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

            @if (session('error'))
                <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Create Button -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1">✏️ Buat Rencana Kegiatan Baru</h3>
                        <p class="text-sm text-gray-600">Isi form untuk membuat rencana kegiatan</p>
                    </div>
                    <a href="{{ route('rencana.create') }}"
                        class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:shadow-lg font-bold transition">
                        ➕ Buat Rencana
                    </a>
                </div>
            </div>

            <!-- Rencana List -->
            @if ($rencanas->count() > 0)
                <div class="bg-blue-50 border-l-4 border-blue-400 rounded-r-lg p-6 mb-6">
                    <p class="text-sm text-blue-900"><strong>ℹ️ Info:</strong> Rencana kegiatan Anda di bawah ini sudah tersimpan dan masuk ke halaman Realisasi. Silakan buka halaman <strong>🚀 Realisasi Kegiatan</strong> untuk melanjutkan proses.</p>
                </div>
                <div class="space-y-3">
                    @foreach ($rencanas as $rencana)
                        <div class="bg-white border-l-4 border-blue-300 p-4 shadow-sm rounded-r">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $rencana->nama_kegiatan }}</h3>
                                    <p class="text-xs text-gray-600">📅 {{ \Carbon\Carbon::parse($rencana->tanggal_pelaksanaan)->locale('id')->format('d M Y') }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                    📋 Tersimpan
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $rencanas->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-12 text-center shadow-sm">
                    <a href="{{ route('rencana.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:shadow-lg font-bold transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/></svg>
                        ➕ Buat Rencana Kegiatan
                    </a>
                </div>
            @endif

            <!-- Info Section -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm">
                <h4 class="font-semibold text-blue-900 mb-2">ℹ️ Alur Workflow</h4>
                <ol class="space-y-2 text-blue-800 text-xs">
                    <li class="flex items-start gap-2"><span class="font-bold bg-blue-200 px-2 py-0.5 rounded">1</span> <span>Klik <strong>"➕ Buat Rencana"</strong> dan isi form kegiatan</span></li>
                    <li class="flex items-start gap-2"><span class="font-bold bg-blue-200 px-2 py-0.5 rounded">2</span> <span>Setelah submit, langsung masuk ke halaman <strong>🚀 Realisasi Kegiatan</strong></span></li>
                    <li class="flex items-start gap-2"><span class="font-bold bg-green-200 px-2 py-0.5 rounded">3</span> <span>Tandai kegiatan "✓ Terealisasi" dan upload foto (opsional)</span></li>
                    <li class="flex items-start gap-2"><span class="font-bold bg-orange-200 px-2 py-0.5 rounded">4</span> <span>Kegiatan masuk ke halaman <strong>📊 Laporan Kegiatan</strong></span></li>
                </ol>
            </div>
        </div>
    </div>
</x-app-layout>
