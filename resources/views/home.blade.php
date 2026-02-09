<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl bg-gradient-to-r from-primary-600 to-primary-600 bg-clip-text text-transparent leading-tight">
                    📊 {{ __('Dashboard Sistem') }}
                </h2>
                <p class="text-sm text-gray-500 mt-2">Selamat datang di sistem manajemen wilayah Jawa Tengah</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-primary-50 via-primary-50 to-primary-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-primary-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-primary-100">👥 Total Users</p>
                                <p class="text-3xl font-bold text-white mt-2">1,234</p>
                                <p class="text-xs text-primary-100 mt-2">+12.5% dari bulan lalu</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500 to-emerald-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-green-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <p class="text-sm font-medium text-green-100">🏘️ Total Kecamatan</p>
                        <p class="text-3xl font-bold text-white mt-2">45</p>
                        <p class="text-xs text-green-100 mt-2">+5 dari bulan lalu</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-violet-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-purple-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <p class="text-sm font-medium text-purple-100">📍 Total Kelurahan</p>
                        <p class="text-3xl font-bold text-white mt-2">128</p>
                        <p class="text-xs text-purple-100 mt-2">+8 dari bulan lalu</p>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-500 to-red-600 overflow-hidden shadow-lg sm:rounded-xl border-2 border-orange-400 hover:shadow-2xl hover:scale-105 transition-all duration-200 text-white">
                    <div class="p-6">
                        <p class="text-sm font-medium text-orange-100">📊 Total Kegiatan</p>
                        <p class="text-3xl font-bold text-white mt-2">892</p>
                        <p class="text-xs text-orange-100 mt-2">+23.1% dari bulan lalu</p>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mb-6">
                <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border-2 border-gradient-to-r from-purple-300 to-pink-300">
                    <div class="p-7 bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 border-b-4 border-gradient-to-r from-purple-500 to-pink-500">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h3 class="text-2xl font-bold text-transparent bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text">🗺️ Peta Provinsi Jawa Tengah</h3>
                                <p class="text-sm text-purple-200 mt-2 font-semibold">Visualisasi wilayah administrasi seluruh Provinsi Jawa Tengah</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 pt-4 border-t border-purple-400 flex-wrap">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-red-500 shadow-md"></span>
                                <span class="text-xs text-purple-100 font-semibold">Jateng Utara</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-primary-500 shadow-md"></span>
                                <span class="text-xs text-purple-100 font-semibold">Jateng Barat</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-md"></span>
                                <span class="text-xs text-purple-100 font-semibold">Jateng Tengah</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-primary-500 shadow-md"></span>
                                <span class="text-xs text-purple-100 font-semibold">Jateng Timur</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-primary-500 shadow-md"></span>
                                <span class="text-xs text-purple-100 font-semibold">Jateng Selatan</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-7 bg-gradient-to-br from-gray-50 to-primary-50">
                        <div class="rounded-xl overflow-hidden border-4 border-gradient-to-r from-purple-400 to-pink-400 shadow-2xl">
                            <div id="map" style="width: 100%; height: 500px; background: #f0f0f0;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200">
                    <div class="p-6 bg-gradient-to-r from-primary-50 to-primary-50 border-b-2 border-primary-200">
                        <h3 class="text-lg font-bold text-gray-800">📈 Line Chart</h3>
                    </div>
                    <div class="p-6">
                        <canvas id="lineChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200">
                    <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b-2 border-purple-200">
                        <h3 class="text-lg font-bold text-gray-800">🥧 Pie Chart</h3>
                    </div>
                    <div class="p-6">
                        <canvas id="pieChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map
            if (typeof L !== 'undefined') {
                try {
                    const map = L.map('map').setView([-7.5, 110.5], 9);
                    
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap',
                        maxZoom: 19
                    }).addTo(map);
                    
                    console.log('Map loaded successfully');
                } catch(e) {
                    console.error('Map error:', e);
                }
            }

            // Line Chart
            const lineCtx = document.getElementById('lineChart');
            if (lineCtx) {
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
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            // Pie Chart
            const pieCtx = document.getElementById('pieChart');
            if (pieCtx) {
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
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        });
    </script>
</x-app-layout>
