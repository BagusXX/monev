<!-- Mobile Bottom Navigation Bar - Untuk pengalaman mobile yang lebih baik -->
<nav x-data="{ openMonitoring: false, openLaporan: false }" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg lg:hidden z-50">
    <div class="flex justify-around items-stretch h-16">
        <!-- Home -->
        <a href="{{ route('home') }}"
           class="flex flex-col items-center justify-center flex-1 text-xs font-medium transition-colors duration-200 group {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            <svg class="w-6 h-6 mb-1 transition-transform group-active:scale-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span>Home</span>
        </a>

        <!-- Daerah -->
        <a href="{{ route('daerah.index') }}"
           class="flex flex-col items-center justify-center flex-1 text-xs font-medium transition-colors duration-200 group {{ request()->routeIs('daerah.*') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243 4.243z" />
            </svg>
            <span>Daerah</span>
        </a>

        <!-- Monitoring (dropdown: Rapat, Kegiatan) -->
        <div class="flex flex-col items-center justify-center flex-1 relative" x-data="{ open: false }">
            <button @click="open = !open"
                    @click.away="open = false"
                    class="flex flex-col items-center justify-center w-full h-full text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 group active:scale-90">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Monitoring</span>
            </button>

            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-1/2 transform -translate-x-1/2 w-44 bg-white rounded-lg shadow-lg border border-gray-200 z-50 mb-2">
                <div class="py-1">
                    <a href="{{ route('monitor') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors {{ request()->routeIs('monitor') ? 'bg-primary-50 text-primary-600' : '' }}">📋 Monitoring Rapat</a>
                    <a href="{{ route('monitoring.kegiatan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors {{ request()->routeIs('monitoring.kegiatan*') ? 'bg-primary-50 text-primary-600' : '' }}">📌 Monitoring Kegiatan</a>
                </div>
            </div>
        </div>

        <!-- Laporan (dropdown: Rapat, Kegiatan) -->
        <div class="flex flex-col items-center justify-center flex-1 relative" x-data="{ open: false }">
            <button @click="open = !open"
                    @click.away="open = false"
                    class="flex flex-col items-center justify-center w-full h-full text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 group active:scale-90">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                </svg>
                <span>Laporan</span>
            </button>

            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-1/2 transform -translate-x-1/2 w-44 bg-white rounded-lg shadow-lg border border-gray-200 z-50 mb-2">
                <div class="py-1">
                    <a href="{{ route('laporan.rapat') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors {{ request()->routeIs('laporan.rapat') ? 'bg-primary-50 text-primary-600' : '' }}">📄 Laporan Rapat</a>
                    <a href="{{ route('laporan.kegiatan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors {{ request()->routeIs('laporan.kegiatan') ? 'bg-primary-50 text-primary-600' : '' }}">📝 Laporan Kegiatan</a>
                </div>
            </div>
        </div>

        <!-- Menu (dropdown: setup, daerah, settings, logout) -->
        <div class="flex flex-col items-center justify-center flex-1 relative" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false"
                    class="flex flex-col items-center justify-center w-full h-full text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 group active:scale-90">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span>Menu</span>
            </button>

            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-1/2 transform -translate-x-1/2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 mb-2">
                <div class="py-2">
                    <a href="{{ route('setup') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors {{ request()->routeIs('setup') ? 'bg-primary-50 text-primary-600' : '' }}">👥 User Management</a>
                    <a href="{{ route('daerah.index') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors {{ request()->routeIs('daerah.*') ? 'bg-primary-50 text-primary-600' : '' }}">📍 Manajemen Daerah</a>
                    <hr class="my-2">
                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:text-primary-600 hover:bg-primary-50 transition-colors">⚙️ Pengaturan</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors">🚪 Log Out</button>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
</nav>

<!-- Spacer untuk mobile agar content tidak tertutup bottom nav -->
<div class="lg:hidden h-16"></div>
