<div class="bg-white border-2 border-gray-200 rounded-xl overflow-hidden shadow-lg print:shadow-none">
    <div class="p-6">
        <h3 class="font-bold text-lg text-gray-900 mb-1">📋 Daftar Kegiatan</h3>
        <p class="text-sm text-gray-600 mb-6">Total kegiatan yang tercatat untuk bulan ini</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-primary-600 to-primary-600 text-white">
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">No</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Tema</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Nama Kegiatan</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Nama User</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Tanggal Pelaksanaan</th>
                    <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kegiatans as $index => $kegiatan)
                    <tr class="hover:bg-primary-50 transition border-b border-gray-200">
                        <td class="border border-gray-300 px-4 py-3 text-gray-700 font-semibold">{{ $kegiatans->firstItem() + $index }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            <div class="font-semibold">{{ ucfirst($kegiatan->tema) }}</div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            <div class="text-sm">{{ $kegiatan->nama_kegiatan }}</div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            <div class="font-semibold">{{ optional($kegiatan->user)->name ?? '-' }}</div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            <div class="text-sm">
                                {{ optional($kegiatan->tanggal_pelaksanaan)?->format('d/m/Y') ?? '-' }}
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <button type="button" onclick="openKegiatanDetailModal({{ $kegiatan->id }})" 
                                class="px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-500 text-white rounded-lg hover:shadow-lg font-semibold transition text-sm">
                                📋 Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <div class="text-4xl mb-2">📭</div>
                            <p class="text-sm">Belum ada data kegiatan untuk bulan <span class="font-semibold">{{ $bulanLabel ?? ($bulan ?? 'ini') }}</span> daerah <span class="font-semibold">{{ $daerahName ?? 'Semua Daerah' }}</span>.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 px-6 pb-6 print:hidden border-t pt-4">
        {{ $kegiatans->links() }}
    </div>
</div>
