<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    📊 {{ __('Laporan Rapat') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Pantau dan analisis rapat bulanan</p>
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
                        <p class="text-sm text-gray-500 mt-1">Pilih bulan untuk melihat laporan rapat.</p>
                    </div>

                    <form method="GET" action="{{ route('laporan.rapat') }}" class="flex items-end gap-3">
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
                        $bulanLabel = \Carbon\Carbon::createFromFormat('Y-m', $bulan)
                            ->locale('id')
                            ->translatedFormat('F Y');
                    } catch (\Throwable $e) {
                        $bulanLabel = $bulan;
                    }
                @endphp

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        📆 Periode: <span class="font-bold text-gray-900">{{ $bulanLabel }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-200 rounded-xl p-6 shadow-lg print:shadow-none">
                <h3 class="font-bold text-lg text-gray-900 mb-1">📋 Monitoring Rapat Bulan {{ $bulanLabel }}</h3>
                <p class="text-sm text-gray-600 mb-6">Isi laporan mengikuti pertanyaan pada form monitoring</p>

                <div class="space-y-4">
                    @forelse ($rapats as $rapat)
                        <div class="border-2 border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                                <div class="font-bold text-gray-900 text-lg">
                                    📅 {{ $rapat->tanggal?->format('d/m/Y') }}
                                    <span class="text-gray-500 font-normal text-sm ml-2">
                                        🕐 {{ $rapat->waktu ? substr($rapat->waktu, 0, 5) : ($rapat->created_at?->format('H:i') ?? '-') }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-700">
                                    <div class="font-semibold">👤 Diisi oleh: <span class="text-gray-900">{{ $rapat->user?->name ?? ($rapat->pengisi_nama ?? 'Tidak diketahui') }}</span></div>
                                    @if($rapat->kota)
                                        <div class="text-xs text-gray-500 mt-1">🏙️ Kota: <span class="font-semibold">{{ $rapat->kota->nama }}</span></div>
                                    @elseif($rapat->kabupaten)
                                        <div class="text-xs text-gray-500 mt-1">🗺️ Kabupaten: <span class="font-semibold">{{ $rapat->kabupaten->nama }}</span></div>
                                    @elseif($rapat->user)
                                        <div class="text-xs text-gray-500 mt-1">📍 {{ $rapat->user->wilayah_label }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 space-y-3">
                                {{-- Question 1 --}}
                                <details class="group border-2 border-gray-200 rounded-lg">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="font-semibold text-gray-800">❓ 1. Apakah ada rapat DPTD?</div>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="{{ $rapat->rapat_dptd ? 'text-green-600 font-bold' : 'text-gray-500' }}">
                                                {{ $rapat->rapat_dptd ? '✅ Iya' : '❌ Tidak' }}
                                            </div>
                                            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </summary>

                                    <div class="p-4 border-t-2 border-gray-200 bg-gray-50">
                                        @if ($rapat->rapat_dptd && $rapat->uraian_dptd)
                                            <div class="text-sm text-gray-700 whitespace-pre-line p-3 bg-white rounded border border-gray-200">{{ $rapat->uraian_dptd }}</div>
                                        @else
                                            <div class="text-sm text-gray-500 italic">Tidak ada keterangan tambahan.</div>
                                        @endif
                                    </div>
                                </details>

                                {{-- Question 2 --}}
                                <details class="group border-2 border-gray-200 rounded-lg">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="font-semibold text-gray-800">❓ 2. Apakah ada rapat PH DPD (KSB & KABID)?</div>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="{{ $rapat->rapat_phdpd ? 'text-green-600 font-bold' : 'text-gray-500' }}">
                                                {{ $rapat->rapat_phdpd ? '✅ Iya' : '❌ Tidak' }}
                                            </div>
                                            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </summary>

                                    <div class="p-4 border-t-2 border-gray-200 bg-gray-50">
                                        @if ($rapat->rapat_phdpd && $rapat->uraian_phdpd)
                                            <div class="text-sm text-gray-700 whitespace-pre-line p-3 bg-white rounded border border-gray-200">{{ $rapat->uraian_phdpd }}</div>
                                        @else
                                            <div class="text-sm text-gray-500 italic">Tidak ada keterangan tambahan.</div>
                                        @endif
                                    </div>
                                </details>

                                {{-- Question 3 --}}
                                <details class="group border-2 border-gray-200 rounded-lg">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="font-semibold text-gray-800">❓ 3. Apakah ada rapat pimpinan (KSB DPD & KSB DPC)?</div>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="{{ $rapat->rapat_pimpinan ? 'text-green-600 font-bold' : 'text-gray-500' }}">
                                                {{ $rapat->rapat_pimpinan ? '✅ Iya' : '❌ Tidak' }}
                                            </div>
                                            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </summary>

                                    <div class="p-4 border-t-2 border-gray-200 bg-gray-50">
                                        @if ($rapat->rapat_pimpinan && $rapat->uraian_pimpinan)
                                            <div class="text-sm text-gray-700 whitespace-pre-line p-3 bg-white rounded border border-gray-200">{{ $rapat->uraian_pimpinan }}</div>
                                        @else
                                            <div class="text-sm text-gray-500 italic">Tidak ada keterangan tambahan.</div>
                                        @endif
                                    </div>
                                </details>

                                {{-- Question 4 --}}
                                <details class="group border-2 border-gray-200 rounded-lg">
                                    <summary class="flex items-center justify-between p-4 cursor-pointer hover:bg-gray-50 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="font-semibold text-gray-800">❓ 4. Apakah ada rapat bidang (KSB dengan bidang tertentu)?</div>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="{{ $rapat->rapat_bidang ? 'text-green-600 font-bold' : 'text-gray-500' }}">
                                                {{ $rapat->rapat_bidang ? '✅ Iya' : '❌ Tidak' }}
                                            </div>
                                            <svg class="w-5 h-5 text-gray-500 transition-transform duration-200 group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </summary>

                                    <div class="p-4 border-t-2 border-gray-200 bg-gray-50">
                                        @if ($rapat->rapat_bidang && $rapat->uraian_bidang)
                                            <div class="text-sm text-gray-700 whitespace-pre-line p-3 bg-white rounded border border-gray-200">{{ $rapat->uraian_bidang }}</div>
                                        @else
                                            <div class="text-sm text-gray-500 italic">Tidak ada keterangan tambahan.</div>
                                        @endif
                                    </div>
                                </details>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center bg-gray-50 border-2 border-gray-200 rounded-lg">
                            <div class="text-4xl mb-2">📭</div>
                            <p class="text-sm text-gray-500">Belum ada data rapat untuk bulan ini.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 print:hidden border-t pt-4">
                    {{ $rapats->links() }}
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
