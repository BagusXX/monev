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

                    <form id="kegiatanFilterForm" method="GET" action="{{ route('laporan.kegiatan') }}" class="w-full md:w-auto flex flex-col sm:flex-row items-end gap-3">
                        <div class="w-full sm:w-auto">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Bulan</label>
                            <input type="month" name="bulan" value="{{ $bulan }}"
                                class="w-full sm:w-auto px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition" />
                        </div>

                        <div class="w-full sm:w-auto">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">🏷️ Daerah</label>
                            <select name="daerah" class="w-full sm:w-auto px-4 py-2.5 border-2 border-gray-300 rounded-lg focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition">
                                <option value="">Semua Daerah</option>
                                @foreach($daerahs as $d)
                                    <option value="{{ $d->id }}" {{ (isset($daerahId) && $daerahId == $d->id) ? 'selected' : '' }}>{{ $d->nama }} - {{ $d->kode }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-amber-600 text-white rounded-lg hover:shadow-lg font-bold transition">
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
                'tanggal_pengisian' => $kegiatan->created_at?->format('d/m/Y H:i') ?? '-',
                'user_name' => $kegiatan->user?->name ?? '-',
                'daerah_label' => $kegiatan->user?->daerah_label ?? '-',
                'bidang' => $kegiatan->bidang ?? '-',
                'pelaksana' => $kegiatan->pelaksana ?? '-',
                'jumlah_peserta' => $kegiatan->jumlah_peserta ?? 0,
                'anggaran' => $kegiatan->anggaran ?? 0,
                'foto' => $kegiatan->foto ? str_replace('\\', '/', $kegiatan->foto) : null,
                'photos' => $kegiatan->photos->map(fn($p) => str_replace('\\', '/', $p->foto_path))->toArray(),
                'keterangan' => $kegiatan->keterangan ?? 'Tidak ada keterangan tambahan.',
            ];
        })->keyBy('id')) !!};

        function openKegiatanDetailModal(kegiatanId) {
            const kegiatan = kegiatansData[kegiatanId];
            if (!kegiatan) return;

            let fotoHtml;
            if (kegiatan.photos && kegiatan.photos.length > 0) {
                fotoHtml = `<div class="grid grid-cols-2 gap-3">` +
                    kegiatan.photos.map(photo => 
                        `<img src="/storage/${photo}" alt="Dokumentasi Kegiatan" class="w-full h-32 object-cover rounded-lg border border-gray-300 cursor-pointer" onclick="window.open('/storage/${photo}', '_blank')">`
                    ).join('') +
                    `</div>`;
            } else if (kegiatan.foto) {
                fotoHtml = `<img src="/storage/${kegiatan.foto}" alt="Dokumentasi Kegiatan" class="w-full h-auto rounded-lg border border-gray-300">`;
            } else {
                fotoHtml = `<p class="text-sm text-gray-400 italic">Tidak ada foto dokumentasi</p>`;
            }

            const html = `
                <div class="space-y-3">
                    <!-- Informasi Pengguna & Daerah -->
                    <div class="space-y-2 pb-3 border-b border-gray-200">
                        <div>
                            <p class="text-xs text-gray-500 font-medium">👤 Nama User</p>
                            <p class="text-sm font-semibold text-gray-900">${kegiatan.user_name}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">🗺️ Daerah</p>
                            <p class="text-sm font-semibold text-gray-900">${kegiatan.daerah_label}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">📅 Tanggal Pengisian</p>
                            <p class="text-sm font-semibold text-gray-900">${kegiatan.tanggal_pengisian}</p>
                        </div>
                    </div>

                    <!-- Tema -->
                    <div>
                        <p class="text-sm text-gray-500 font-medium">📌 Tema Kegiatan</p>
                        <p class="text-2xl font-bold text-gray-900">${kegiatan.tema}</p>
                    </div>

                    <!-- Detail Kegiatan Grid -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">🎯 Nama Kegiatan</p>
                            <p class="text-base font-bold text-gray-900">${kegiatan.nama_kegiatan}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">📅 Tanggal Pelaksanaan</p>
                            <p class="text-base font-bold text-gray-900">${kegiatan.tanggal_pelaksanaan}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">🏛️ Bidang</p>
                            <p class="text-base font-bold text-gray-900">${kegiatan.bidang}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">👥 Pelaksana</p>
                            <p class="text-base font-bold text-gray-900">${kegiatan.pelaksana}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">👫 Jumlah Peserta</p>
                            <p class="text-base font-bold text-gray-900">${new Intl.NumberFormat('id-ID').format(kegiatan.jumlah_peserta)} orang</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">💰 Anggaran</p>
                            <p class="text-lg font-bold text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(kegiatan.anggaran)}</p>
                        </div>
                    </div>

                    <!-- Foto Dokumentasi -->
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-2">📸 Foto Dokumentasi</p>
                        ${fotoHtml}
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">📝 Keterangan / Uraian</p>
                        <div class="whitespace-pre-line text-base text-gray-700 bg-gray-50 p-3 rounded">${kegiatan.keterangan}</div>
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
