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

                    <form id="kegiatanFilterForm" method="GET" action="{{ route('laporan.kegiatan') }}" class="flex items-end gap-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Bulan</label>
                            <input type="month" name="bulan" value="{{ $bulan }}"
                                class="px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">🏷️ Daerah</label>
                            <select name="daerah" class="px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition">
                                <option value="">Semua Daerah</option>
                                @foreach($daerahs as $d)
                                    <option value="{{ $d->id }}" {{ (isset($daerahId) && $daerahId == $d->id) ? 'selected' : '' }}>{{ $d->nama }} - {{ $d->kode }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-amber-600 text-white rounded-lg hover:shadow-lg font-bold transition">
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
            </div>

            <div id="kegiatanResults">
                @include('laporan.partials.kegiatan_list')
            </div>

            {{-- Detail Modal --}}
            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-gradient-to-r from-primary-600 to-primary-600 text-white p-6 flex items-center justify-between">
                        <h3 class="font-bold text-lg">📄 Detail Kegiatan</h3>
                        <button onclick="closeKegiatanDetailModal()" class="text-white hover:bg-white/20 p-2 rounded-lg transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="detailContent" class="p-6 space-y-6">
                        <!-- Content will be loaded here -->
                    </div>
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

    <script>
        // Data kegiatans untuk detail modal
        let kegiatansData = {!! json_encode($kegiatans->map(function($kegiatan) {
            $tanggalPelaksanaan = $kegiatan->tanggal_pelaksanaan;
            if (is_string($tanggalPelaksanaan) && $tanggalPelaksanaan) {
                $tanggalPelaksanaan = \Carbon\Carbon::createFromFormat('Y-m-d', $tanggalPelaksanaan)?->format('d/m/Y') ?? $tanggalPelaksanaan;
            } elseif ($tanggalPelaksanaan) {
                $tanggalPelaksanaan = $tanggalPelaksanaan->format('d/m/Y');
            } else {
                $tanggalPelaksanaan = '-';
            }
            
            return [
                'id' => $kegiatan->id,
                'tema' => $kegiatan->tema,
                'nama_kegiatan' => $kegiatan->nama_kegiatan,
                'tanggal_pelaksanaan' => $tanggalPelaksanaan,
                'user_name' => $kegiatan->user?->name ?? '-',
                'bidang' => $kegiatan->bidang ?? '-',
                'pelaksana' => $kegiatan->pelaksana ?? '-',
                'jumlah_peserta' => $kegiatan->jumlah_peserta ?? 0,
                'anggaran' => $kegiatan->anggaran ?? 0,
                'uraian' => $kegiatan->uraian ?? 'Tidak ada keterangan tambahan.',
            ];
        })->keyBy('id')) !!};

        function openKegiatanDetailModal(kegiatanId) {
            const kegiatan = kegiatansData[kegiatanId];
            if (!kegiatan) return;

            const html = `
                <div class="space-y-6">
                    <div class="bg-primary-50 border-l-4 border-primary-500 p-4 rounded">
                        <p class="text-xs text-gray-500">Tema Kegiatan</p>
                        <p class="font-bold text-lg text-gray-900">${kegiatan.tema}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-xs text-gray-500">Nama Kegiatan</p>
                            <p class="font-semibold text-gray-900">${kegiatan.nama_kegiatan}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-xs text-gray-500">Tanggal Pelaksanaan</p>
                            <p class="font-semibold text-gray-900">${kegiatan.tanggal_pelaksanaan}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-xs text-gray-500">Nama User</p>
                            <p class="font-semibold text-gray-900">${kegiatan.user_name}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-xs text-gray-500">Bidang</p>
                            <p class="font-semibold text-gray-900">${kegiatan.bidang}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-xs text-gray-500">Pelaksana</p>
                            <p class="font-semibold text-gray-900">${kegiatan.pelaksana}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <p class="text-xs text-gray-500">Jumlah Peserta</p>
                            <p class="font-semibold text-gray-900">${new Intl.NumberFormat('id-ID').format(kegiatan.jumlah_peserta)} orang</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-xs text-gray-500">Anggaran</p>
                        <p class="font-bold text-lg text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(kegiatan.anggaran)}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-xs text-gray-500">Keterangan / Uraian</p>
                        <div class="whitespace-pre-line text-sm text-gray-700 mt-2">${kegiatan.uraian}</div>
                    </div>
                </div>
            `;

            document.getElementById('detailContent').innerHTML = html;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeKegiatanDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeKegiatanDetailModal();
            }
        });

        (function(){
            const form = document.getElementById('kegiatanFilterForm');
            const results = document.getElementById('kegiatanResults');

            if (!form || !results) return;

            async function fetchAndReplace(url) {
                try {
                    const res = await fetch(url, { 
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const html = await res.text();
                    
                    // Extract kegiatan data from response
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const buttons = doc.querySelectorAll('button[onclick*="openKegiatanDetailModal"]');
                    
                    // Update kegiatansData from current page
                    buttons.forEach(btn => {
                        const kegiatanId = btn.getAttribute('onclick').match(/\d+/)[0];
                        const row = btn.closest('tr');
                        if (row) {
                            const cells = row.querySelectorAll('td');
                            if (cells.length >= 6) {
                                kegiatansData[kegiatanId] = {
                                    id: kegiatanId,
                                    tema: cells[1].textContent.trim(),
                                    nama_kegiatan: cells[2].textContent.trim(),
                                    user_name: cells[3].textContent.trim(),
                                    tanggal_pelaksanaan: cells[4].textContent.trim(),
                                    bidang: cells[4]?.textContent?.trim() || '-',
                                    pelaksana: '-',
                                    jumlah_peserta: 0,
                                    anggaran: 0,
                                    uraian: ''
                                };
                            }
                        }
                    });
                    
                    results.innerHTML = html;
                    attachPaginationHandlers();
                    attachDetailButtons();
                } catch (e) {
                    console.error(e);
                }
            }

            function attachDetailButtons() {
                results.querySelectorAll('button[onclick*="openKegiatanDetailModal"]').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const match = this.getAttribute('onclick').match(/\d+/);
                        if (match) {
                            openKegiatanDetailModal(match[0]);
                        }
                    });
                });
            }

            form.addEventListener('submit', function(e){
                e.preventDefault();
                const data = new FormData(form);
                const url = new URL(form.action, location.origin);
                for (const [k,v] of data.entries()) url.searchParams.set(k, v);
                fetchAndReplace(url.toString());
                history.pushState({}, '', url);
            });

            function attachPaginationHandlers(){
                results.querySelectorAll('.pagination a').forEach(a=>{
                    a.addEventListener('click', function(ev){
                        ev.preventDefault();
                        fetchAndReplace(a.href);
                        history.pushState({}, '', a.href);
                    });
                });
            }

            attachPaginationHandlers();
            attachDetailButtons();
        })();
    </script>
</x-app-layout>
