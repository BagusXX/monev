<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    📊 {{ __('Laporan Kegiatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pantau dan analisis kegiatan bulanan</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- tombol cetak disembunyikan --}}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-r-lg p-4 print:hidden flex items-start gap-3">
                    <span class="text-xl">✅</span>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 shadow-lg print:shadow-none">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 print:hidden">
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">🔍 Filter Bulan</h3>
                        <p class="text-sm text-gray-500 mt-1">Pilih bulan untuk melihat laporan kegiatan.</p>
                    </div>

                    <form method="GET" action="{{ route('laporan.kegiatan') }}" class="flex items-end gap-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Bulan</label>
                            <input type="month" name="bulan" value="{{ $bulan }}"
                                class="px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" />
                        </div>
                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg font-bold transition">
                            🔎 Tampilkan
                        </button>
                    </form>
                </div>

                @php
                    try {
                        $dt = \Carbon\Carbon::createFromFormat('Y-m-d', ($bulan ?: now()->format('Y-m')) . '-01', config('app.timezone'));
                        $bulanLabel = $dt->locale('id')->translatedFormat('F Y');
                    } catch (\Throwable $e) {
                        $bulanLabel = $bulan;
                    }
                @endphp

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        📆 Periode: <span class="font-bold text-gray-900">{{ $bulanLabel }}</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-6 rounded-xl bg-gradient-to-br from-emerald-50 to-green-50 border-2 border-emerald-200 shadow-md hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold text-emerald-700">💰 Total Anggaran</div>
                                <div class="text-3xl font-bold text-emerald-900 mt-1">Rp {{ number_format($totalAnggaran ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="text-5xl opacity-20">💵</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 shadow-lg print:shadow-none">
                <h3 class="font-bold text-lg text-gray-900 mb-1">📋 Daftar Kegiatan</h3>
                <p class="text-sm text-gray-600 mb-6">Total kegiatan yang tercatat untuk bulan ini</p>

                <div class="space-y-4">
                    @forelse ($kegiatans as $kegiatan)
                        <div class="border-2 border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-4">
                                <div>
                                    <div class="text-sm font-bold text-gray-900 text-lg">📌 {{ ucfirst($kegiatan->tema) }}</div>
                                </div>

                                <div class="text-sm text-gray-700 text-right">
                                    <div class="font-semibold">👤 Diisi oleh: {{ optional($kegiatan->user)->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 mt-1">📝 Input: {{ $kegiatan->created_at?->format('d-m-Y H:i') ?? '-' }}</div>
                                </div>
                            </div>

                            <details class="group border-2 border-gray-200 rounded-lg">
                                <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition">
                                    <div class="text-sm text-gray-800 font-semibold">📂 Lihat Rincian Kegiatan</div>
                                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>

                                <div class="p-4 border-t-2 border-gray-200 bg-gray-50">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-800">
                                        <div class="p-3 bg-white rounded-lg border border-gray-200">
                                            <div class="text-xs font-bold text-blue-700 uppercase mb-1">📅 Tanggal Pelaksanaan</div>
                                            <div class="text-gray-900">{{ optional($kegiatan->tanggal_pelaksanaan)?->format('d-m-Y') ?? '-' }}</div>
                                        </div>

                                        <div class="p-3 bg-white rounded-lg border border-gray-200">
                                            <div class="text-xs font-bold text-blue-700 uppercase mb-1">🎯 Nama Kegiatan</div>
                                            <div class="text-gray-900">{{ $kegiatan->nama_kegiatan }}</div>
                                        </div>

                                        <div class="p-3 bg-white rounded-lg border border-gray-200">
                                            <div class="text-xs font-bold text-blue-700 uppercase mb-1">👨‍💼 Penanggung Jawab</div>
                                            <div class="text-gray-900">{{ $kegiatan->penanggung_jawab }}</div>
                                        </div>

                                        <div class="p-3 bg-white rounded-lg border border-gray-200">
                                            <div class="text-xs font-bold text-blue-700 uppercase mb-1">👥 Peserta</div>
                                            <div class="text-gray-900">{{ number_format($kegiatan->jumlah_peserta ?? 0, 0, ',', '.') }} orang</div>
                                        </div>

                                        <div class="p-3 bg-white rounded-lg border border-gray-200">
                                            <div class="text-xs font-bold text-blue-700 uppercase mb-1">💰 Anggaran</div>
                                            <div class="text-gray-900 font-semibold">Rp {{ number_format($kegiatan->anggaran ?? 0, 0, ',', '.') }}</div>
                                        </div>

                                        <div class="p-3 bg-white rounded-lg border border-gray-200 col-span-1 sm:col-span-2">
                                            <div class="text-xs font-bold text-blue-700 uppercase mb-1">📝 Keterangan / Uraian</div>
                                            <div class="whitespace-pre-line text-sm text-gray-700">
                                                {{ $kegiatan->uraian ?? 'Tidak ada keterangan tambahan.' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </details>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center bg-gray-50 border-2 border-gray-200 rounded-lg">
                            <div class="text-4xl mb-2">📭</div>
                            <p class="text-sm text-gray-500">Belum ada data kegiatan untuk bulan ini.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 print:hidden border-t pt-4">
                    {{ $kegiatans->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body { background: white !important; }
        }

        details[open] summary svg {
            transform: rotate(180deg);
        }

        summary::-webkit-details-marker { display: none; }
    </style>
</x-app-layout>