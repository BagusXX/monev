<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    📊 {{ __('Monitoring Aktivitas Rapat') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Formulir pemantauan dan pencatatan rapat</p>
            </div>
            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">📋 Formulir Rapat</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-lg p-4 shadow-sm animate-pulse">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <a href="{{ route('laporan.rapat', ['bulan' => $bulan ?? now()->format('Y-m')]) }}"
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

            <form method="POST" action="{{ route('monitor.store') }}" class="space-y-6">
                @csrf

                <div class="bg-white border-2 border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="font-bold text-lg text-gray-800 mb-1 flex items-center gap-2">
                        <span class="text-2xl">⏰</span> Informasi Waktu Rapat
                    </h3>
                    <p class="text-sm text-gray-600 mb-5">
                        Tentukan bulan, tanggal, dan jam pelaksanaan rapat Anda.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-700 block mb-2">📅 Bulan <span class="text-red-500">*</span></label>
                            <input type="month" id="bulan" name="bulan" value="{{ old('bulan', $bulan ?? '') }}"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                onchange="setBulan()">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700 block mb-2">📆 Tanggal <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $tanggal ?? '') }}"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                onchange="updateDisplay()">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700 block mb-2">🕐 Waktu <span class="text-red-500">*</span></label>
                            <input type="time" id="waktu" name="waktu" value="{{ old('waktu') }}"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                onchange="updateDisplay()">
                        </div>
                    </div>
                    <div id="hasilTanggal"
                        class="mt-4 hidden p-4 bg-gradient-to-r from-yellow-50 to-amber-50 border-2 border-yellow-300 rounded-lg text-yellow-900 font-semibold flex items-center gap-2">
                        <span class="text-xl">✅</span>
                        <span>Tanggal & Waktu Rapat: <span id="output" class="text-yellow-700"></span></span>
                    </div>
                </div>

                <div class="bg-white border-2 border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <h3 class="font-bold text-lg text-gray-800 mb-1 flex items-center gap-2">
                        <span class="text-2xl">📝</span> Rangkuman Agenda Rapat
                    </h3>
                    <p class="text-sm text-gray-600 mb-5">
                        Pilih "Iya" dan isi uraian singkat untuk setiap jenis rapat yang dilaksanakan.
                    </p>

                    <div class="border-2 border-yellow-200 rounded-lg p-5 bg-gradient-to-br from-yellow-50 to-yellow-50 hover:shadow-sm transition">
                        <label class="font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-yellow-600 text-white w-6 h-6 rounded-full text-center leading-6 text-sm">1</span>
                            🏢 Apakah ada rapat DPTD?
                        </label>
                        <div class="mt-3 flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_dptd" value="iya" {{ old('rapat_dptd') === 'iya' ? 'checked' : '' }}
                                    onclick="toggleField('dptd', true)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">✅ Iya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_dptd" value="tidak" {{ old('rapat_dptd') === 'tidak' ? 'checked' : '' }}
                                    onclick="toggleField('dptd', false)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">❌ Tidak</span>
                            </label>
                        </div>
                        <div id="dptd" class="mt-4 hidden">
                            <label class="text-sm font-semibold text-gray-700 block mb-2">💬 Jelaskan detail rapat DPTD:</label>
                            <textarea name="uraian_dptd"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                rows="3"
                                placeholder="Uraian rapat DPTD...">{{ old('uraian_dptd') }}</textarea>
                        </div>
                    </div>

                    <div class="border-2 border-yellow-200 rounded-lg p-5 bg-gradient-to-br from-yellow-50 to-pink-50 hover:shadow-sm transition mt-4">
                        <label class="font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-yellow-600 text-white w-6 h-6 rounded-full text-center leading-6 text-sm">2</span>
                            👥 Apakah ada rapat PH DPD (KSB & KABID)?
                        </label>
                        <div class="mt-3 flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_phdpd" value="iya" {{ old('rapat_phdpd') === 'iya' ? 'checked' : '' }}
                                    onclick="toggleField('phdpd', true)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">✅ Iya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_phdpd" value="tidak" {{ old('rapat_phdpd') === 'tidak' ? 'checked' : '' }}
                                    onclick="toggleField('phdpd', false)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">❌ Tidak</span>
                            </label>
                        </div>
                        <div id="phdpd" class="mt-4 hidden">
                            <label class="text-sm font-semibold text-gray-700 block mb-2">💬 Jelaskan detail rapat PH DPD:</label>
                            <textarea name="uraian_phdpd"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                rows="3"
                                placeholder="Uraian rapat PH DPD...">{{ old('uraian_phdpd') }}</textarea>
                        </div>
                    </div>

                    <div class="border-2 border-green-200 rounded-lg p-5 bg-gradient-to-br from-green-50 to-emerald-50 hover:shadow-sm transition mt-4">
                        <label class="font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-green-600 text-white w-6 h-6 rounded-full text-center leading-6 text-sm">3</span>
                            👔 Apakah ada rapat pimpinan (KSB DPD & KSB DPC)?
                        </label>
                        <div class="mt-3 flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_pimpinan" value="iya" {{ old('rapat_pimpinan') === 'iya' ? 'checked' : '' }}
                                    onclick="toggleField('pimpinan', true)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">✅ Iya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_pimpinan" value="tidak" {{ old('rapat_pimpinan') === 'tidak' ? 'checked' : '' }}
                                    onclick="toggleField('pimpinan', false)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">❌ Tidak</span>
                            </label>
                        </div>
                        <div id="pimpinan" class="mt-4 hidden">
                            <label class="text-sm font-semibold text-gray-700 block mb-2">💬 Jelaskan detail rapat pimpinan:</label>
                            <textarea name="uraian_pimpinan"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                                rows="3"
                                placeholder="Uraian rapat pimpinan...">{{ old('uraian_pimpinan') }}</textarea>
                        </div>
                    </div>

                    <div class="border-2 border-orange-200 rounded-lg p-5 bg-gradient-to-br from-orange-50 to-amber-50 hover:shadow-sm transition mt-4">
                        <label class="font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-orange-600 text-white w-6 h-6 rounded-full text-center leading-6 text-sm">4</span>
                            🏛️ Apakah ada rapat bidang (KSB dengan bidang tertentu / internal bidang)?
                        </label>
                        <div class="mt-3 flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_bidang" value="iya" {{ old('rapat_bidang') === 'iya' ? 'checked' : '' }}
                                    onclick="toggleField('bidang', true)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">✅ Iya</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="rapat_bidang" value="tidak" {{ old('rapat_bidang') === 'tidak' ? 'checked' : '' }}
                                    onclick="toggleField('bidang', false)" class="w-4 h-4">
                                <span class="text-gray-700 font-medium">❌ Tidak</span>
                            </label>
                        </div>
                        <div id="bidang" class="mt-4 hidden">
                            <label class="text-sm font-semibold text-gray-700 block mb-2">💬 Jelaskan detail rapat bidang:</label>
                            <textarea name="uraian_bidang"
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition"
                                rows="3"
                                placeholder="Uraian rapat bidang...">{{ old('uraian_bidang') }}</textarea>
                        </div>
                    </div>

                    {{-- RAPAT 5 --}}
<div class="border-2 border-amber-200 rounded-lg p-5 bg-gradient-to-br from-amber-50 to-amber-50 hover:shadow-sm transition mt-4">
    <label class="font-bold text-gray-800 flex items-center gap-2">
        <span class="bg-teal-600 text-white w-6 h-6 rounded-full text-center leading-6 text-sm">5</span>
        🏛️ Apakah ada rapat bersama KPD?
    </label>
    <div class="mt-3 flex gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="rapat_kpd" value="iya"
                {{ old('rapat_kpd') === 'iya' ? 'checked' : '' }}
                onclick="toggleField('kpd', true)">
            <span>✅ Iya</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="rapat_kpd" value="tidak"
                {{ old('rapat_kpd') === 'tidak' ? 'checked' : '' }}
                onclick="toggleField('kpd', false)">
            <span>❌ Tidak</span>
        </label>
    </div>
    <div id="kpd" class="mt-4 hidden">
        <label class="text-sm font-semibold text-gray-700 block mb-2">
            💬 Jelaskan detail rapat bersama KPD:
        </label>
        <textarea name="uraian_kpd" rows="3"
            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300"
            placeholder="Uraian rapat bersama KPD...">{{ old('uraian_kpd') }}</textarea>
    </div>
</div>


{{-- RAPAT 6 --}}
<div class="border-2 border-rose-200 rounded-lg p-4 bg-rose-50">
    <label class="flex items-center gap-3 font-semibold text-gray-800 cursor-pointer">
        <span class="bg-rose-600 text-white w-6 h-6 rounded-full text-center leading-6 text-sm">6</span>
        👥 Apakah ada rapat bersama anggota Dewan?
    </label>
    <div class="mt-3 flex gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="rapat_dewan" value="iya"
                {{ old('rapat_dewan') === 'iya' ? 'checked' : '' }}
                onclick="toggleField('dewan', true)">
            <span>✅ Iya</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="rapat_dewan" value="tidak"
                {{ old('rapat_dewan') === 'tidak' ? 'checked' : '' }}
                onclick="toggleField('dewan', false)">
            <span>❌ Tidak</span>
        </label>
    </div>
    <div id="dewan" class="mt-4 hidden">
        <label class="text-sm font-semibold text-gray-700 block mb-2">
            💬 Jelaskan detail rapat bersama anggota Dewan:
        </label>
        <textarea name="uraian_dewan" rows="3"
            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300"
            placeholder="Uraian rapat bersama anggota Dewan...">{{ old('uraian_dewan') }}</textarea>
    </div>
</div>

                    <div class="flex justify-end pt-6 border-t-2 border-gray-200 mt-6">
                        <button type="submit"
                            class="px-7 py-2.5 bg-gradient-to-r from-yellow-600 to-yellow-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm flex items-center gap-2">
                            <span>✅</span> Simpan Data Monitoring
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let initialized = false;

        document.addEventListener('DOMContentLoaded', () => {
            initDefault();
        });

        function toggleField(id, show) {
            document.getElementById(id).classList.toggle('hidden', !show);
        }

        function initDefault() {
            if (initialized) return;

            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');

            const bulanEl = document.getElementById('bulan');
            const tanggalEl = document.getElementById('tanggal');

            // hanya set default kalau belum ada value dari server (old/query)
            if (!bulanEl.value) bulanEl.value = `${year}-${month}`;
            if (!tanggalEl.value) tanggalEl.value = `${year}-${month}-${day}`;

            initialized = true;
            setBulan();
        }

        function setBulan() {
            const bulan = document.getElementById('bulan').value;
            const tanggalInput = document.getElementById('tanggal');

            if (!bulan) return;

            const [year, month] = bulan.split('-');
            const firstDay = `${year}-${month}-01`;
            const lastDay = new Date(year, month, 0).getDate();
            const lastDate = `${year}-${month}-${lastDay}`;

            tanggalInput.min = firstDay;
            tanggalInput.max = lastDate;

            if (tanggalInput.value < firstDay || tanggalInput.value > lastDate) {
                tanggalInput.value = firstDay;
            }

            updateDisplay();
        }

        function updateDisplay() {
            const tanggal = document.getElementById('tanggal').value;
            const waktu = document.getElementById('waktu').value;
            const outputBox = document.getElementById('hasilTanggal');
            const output = document.getElementById('output');

            if (tanggal && waktu) {
                const tgl = new Date(tanggal);
                const formattedDate = tgl.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                output.textContent = `${formattedDate}, pukul ${waktu} WIB`;
                outputBox.classList.remove('hidden');
            } else {
                outputBox.classList.add('hidden');
            }
        }

        // tampilkan textarea kalau radio "iya" sudah terpilih dari old()
        document.addEventListener('DOMContentLoaded', () => {
            if (document.querySelector('input[name="rapat_dptd"][value="iya"]:checked')) toggleField('dptd', true);
            if (document.querySelector('input[name="rapat_phdpd"][value="iya"]:checked')) toggleField('phdpd', true);
            if (document.querySelector('input[name="rapat_pimpinan"][value="iya"]:checked')) toggleField('pimpinan', true);
            if (document.querySelector('input[name="rapat_bidang"][value="iya"]:checked')) toggleField('bidang', true);
            if (document.querySelector('input[name="rapat_kpd"][value="iya"]:checked')) toggleField('kpd', true);
            if (document.querySelector('input[name="rapat_dewan"][value="iya"]:checked')) toggleField('dewan', true);

        });
    </script>
</x-app-layout>
