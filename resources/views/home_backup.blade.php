<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl bg-gradient-to-r from-primary-600 to-pink-600 bg-clip-text text-transparent leading-tight">
                    📊 {{ __('Dashboard Sistem') }}
                </h2>
                <p class="text-sm text-gray-500 mt-2">Selamat datang di sistem manajemen wilayah Kota Semarang</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-primary-50 via-primary-50 to-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <!-- Card 1 - Blue -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-primary-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-primary-100">👥 Total Users</p>
                                <p class="text-3xl font-bold text-white mt-2">1,234</p>
                                <p class="text-xs text-primary-100 mt-2">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        +12.5%
                                    </span>
                                    dari bulan lalu
                                </p>
                            </div>
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl shadow-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 - Green -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-green-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-100">🏘️ Total Kecamatan</p>
                                <p class="text-3xl font-bold text-white mt-2">45</p>
                                <p class="text-xs text-green-100 mt-2">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        +5
                                    </span>
                                    dari bulan lalu
                                </p>
                            </div>
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl shadow-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 - Purple -->
                <div class="bg-gradient-to-br from-primary-500 to-violet-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-primary-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-primary-100">📍 Total Kelurahan</p>
                                <p class="text-3xl font-bold text-white mt-2">128</p>
                                <p class="text-xs text-primary-100 mt-2">>
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        +8
                                    </span>
                                    dari bulan lalu
                                </p>
                            </div>
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl shadow-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 - Orange -->
                <div class="bg-gradient-to-br from-orange-500 to-red-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-orange-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-orange-100">⚡ Aktivitas Bulan Ini</p>
                                <p class="text-3xl font-bold text-white mt-2">892</p>
                                <p class="text-xs text-orange-100 mt-2">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        +23.1%
                                    </span>
                                    dari bulan lalu
                                </p>
                            </div>
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl shadow-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
                <!-- Line Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-2 border-gray-200 hover:shadow-2xl transition">
                    <div class="p-6 border-b-2 border-gray-200 bg-gradient-to-r from-primary-50 to-primary-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">📈 Statistik Bulanan</h3>
                                <p class="text-sm text-gray-600 mt-1">Tren data sepanjang tahun</p>
                            </div>
                            <select class="text-sm border-2 border-primary-300 bg-white text-gray-700 rounded-lg shadow-sm focus:border-primary-600 focus:ring-2 focus:ring-primary-200 px-3 py-1.5 font-semibold">
                                <option>Bulan ini</option>
                                <option>3 Bulan terakhir</option>
                                <option>Tahun ini</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-2 border-gray-200 hover:shadow-2xl transition">
                    <div class="p-6 border-b-2 border-gray-200 bg-gradient-to-r from-primary-50 to-pink-50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">🎯 Distribusi Data</h3>
                                <p class="text-sm text-gray-600 mt-1">Persentase data per kategori</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-64">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mb-6">
                <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border-2 border-gradient-to-r from-primary-300 to-pink-300 hover:shadow-2xl transition">
                    <!-- Enhanced Header with Gradient -->
                    <div class="p-7 bg-gradient-to-r from-slate-900 via-yellow-900 to-slate-900 border-b-4 border-gradient-to-r from-primary-500 to-pink-500">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h3 class="text-2xl font-bold text-transparent bg-gradient-to-r from-primary-300 to-pink-300 bg-clip-text">🗺️ Peta Provinsi Jawa Tengah</h3>
                                <p class="text-sm text-primary-200 mt-2 font-semibold">Visualisasi wilayah administrasi seluruh Provinsi Jawa Tengah dengan data real-time</p>
                            </div>
                            <div class="hidden md:flex items-center gap-3 flex-wrap justify-end">
                                <div class="px-4 py-2.5 bg-gradient-to-r from-primary-500 to-primary-500 rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                    <span class="inline-flex items-center text-xs font-bold text-white">
                                        <span class="w-2.5 h-2.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                        35 Kota/Kabupaten
                                    </span>
                                </div>
                                <div class="px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105">
                                    <span class="inline-flex items-center text-xs font-bold text-white">
                                        <span class="w-2.5 h-2.5 bg-white rounded-full mr-2 animate-pulse"></span>
                                        ~2,500+ Kelurahan
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Mini Legend in Header -->
                        <div class="flex items-center gap-6 pt-4 border-t border-primary-400 flex-wrap">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-red-500 shadow-md"></span>
                                <span class="text-xs text-primary-100 font-semibold">Jateng Utara</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-primary-500 shadow-md"></span>
                                <span class="text-xs text-primary-100 font-semibold">Jateng Barat</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-md"></span>
                                <span class="text-xs text-primary-100 font-semibold">Jateng Tengah</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-primary-500 shadow-md"></span>
                                <span class="text-xs text-primary-100 font-semibold">Jateng Timur</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-primary-500 shadow-md"></span>
                                <span class="text-xs text-primary-100 font-semibold">Jateng Selatan</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-7 bg-gradient-to-br from-gray-50 to-primary-50">
                        <!-- Map Container with Enhanced Styling -->
                        <div class="rounded-xl overflow-hidden border-4 border-gradient-to-r from-primary-400 to-pink-400 shadow-2xl hover:shadow-2xl transition">
                            <div id="map" class="w-full bg-white" style="height: 500px; min-height: 500px; display: block;"></div>
                        </div>
                        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Kota Semarang Card -->
                            <div class="group cursor-pointer">
                                <div class="text-center p-5 bg-gradient-to-br from-primary-400 to-primary-500 rounded-xl border-2 border-primary-300 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-200 text-white">
                                    <div class="text-2xl mb-2">🌟</div>
                                    <p class="text-xs font-bold text-primary-100 uppercase tracking-wider">Semarang</p>
                                    <p class="text-3xl font-bold text-white mt-2">1</p>
                                    <p class="text-xs text-primary-100 mt-2 font-semibold">Kota Metropolitan</p>
                                </div>
                            </div>
                            <!-- Kota Surakarta Card -->
                            <div class="group cursor-pointer">
                                <div class="text-center p-5 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl border-2 border-emerald-300 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-200 text-white">
                                    <div class="text-2xl mb-2">🏰</div>
                                    <p class="text-xs font-bold text-emerald-100 uppercase tracking-wider">Surakarta</p>
                                    <p class="text-3xl font-bold text-white mt-2">1</p>
                                    <p class="text-xs text-emerald-100 mt-2 font-semibold">Kota Budaya</p>
                                </div>
                            </div>
                            <!-- Kota Pekalongan Card -->
                            <div class="group cursor-pointer">
                                <div class="text-center p-5 bg-gradient-to-br from-primary-400 to-primary-500 rounded-xl border-2 border-amber-300 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-200 text-white">
                                    <div class="text-2xl mb-2">🏖️</div>
                                    <p class="text-xs font-bold text-violet-100 uppercase tracking-wider">Pekalongan</p>
                                    <p class="text-3xl font-bold text-white mt-2">1</p>
                                    <p class="text-xs text-violet-100 mt-2 font-semibold">Kota Pesisir</p>
                                </div>
                            </div>
                            <!-- Kabupaten Card -->
                            <div class="group cursor-pointer">
                                <div class="text-center p-5 bg-gradient-to-br from-primary-400 to-orange-500 rounded-xl border-2 border-amber-300 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-200 text-white">
                                    <div class="text-2xl mb-2">🌾</div>
                                    <p class="text-xs font-bold text-primary-100 uppercase tracking-wider">Kabupaten</p>
                                    <p class="text-3xl font-bold text-white mt-2">30+</p>
                                    <p class="text-xs text-primary-100 mt-2 font-semibold">Wilayah Perifer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-2 border-gray-200">
                <div class="p-6 border-b-2 border-gray-200 bg-gradient-to-r from-primary-50 to-primary-50">
                    <h3 class="text-lg font-bold text-gray-900">⚡ Aktivitas Terbaru</h3>
                    <p class="text-sm text-gray-600 mt-1">Daftar aktivitas sistem terkini</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y-2 divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-100 to-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">📌 Aktivitas</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">👤 User</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">⏰ Waktu</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">✓ Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Menambah data kecamatan baru</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">2 jam yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-200 text-green-900">✅ Berhasil</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Mengupdate data kelurahan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">5 jam yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-200 text-green-900">✅ Berhasil</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Menambah user baru</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Super Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">1 hari yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-200 text-green-900">✅ Berhasil</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Menghapus data kelurahan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">2 hari yang lalu</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-200 text-green-900">✅ Berhasil</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for Leaflet to fully load
            if (typeof L === 'undefined') {
                console.log('Leaflet loading...');
                setTimeout(arguments.callee, 100);
                return;
            }

            try {
                // Initialize Map with Leaflet - Centered on Jawa Tengah Province
                const map = L.map('map', {
                    attributionControl: true,
                    zoomControl: true,
                    dragging: true
                }).setView([-7.5, 110.5], 9);

                // Add OpenStreetMap tiles (most reliable)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19,
                    minZoom: 2
                }).addTo(map);

                // Fallback tile layer (CartoDB)
                const cartodbLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    attribution: '© CartoDB',
                    subdomains: 'abcd',
                    maxZoom: 20,
                    visible: false
                });

                console.log('Map initialized successfully');
            // Major cities and regencies in Central Java
            const locations = [
                // Jateng Utara (North) - Red Region
                {
                    name: 'Kota Semarang',
                    lat: -6.9667,
                    lng: 110.4167,
                    type: 'kota',
                    color: '#EF4444',
                    region: 'Jateng Utara',
                    size: 12,
                    population: '1.7 juta'
                },
                {
                    name: 'Kabupaten Demak',
                    lat: -6.8833,
                    lng: 110.6333,
                    type: 'kabupaten',
                    color: '#DC2626',
                    region: 'Jateng Utara',
                    size: 9
                },
                {
                    name: 'Kabupaten Kudus',
                    lat: -6.9,
                    lng: 110.85,
                    type: 'kabupaten',
                    color: '#DC2626',
                    region: 'Jateng Utara',
                    size: 9
                },
                {
                    name: 'Kabupaten Jepara',
                    lat: -6.8667,
                    lng: 110.95,
                    type: 'kabupaten',
                    color: '#DC2626',
                    region: 'Jateng Utara',
                    size: 9
                },
                {
                    name: 'Kabupaten Pati',
                    lat: -6.75,
                    lng: 111.1,
                    type: 'kabupaten',
                    color: '#DC2626',
                    region: 'Jateng Utara',
                    size: 9
                },
                {
                    name: 'Kabupaten Rembang',
                    lat: -6.7167,
                    lng: 111.3333,
                    type: 'kabupaten',
                    color: '#DC2626',
                    region: 'Jateng Utara',
                    size: 9
                },
                // Jateng Barat (West) - Amber Region
                {
                    name: 'Kota Pekalongan',
                    lat: -6.8833,
                    lng: 109.6833,
                    type: 'kota',
                    color: '#F59E0B',
                    region: 'Jateng Barat',
                    size: 11,
                    population: '0.3 juta'
                },
                {
                    name: 'Kabupaten Pekalongan',
                    lat: -7.0,
                    lng: 109.6667,
                    type: 'kabupaten',
                    color: '#DBEAFE',
                    region: 'Jateng Barat',
                    size: 9
                },
                {
                    name: 'Kabupaten Batang',
                    lat: -6.95,
                    lng: 109.3,
                    type: 'kabupaten',
                    color: '#DBEAFE',
                    region: 'Jateng Barat',
                    size: 9
                },
                {
                    name: 'Kabupaten Kendal',
                    lat: -6.9,
                    lng: 110.1,
                    type: 'kabupaten',
                    color: '#DBEAFE',
                    region: 'Jateng Barat',
                    size: 9
                },
                // Jateng Tengah (Central) - Emerald Region
                {
                    name: 'Kabupaten Semarang',
                    lat: -7.1333,
                    lng: 110.4667,
                    type: 'kabupaten',
                    color: '#10B981',
                    region: 'Jateng Tengah',
                    size: 9
                },
                {
                    name: 'Kabupaten Blora',
                    lat: -7.3,
                    lng: 111.4,
                    type: 'kabupaten',
                    color: '#10B981',
                    region: 'Jateng Tengah',
                    size: 9
                },
                {
                    name: 'Kabupaten Grobogan',
                    lat: -7.2,
                    lng: 111.0667,
                    type: 'kabupaten',
                    color: '#10B981',
                    region: 'Jateng Tengah',
                    size: 9
                },
                // Jateng Timur (East) - Blue Region
                {
                    name: 'Kota Surakarta',
                    lat: -7.5667,
                    lng: 110.8167,
                    type: 'kota',
                    color: '#3B82F6',
                    region: 'Jateng Timur',
                    size: 11,
                    population: '0.5 juta'
                },
                {
                    name: 'Kabupaten Klaten',
                    lat: -7.65,
                    lng: 110.6,
                    type: 'kabupaten',
                    color: '#3B82F6',
                    region: 'Jateng Timur',
                    size: 9
                },
                {
                    name: 'Kabupaten Boyolali',
                    lat: -7.5,
                    lng: 110.5,
                    type: 'kabupaten',
                    color: '#3B82F6',
                    region: 'Jateng Timur',
                    size: 9
                },
                {
                    name: 'Kabupaten Sragen',
                    lat: -7.45,
                    lng: 111.0,
                    type: 'kabupaten',
                    color: '#3B82F6',
                    region: 'Jateng Timur',
                    size: 9
                },
                {
                    name: 'Kabupaten Karanganyar',
                    lat: -7.6,
                    lng: 110.8,
                    type: 'kabupaten',
                    color: '#3B82F6',
                    region: 'Jateng Timur',
                    size: 9
                },
                {
                    name: 'Kabupaten Sukoharjo',
                    lat: -7.65,
                    lng: 110.8,
                    type: 'kabupaten',
                    color: '#3B82F6',
                    region: 'Jateng Timur',
                    size: 9
                },
                // Jateng Selatan (South) - Purple Region
                {
                    name: 'Kabupaten Wonogiri',
                    lat: -7.7,
                    lng: 111.05,
                    type: 'kabupaten',
                    color: '#8B5CF6',
                    region: 'Jateng Selatan',
                    size: 9
                }
            ];

            // Add markers for major cities and regencies with enhanced styling
            locations.forEach((location, index) => {
                // Create custom circle marker with glow effect
                const marker = L.circleMarker([location.lat, location.lng], {
                    radius: location.size || 8,
                    fillColor: location.color,
                    color: '#fff',
                    weight: 3,
                    opacity: 1,
                    fillOpacity: 0.85
                }).addTo(map);

                // Add shadow effect via additional circle behind
                const shadowMarker = L.circleMarker([location.lat, location.lng], {
                    radius: (location.size || 8) + 3,
                    fillColor: location.color,
                    color: location.color,
                    weight: 0,
                    opacity: 0,
                    fillOpacity: 0.15
                }).addTo(map);
                // Add markers to map with enhanced styling
                locations.forEach((location) => {
                    // Create marker with custom styling
                    const marker = L.circleMarker([location.lat, location.lng], {
                        radius: location.size || 8,
                        fillColor: location.color,
                        color: '#fff',
                        weight: 3,
                        opacity: 1,
                        fillOpacity: 0.85,
                        className: 'location-marker'
                    }).addTo(map);

                    // Create popup content with beautiful styling
                    const popupContent = `
                        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-width: 220px; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                            <div style="background: linear-gradient(135deg, ${location.color} 0%, ${location.color}dd 100%); color: white; padding: 12px 14px; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 3px solid rgba(255,255,255,0.3);">
                                ${location.type === 'kota' ? '🏙️' : '🌾'} ${location.name}
                            </div>
                            <div style="background: white; padding: 12px 14px; font-size: 12px; color: #374151; line-height: 1.8;">
                                <div style="margin-bottom: 8px;"><strong>Tipe:</strong> <span style="color: ${location.color}; font-weight: 600;">${location.type === 'kota' ? 'Kota' : 'Kabupaten'}</span></div>
                                <div style="margin-bottom: 8px;"><strong>Region:</strong> <span>${location.region}</span></div>
                                ${location.population ? `<div><strong>Populasi:</strong> <span>${location.population}</span></div>` : ''}
                            </div>
                            <div style="background: linear-gradient(90deg, ${location.color}10 0%, transparent 100%); padding: 8px 14px; border-top: 2px solid #e5e7eb; font-size: 11px; color: #6b7280; font-weight: 600; text-align: center;">
                                ${location.region}
                            </div>
                        </div>
                    `;

                    // Bind popup
                    marker.bindPopup(popupContent, {
                        maxWidth: 300,
                        minWidth: 250,
                        className: 'custom-location-popup',
                        offset: [0, -10]
                    });

                    // Enhanced hover effects
                    marker.on('mouseover', function(e) {
                        this.setStyle({
                            radius: (location.size || 8) + 5,
                            fillOpacity: 1,
                            weight: 4
                        });
                    });

                    marker.on('mouseout', function(e) {
                        this.setStyle({
                            radius: location.size || 8,
                            fillOpacity: 0.85,
                            weight: 3
                        });
                    });
                });

                // Add regional boundary circles
                // Jateng Utara (Red)
                L.circle([-6.95, 110.8], {
                    color: '#EF4444',
                    fillColor: '#EF4444',
                    fillOpacity: 0.06,
                    radius: 40000,
                    weight: 2,
                    dashArray: '8, 4',
                    lineCap: 'round'
                }).addTo(map).bindTooltip('Jateng Utara (North)', { permanent: false, offset: [20, 0] });

                // Jateng Barat (Amber)
                L.circle([-6.95, 109.5], {
                    color: '#F59E0B',
                    fillColor: '#F59E0B',
                    fillOpacity: 0.06,
                    radius: 35000,
                    weight: 2,
                    dashArray: '8, 4',
                    lineCap: 'round'
                }).addTo(map).bindTooltip('Jateng Barat (West)', { permanent: false, offset: [20, 0] });

                // Jateng Tengah (Emerald)
                L.circle([-7.25, 111.0], {
                    color: '#10B981',
                    fillColor: '#10B981',
                    fillOpacity: 0.06,
                    radius: 45000,
                    weight: 2,
                    dashArray: '8, 4',
                    lineCap: 'round'
                }).addTo(map).bindTooltip('Jateng Tengah (Central)', { permanent: false, offset: [20, 0] });

                // Jateng Timur (Blue)
                L.circle([-7.6, 110.8], {
                    color: '#3B82F6',
                    fillColor: '#3B82F6',
                    fillOpacity: 0.06,
                    radius: 40000,
                    weight: 2,
                    dashArray: '8, 4',
                    lineCap: 'round'
                }).addTo(map).bindTooltip('Jateng Timur (East)', { permanent: false, offset: [20, 0] });

                // Jateng Selatan (Purple)
                L.circle([-7.7, 111.0], {
                    color: '#8B5CF6',
                    fillColor: '#8B5CF6',
                    fillOpacity: 0.06,
                    radius: 25000,
                    weight: 2,
                    dashArray: '8, 4',
                    lineCap: 'round'
                }).addTo(map).bindTooltip('Jateng Selatan (South)', { permanent: false, offset: [20, 0] });

                // Add custom control for map info
                const infoControl = L.control({ position: 'bottomright' });
                infoControl.onAdd = function(map) {
                    const div = L.DomUtil.create('div', 'map-info-control');
                    div.innerHTML = `
                        <div style="background: linear-gradient(135deg, rgba(17,24,39,0.95), rgba(59,130,246,0.1)); backdrop-filter: blur(10px); padding: 16px 20px; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.2); font-size: 12px; color: #f3f4f6; border-left: 5px solid #8B5CF6; border-top: 2px solid #8B5CF6;">
                            <strong style="color: #f0f9ff; display: block; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">🗺️ Peta Jawa Tengah</strong>
                            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 8px;">
                                <span style="color: #bfdbfe;">35 Kota/Kabupaten</span>
                                <span style="color: #a5f3fc;">|</span>
                                <span style="color: #bfdbfe;">~2,500+ Kelurahan</span>
                            </div>
                            <div style="margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(255,255,255,0.1); font-size: 11px; color: #d1d5db;">
                                Zoom untuk detail lebih lanjut
                            </div>
                        </div>
                    `;
                    return div;
                };
                infoControl.addTo(map);

                // Add attribution control
                L.control.attribution({ position: 'topleft' }).addTo(map);

                // Add scale control
                L.control.scale({ imperial: false }).addTo(map);

                console.log('Map fully loaded with markers and controls');

            } catch (error) {
                console.error('Map error:', error);
                document.getElementById('map').innerHTML = '<div style="padding: 20px; color: #666;">❌ Gagal memuat peta. Silakan refresh halaman.</div>';
            }

            // Line Chart
            const lineCtx = document.getElementById('lineChart').getContext('2d');
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Data Bulanan',
                        data: [65, 59, 80, 81, 56, 55, 40, 45, 50, 60, 70, 75],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        }
                    }
                }
            });

            // Pie Chart
            const pieCtx = document.getElementById('pieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Kecamatan', 'Kelurahan', 'Users', 'Lainnya'],
                    datasets: [{
                        data: [35, 45, 15, 5],
                        backgroundColor: [
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(251, 146, 60)',
                            'rgb(139, 92, 246)'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
