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

                    <form id="rapatFilterForm" method="GET" action="{{ route('laporan.rapat') }}" class="w-full md:w-auto flex flex-col sm:flex-row items-end gap-3">
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

                <div id="rapatResults">
                    @include('laporan.partials.rapat_list')
                </div>

            {{-- Detail Modal --}}
            <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-gradient-to-r from-yellow-600 to-amber-600 text-white p-6 flex items-center justify-between">
                        <h3 class="font-bold text-lg">📄 Detail Uraian Rapat</h3>
                        <button onclick="closeDetailModal()" class="text-white hover:bg-white/20 p-2 rounded-lg transition">
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
        // Data rapats untuk detail modal
        const rapatsData = {!! json_encode($rapats->map(function($rapat) {
            return [
                'id' => $rapat->id,
                'tanggal' => $rapat->tanggal?->format('d/m/Y'),
                'waktu' => $rapat->waktu ? substr($rapat->waktu, 0, 5) : ($rapat->created_at?->format('H:i') ?? '-'),
                'user_name' => $rapat->user?->name ?? ($rapat->pengisi_nama ?? 'Tidak diketahui'),
                'wilayah' => $rapat->daerah ? ($rapat->daerah->nama . ' - ' . $rapat->daerah->kode) : ($rapat->user?->daerah ? ($rapat->user->daerah->nama . ' - ' . $rapat->user->daerah->kode) : '-'),
                'rapat_dptd' => $rapat->rapat_dptd,
                'uraian_dptd' => $rapat->uraian_dptd ?? '',
                'rapat_phdpd' => $rapat->rapat_phdpd,
                'uraian_phdpd' => $rapat->uraian_phdpd ?? '',
                'rapat_pimpinan' => $rapat->rapat_pimpinan,
                'uraian_pimpinan' => $rapat->uraian_pimpinan ?? '',
                'rapat_bidang' => $rapat->rapat_bidang,
                'uraian_bidang' => $rapat->uraian_bidang ?? '',
                'rapat_kdd' => $rapat->rapat_kdd ?? false,
                'uraian_kdd' => $rapat->uraian_kdd ?? '',
                'rapat_pks' => $rapat->rapat_pks ?? false,
                'uraian_pks' => $rapat->uraian_pks ?? '',
            ];
        })->keyBy('id')) !!};

        function openDetailModal(rapatId) {
            const rapat = rapatsData[rapatId];
            if (!rapat) return;

            const html = `
                <div class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-xs text-gray-500">Nama User</p>
                            <p class="font-semibold text-sm text-gray-900">${rapat.user_name}</p>

                            <p class="text-xs text-gray-500 mt-2">Tanggal Pengisian</p>
                            <p class="text-sm text-gray-700">${rapat.tanggal} • ${rapat.waktu}</p>
                        </div>
                    </div>

                    <div class="border-t-2 border-gray-200 pt-6">
                        <h4 class="font-bold text-gray-900 mb-4">📋 Detail Uraian Rapat</h4>

                        <div class="mb-4 bg-gray-50 p-3 rounded">
                            <p class="text-xs text-gray-500">Daerah</p>
                            <p class="text-sm font-medium text-gray-900">${rapat.wilayah}</p>
                        </div>
                        
                        <div class="space-y-4">
                            ${renderQuestion(1, 'Apakah ada rapat DPTD?', rapat.rapat_dptd, rapat.uraian_dptd)}
                            ${renderQuestion(2, 'Apakah ada rapat PH DPD (KSB & KABID)?', rapat.rapat_phdpd, rapat.uraian_phdpd)}
                            ${renderQuestion(3, 'Apakah ada rapat pimpinan (KSB DPD & KSB DPC)?', rapat.rapat_pimpinan, rapat.uraian_pimpinan)}
                            ${renderQuestion(4, 'Apakah ada rapat bidang (KSB dengan bidang tertentu)?', rapat.rapat_bidang, rapat.uraian_bidang)}
                            ${renderQuestion(5, 'Apakah ada rapat bersama KDD?', rapat.rapat_kdd, rapat.uraian_kdd)}
                            ${renderQuestion(6, 'Apakah ada rapat dengan anggota Dewan atau fraksi PKS?', rapat.rapat_pks, rapat.uraian_pks)}
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('detailContent').innerHTML = html;
            document.getElementById('detailModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function renderQuestion(no, question, answer, description) {
            const statusClass = answer ? 'text-green-600' : 'text-gray-500';
            const statusText = answer ? '✅ Iya' : '❌ Tidak';
            const descriptionHtml = answer && description 
                ? `<div class="mt-3 p-3 bg-gray-100 rounded text-sm text-gray-700 whitespace-pre-line">${escapeHtml(description)}</div>`
                : '';

            return `
                <div class="border-2 border-gray-200 rounded-lg p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">❓ ${no}. ${question}</p>
                        </div>
                        <div class="font-bold ${statusClass} ml-4">${statusText}</div>
                    </div>
                    ${descriptionHtml}
                </div>
            `;
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside

        (function(){
            const form = document.getElementById('rapatFilterForm');
            const results = document.getElementById('rapatResults');

            if (!form || !results) return;

            async function fetchAndReplace(url) {
                try {
                    const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    const html = await res.text();
                    results.innerHTML = html;
                    attachPaginationHandlers();
                } catch (e) {
                    console.error(e);
                }
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
        })();
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
            }
        });
    </script>
</x-app-layout>
