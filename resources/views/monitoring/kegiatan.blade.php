<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    📋 {{ __('Monitoring Kegiatan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Input & kelola daftar kegiatan bulanan</p>
            </div>
            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">{{ $bulanLabel ?? 'Bulan Berjalan' }}</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-lg p-4 shadow-sm animate-pulse">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <a href="{{ route('laporan.kegiatan', ['bulan' => $bulan]) }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium text-sm">
                            📊 Lihat Laporan
                        </a>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 rounded-lg p-4 shadow-sm">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/></svg>
                        <div class="flex-1">
                            <div class="font-semibold mb-2">⚠️ Periksa input Anda:</div>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Tombol untuk menampilkan / menyembunyikan form --}}
            @php
                // ambil old rows (sama seperti sebelumnya)
                $oldRows = old('kegiatan', [['tema' => '', 'bidang' => '', 'tanggal_pelaksanaan' => '', 'nama_kegiatan' => '', 'pelaksana' => '', 'jumlah_peserta' => 0, 'anggaran' => 0]]);
                if (empty($oldRows)) {
                    $oldRows = [['tema' => '', 'bidang' => '', 'tanggal_pelaksanaan' => '', 'nama_kegiatan' => '', 'pelaksana' => '', 'jumlah_peserta' => 0, 'anggaran' => 0]];
                }
                // tentukan apakah ada old input yang bermakna (supaya form terbuka ketika validasi gagal)
                $hasOldInput = old('kegiatan') && collect(old('kegiatan'))->filter(function ($r) {
                    return (!empty($r['nama_kegiatan'] ?? '')) ||
                           (!empty($r['bidang'] ?? '')) ||
                           (!empty($r['pelaksana'] ?? '')) ||
                           (!empty($r['tanggal_pelaksanaan'] ?? '')) ||
                           (!empty($r['anggaran'] ?? 0)) ||
                           (!empty($r['jumlah_peserta'] ?? 0));
                })->isNotEmpty();
                $showForm = $errors->any() || $hasOldInput;
            @endphp
            <!-- Form Input Section -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800 mb-1 flex items-center gap-2">
                            <span class="text-2xl">✏️</span> Input Kegiatan Baru
                        </h3>
                        <p class="text-sm text-gray-600 max-w-xl">
                            Tambahkan satu atau beberapa kegiatan sekaligus. Gunakan tombol <strong>"+ Tambah Baris"</strong> untuk menambah lebih banyak.
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" id="btn-show-form"
                            class="px-5 py-2.5 border-2 border-blue-500 text-blue-600 rounded-lg hover:bg-blue-50 transition font-semibold text-sm flex items-center gap-2">
                            <span>➕</span> Buka Form
                        </button>
                    </div>
                </div>
                <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-sm text-yellow-700 flex items-start gap-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/></svg>
                    <div>
                        <strong>💡 Tips:</strong> Format angka seperti <span class="font-mono bg-white px-2 py-1 rounded">2.500.000</span> akan otomatis dirapi.
                    </div>
                </div>
                {{-- Form dibungkus dan disembunyikan jika $showForm false --}}
                <div id="form-wrapper" class="transition-all duration-300 {{ $showForm ? '' : 'hidden' }}">
                    <form method="POST" action="{{ route('monitoring.kegiatan.store') }}" class="space-y-4" id="form-kegiatan">
                        @csrf

                        <div id="kegiatan-rows" class="space-y-5">
                            @foreach ($oldRows as $idx => $row)
                                <div class="kegiatan-row border-2 border-yellow-200 rounded-lg p-5 bg-gradient-to-br from-yellow-50 to-amber-50 hover:shadow-md transition" data-index="{{ $idx }}">
                                    <div class="flex justify-between items-center mb-4">
                                        <span class="text-sm font-bold text-yellow-700 bg-yellow-100 px-3 py-1 rounded-full">🏷️ Kegiatan #{{ $idx + 1 }}</span>
                                        <button type="button" class="kegiatan-row-remove text-red-600 hover:text-red-800 text-sm font-semibold hidden transition"
                                            aria-label="Hapus baris">
                                            <span>❌ Hapus</span>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="md:col-span-2">
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">📌 Tema Utama <span class="text-red-500">*</span></label>
                                            <select name="kegiatan[{{ $idx }}][tema]" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                                                <option value="" disabled {{ ($row['tema'] ?? '') ? '' : 'selected' }}>-- Pilih tema --</option>
                                                <option value="kaderisasi" {{ ($row['tema'] ?? '') === 'kaderisasi' ? 'selected' : '' }}>🎓 Kaderisasi</option>
                                                <option value="strukturisasi" {{ ($row['tema'] ?? '') === 'strukturisasi' ? 'selected' : '' }}>🏢 Strukturisasi</option>
                                                <option value="citra partai" {{ ($row['tema'] ?? '') === 'citra partai' ? 'selected' : '' }}>⭐ Citra Partai</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">🏛️ Bidang <span class="text-red-500">*</span></label>
                                            <input type="text" name="kegiatan[{{ $idx }}][bidang]" value="{{ $row['bidang'] ?? '' }}" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                                placeholder="Contoh: Bidang" />
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">📅 Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                                            <input type="date" name="kegiatan[{{ $idx }}][tanggal_pelaksanaan]" value="{{ $row['tanggal_pelaksanaan'] ?? '' }}" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition" />
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">🎯 Nama Kegiatan <span class="text-red-500">*</span></label>
                                            <input type="text" name="kegiatan[{{ $idx }}][nama_kegiatan]" value="{{ $row['nama_kegiatan'] ?? '' }}" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                                placeholder="Contoh: Rapat Koordinasi Bulanan" />
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">👤 Pelaksana <span class="text-red-500">*</span></label>
                                            <input type="text" name="kegiatan[{{ $idx }}][pelaksana]" value="{{ $row['pelaksana'] ?? '' }}" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                                placeholder="Nama pelaksana kegiatan" />
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">👥 Jumlah Peserta <span class="text-red-500">*</span></label>
                                            <input type="number" name="kegiatan[{{ $idx }}][jumlah_peserta]" value="{{ $row['jumlah_peserta'] ?? 0 }}" min="0" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition" />
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-2">💰 Anggaran (Rp) <span class="text-red-500">*</span></label>
                                            <input type="number" name="kegiatan[{{ $idx }}][anggaran]" value="{{ $row['anggaran'] ?? 0 }}" min="0" required
                                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                                placeholder="Contoh: 2500000" />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t-2 border-gray-200">
                            <div class="flex gap-3">
                                <button type="button" id="btn-tambah-baris"
                                    class="px-5 py-2.5 border-2 border-yellow-500 text-yellow-600 rounded-lg hover:bg-yellow-50 transition font-semibold text-sm flex items-center gap-2">
                                    <span>➕</span> Tambah Baris
                                </button>
                                <button type="button" id="btn-batal-form"
                                    class="px-5 py-2.5 border-2 border-gray-400 text-gray-700 rounded-lg hover:bg-gray-100 transition font-semibold text-sm">
                                    ❌ Batal
                                </button>
                            </div>
                            <button type="submit"
                                class="px-7 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm flex items-center gap-2">
                                <span>✅</span> Simpan Semua Kegiatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <template id="kegiatan-row-tpl">
        <div class="kegiatan-row border-2 border-yellow-200 rounded-lg p-5 bg-gradient-to-br from-yellow-50 to-amber-50 hover:shadow-md transition" data-index="__IDX__">
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm font-bold text-yellow-700 bg-yellow-100 px-3 py-1 rounded-full kegiatan-row-label">🏷️ Kegiatan #__N__</span>
                <button type="button" class="kegiatan-row-remove text-red-600 hover:text-red-800 text-sm font-semibold transition"
                    aria-label="Hapus baris">
                    <span>❌ Hapus</span>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700 block mb-2">📌 Tema Utama <span class="text-red-500">*</span></label>
                    <select name="kegiatan[__IDX__][tema]" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition">
                        <option value="" disabled selected>-- Pilih tema --</option>
                        <option value="kaderisasi">🎓 Kaderisasi</option>
                        <option value="strukturisasi">🏢 Strukturisasi</option>
                        <option value="citra partai">⭐ Citra Partai</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 block mb-2">🏛️ Bidang <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatan[__IDX__][bidang]" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                        placeholder="Contoh: Bidang" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 block mb-2">📅 Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                    <input type="date" name="kegiatan[__IDX__][tanggal_pelaksanaan]" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 block mb-2">🎯 Nama Kegiatan <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatan[__IDX__][nama_kegiatan]" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                        placeholder="Contoh: Rapat Koordinasi Bulanan" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 block mb-2">👤 Pelaksana <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatan[__IDX__][pelaksana]" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                        placeholder="Nama pelaksana kegiatan" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 block mb-2">👥 Jumlah Peserta <span class="text-red-500">*</span></label>
                    <input type="number" name="kegiatan[__IDX__][jumlah_peserta]" value="0" min="0" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700 block mb-2">💰 Anggaran (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="kegiatan[__IDX__][anggaran]" value="0" min="0" required
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                        placeholder="Contoh: 2500000" />
                </div>
            </div>
        </div>
    </template>
    <script>
        (function () {
            const container = document.getElementById('kegiatan-rows');
            const tpl = document.getElementById('kegiatan-row-tpl');
            const btnAdd = document.getElementById('btn-tambah-baris');

            const btnShowForm = document.getElementById('btn-show-form');
            const formWrapper = document.getElementById('form-wrapper');
            const btnCancelForm = document.getElementById('btn-batal-form');

            function rowCount() {
                return container.querySelectorAll('.kegiatan-row').length;
            }

            function updateRowLabels() {
                container.querySelectorAll('.kegiatan-row').forEach((el, i) => {
                    const L = el.querySelector('.kegiatan-row-label');
                    if (L) L.textContent = '🏷️ Kegiatan #' + (i + 1);
                    el.dataset.index = String(i);
                });
            }

            function updateRemoveVisibility() {
                const rows = container.querySelectorAll('.kegiatan-row');
                const showRemove = rows.length > 1;
                rows.forEach(r => {
                    const btn = r.querySelector('.kegiatan-row-remove');
                    if (btn) btn.classList.toggle('hidden', !showRemove);
                });
            }

            function reindexNames() {
                container.querySelectorAll('.kegiatan-row').forEach((row, i) => {
                    row.querySelectorAll('[name^="kegiatan["]').forEach(input => {
                        const name = input.getAttribute('name');
                        const match = name.match(/^kegiatan\[\d+\](.+)$/);
                        if (match) input.setAttribute('name', 'kegiatan[' + i + ']' + match[1]);
                    });
                });
            }

            function addRow() {
                const idx = rowCount();
                const html = tpl.innerHTML
                    .replace(/__IDX__/g, String(idx))
                    .replace(/__N__/g, String(idx + 1));
                const wrap = document.createElement('div');
                wrap.innerHTML = html;
                const row = wrap.firstElementChild;
                container.appendChild(row);
                updateRowLabels();
                updateRemoveVisibility();
                reindexNames();
            }

            function initRemove() {
                container.addEventListener('click', function (e) {
                    const btn = e.target.closest('.kegiatan-row-remove');
                    if (!btn) return;
                    const row = btn.closest('.kegiatan-row');
                    if (!row || rowCount() <= 1) return;
                    row.remove();
                    updateRowLabels();
                    updateRemoveVisibility();
                    reindexNames();
                });
            }

            // Toggle form visibility
            function updateShowButtonLabel() {
                if (!btnShowForm) return;
                const hidden = formWrapper.classList.contains('hidden');
                btnShowForm.innerHTML = hidden ? '<span>➕</span> Buka Form' : '<span>⬆️</span> Tutup Form';
            }

            if (btnShowForm) {
                btnShowForm.addEventListener('click', function () {
                    formWrapper.classList.toggle('hidden');
                    updateShowButtonLabel();
                    if (!formWrapper.classList.contains('hidden')) {
                        // fokus ke input pertama
                        const firstInput = formWrapper.querySelector('input, select, textarea');
                        if (firstInput) firstInput.focus();
                        formWrapper.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            }

            if (btnCancelForm) {
                btnCancelForm.addEventListener('click', function () {
                    formWrapper.classList.add('hidden');
                    updateShowButtonLabel();
                });
            }

            if (btnAdd) btnAdd.addEventListener('click', addRow);
            initRemove();
            updateRemoveVisibility();
            updateShowButtonLabel();
        })();
    </script>
</x-app-layout>
