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
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">📅 Tanggal Pelaksanaan</div>
                                <div class="text-gray-900">{{ optional($kegiatan->tanggal_pelaksanaan)?->format('d-m-Y') ?? '-' }}</div>
                            </div>

                            <div class="p-3 bg-white rounded-lg border border-gray-200">
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">🎯 Nama Kegiatan</div>
                                <div class="text-gray-900">{{ $kegiatan->nama_kegiatan }}</div>
                            </div>

                            <div class="p-3 bg-white rounded-lg border border-gray-200">
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">🏛️ Bidang</div>
                                <div class="text-gray-900">{{ $kegiatan->bidang ?? '-' }}</div>
                            </div>

                            <div class="p-3 bg-white rounded-lg border border-gray-200">
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">👤 Pelaksana</div>
                                <div class="text-gray-900">{{ $kegiatan->pelaksana ?? '-' }}</div>
                            </div>

                            <div class="p-3 bg-white rounded-lg border border-gray-200">
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">👥 Peserta</div>
                                <div class="text-gray-900">{{ number_format($kegiatan->jumlah_peserta ?? 0, 0, ',', '.') }} orang</div>
                            </div>

                            <div class="p-3 bg-white rounded-lg border border-gray-200">
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">💰 Anggaran</div>
                                <div class="text-gray-900 font-semibold">Rp {{ number_format($kegiatan->anggaran ?? 0, 0, ',', '.') }}</div>
                            </div>

                            <div class="p-3 bg-white rounded-lg border border-gray-200 col-span-1 sm:col-span-2">
                                <div class="text-xs font-bold text-primary-700 uppercase mb-1">📝 Keterangan / Uraian</div>
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
