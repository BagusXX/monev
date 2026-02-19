<div class="bg-white border-2 border-gray-200 rounded-xl overflow-hidden shadow-lg print:shadow-none">
    <div class="p-6">
        <h3 class="font-bold text-lg text-gray-900 mb-1">📋 Daftar Rapat</h3>
        <p class="text-sm text-gray-600 mb-6">Isi laporan mengikuti pertanyaan pada form monitoring</p>
    </div>

    <!-- Desktop/Table view -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-primary-600 to-primary-600 text-white">
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">No</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Nama User</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Daerah</th>
                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold">Tanggal Pengisian</th>
                    <th class="border border-gray-300 px-4 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rapats as $index => $rapat)
                    <tr class="hover:bg-primary-50 transition border-b border-gray-200">
                        <td class="border border-gray-300 px-4 py-3 text-gray-700 font-semibold">{{ $rapats->firstItem() + $index }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            <div class="font-semibold">{{ $rapat->user?->name ?? ($rapat->pengisi_nama ?? 'Tidak diketahui') }}</div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            @if($rapat->daerah)
                                <span class="inline-block bg-primary-100 text-primary-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $rapat->daerah->nama }} - {{ $rapat->daerah->kode }}</span>
                            @elseif($rapat->user?->daerah)
                                <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $rapat->user->daerah->nama }} - {{ $rapat->user->daerah->kode }}</span>
                            @else
                                <span class="text-gray-500 italic">-</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-700">
                            <div class="text-sm">
                                {{ $rapat->tanggal?->format('d/m/Y') ?? '-' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $rapat->waktu ? '⏱️ ' . substr($rapat->waktu, 0, 5) : '⏱️ ' . ($rapat->created_at?->format('H:i') ?? '-') }}
                            </div>
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center">
                            <div class="inline-flex gap-2">
                                <button type="button" onclick="openDetailModal({{ $rapat->id }})" 
                                    class="px-3 py-1 bg-gradient-to-r from-primary-500 to-primary-500 text-white rounded-lg hover:shadow-lg font-semibold transition text-sm">
                                    📋 Detail
                                </button>

                                <form method="POST" action="{{ route('monitoring.rapat.destroy', $rapat) }}" onsubmit="return confirm('Hapus laporan rapat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:shadow-lg font-semibold transition text-sm">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <div class="text-4xl mb-2">📭</div>
                            <p class="text-sm">Belum ada data rapat untuk bulan <span class="font-semibold">{{ $bulanLabel ?? ($bulan ?? 'ini') }}</span> daerah <span class="font-semibold">{{ $daerahName ?? 'Semua Daerah' }}</span>.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile/List view -->
    <div class="sm:hidden px-6 py-4 space-y-3">
        @forelse ($rapats as $index => $rapat)
            <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div class="flex-1">
                        <div class="text-xs text-gray-500 mb-1">📍 No. {{ $rapats->firstItem() + $index }}</div>
                        <div class="font-semibold text-gray-900 mb-2">{{ $rapat->user?->name ?? ($rapat->pengisi_nama ?? 'Tidak diketahui') }}</div>
                        <div>
                            @if($rapat->daerah)
                                <span class="inline-block bg-primary-100 text-primary-800 px-2 py-0.5 rounded text-xs font-semibold">{{ $rapat->daerah->nama }}</span>
                            @elseif($rapat->user?->daerah)
                                <span class="inline-block bg-gray-100 text-gray-800 px-2 py-0.5 rounded text-xs font-semibold">{{ $rapat->user->daerah->nama }}</span>
                            @else
                                <span class="text-gray-500 text-xs italic">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-300 pt-3 mb-3">
                    <div class="text-xs text-gray-600 mb-1">
                        📅 {{ $rapat->tanggal?->format('d/m/Y') ?? '-' }}
                    </div>
                    <div class="text-xs text-gray-600">
                        ⏱️ {{ $rapat->waktu ? substr($rapat->waktu, 0, 5) : ($rapat->created_at?->format('H:i') ?? '-') }} WIB
                    </div>
                </div>

                <div class="space-y-2">
                    <button type="button" onclick="openDetailModal({{ $rapat->id }})"
                        class="w-full px-3 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-lg hover:shadow-lg font-semibold transition text-sm">
                        📋 Detail
                    </button>

                    <form method="POST" action="{{ route('monitoring.rapat.destroy', $rapat) }}" onsubmit="return confirm('Hapus laporan rapat ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:shadow-lg font-semibold transition text-sm">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-6 text-center">
                <div class="text-4xl mb-2">📭</div>
                <p class="text-sm text-gray-600">Belum ada data rapat untuk bulan <span class="font-semibold">{{ $bulanLabel ?? ($bulan ?? 'ini') }}</span> daerah <span class="font-semibold">{{ $daerahName ?? 'Semua Daerah' }}</span>.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6 px-6 pb-6 print:hidden border-t pt-4">
        {{ $rapats->links() }}
    </div>
</div>
