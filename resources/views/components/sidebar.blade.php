<div x-data="{ open: false, collapsed: false, isMobile: window.innerWidth < 1024 }"
    @resize.window="isMobile = window.innerWidth < 1024"
    x-on:sidebar-toggle.window="open = !open; document.body.classList.toggle('overflow-hidden', open); if (open) $nextTick(()=> $refs.firstLink?.focus())"
    x-on:sidebar-close.window="open = false; document.body.classList.remove('overflow-hidden')"
    x-on:sidebar-collapse.window="collapsed = !collapsed">
    <!-- Mobile overlay - dengan smooth transition -->
    <div x-show="open" 
         @click="open = false; document.body.classList.remove('overflow-hidden')" 
         x-transition:enter="transition-opacity ease-linear duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="transition-opacity ease-linear duration-300" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>

    <aside id="sidebar" 
        @click.away="if (isMobile) open = false" 
        class="fixed left-0 top-0 z-40 h-screen bg-gradient-to-b from-white to-gray-50 border-r border-gray-200 shadow-xl transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out" 
        :class="{ 'translate-x-0': open, 'w-64': !collapsed, 'w-20': collapsed && window.innerWidth >= 1024 }" 
        :aria-hidden="isMobile ? !open : false">
        
        <!-- Mobile menu close button -->
        <div class="lg:hidden absolute top-4 right-4 z-50">
            <button @click="open = false; document.body.classList.remove('overflow-hidden')" 
                    aria-label="Tutup menu" 
                    class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-200 active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    <div class="h-full px-3 py-4 overflow-y-auto flex flex-col">
        <!-- Logo & Toggle Button -->
        <div class="mb-6 px-4 py-4 border-b border-gray-200 flex items-center" :class="{ 'justify-center': collapsed, 'justify-between': !collapsed }">
            <!-- Logo -->
            <a x-show="!collapsed" href="{{ route('home') }}" class="flex items-center group">
                <x-application-logo class="block h-9 w-auto fill-current text-primary-600 group-hover:scale-110 transition-transform" />
                <span class="ml-3 text-lg font-bold text-gray-900 hidden lg:inline">{{ config('app.name', 'Laravel') }}</span>
            </a>
            
            <!-- Collapse button (Desktop only) -->
            <button x-show="!collapsed" @click="$dispatch('sidebar-collapse')" class="hidden lg:block p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all duration-200 active:scale-95" title="Collapse sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            
            <!-- Expand button (Desktop only, centered) -->
            <button x-show="collapsed" @click="$dispatch('sidebar-collapse')" class="hidden lg:flex items-center justify-center w-full p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all duration-200 active:scale-95" title="Expand sidebar">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="space-y-1 flex-1 overflow-y-auto scrollbar-hide">
            <!-- Main Menu Items -->
            <x-sidebar-link x-ref="firstLink" :href="route('home')" :active="request()->routeIs('home')" class="group relative">
                <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
                <span x-show="!collapsed" class="hidden lg:inline font-medium">Home</span>
                <!-- Mobile label on collapsed -->
                <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">Home</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('setup')" :active="request()->routeIs('setup')" class="group relative">
                <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </span>
                <span x-show="!collapsed" class="hidden lg:inline font-medium">User Management</span>
                <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">User Management</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('monitor')" :active="request()->routeIs('monitor')" class="group relative">
                <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
                <span x-show="!collapsed" class="hidden lg:inline font-medium">Monitoring Rapat</span>
                <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">Monitoring Rapat</span>
            </x-sidebar-link>

            <x-sidebar-link :href="route('monitoring.kegiatan')" :active="request()->routeIs('monitoring.kegiatan*')" class="group relative">
                <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                </span>
                <span x-show="!collapsed" class="hidden lg:inline font-medium">Monitoring Kegiatan</span>
                <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">Monitoring Kegiatan</span>
            </x-sidebar-link>

            <!-- Daerah Section -->
            <div class="pt-6 mt-6 border-t border-gray-200">
                <div class="px-4 mb-3">
                    <h3 x-show="!collapsed" class="text-xs font-semibold text-gray-500 uppercase tracking-widest">
                        📍 Daerah
                    </h3>
                </div>
                
                <x-sidebar-link :href="route('daerah.index')" :active="request()->routeIs('daerah.*')" class="group relative">
                    <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503-6.024A6.75 6.75 0 0 0 6.75 12c0-3.318 2.682-6 6-6 3.318 0 6 2.682 6 6 0 2.613-1.68 4.823-4.001 5.674m0 0h7.5M3 20.25v-10.08a6 6 0 0 1 5.999-6m0 0H21m-4.5 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                    </span>
                    <span x-show="!collapsed" class="hidden lg:inline font-medium">Manajemen Daerah</span>
                    <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">Manajemen Daerah</span>
                </x-sidebar-link>
            </div>

            <!-- Laporan Section -->
            <div class="pt-6 mt-6 border-t border-gray-200">
                <div class="px-4 mb-3">
                    <h3 x-show="!collapsed" class="text-xs font-semibold text-gray-500 uppercase tracking-widest">
                        📊 Laporan
                    </h3>
                </div>

                <x-sidebar-link :href="route('laporan.rapat')" :active="request()->routeIs('laporan.rapat*')" class="group relative">
                    <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                    </span>
                    <span x-show="!collapsed" class="hidden lg:inline font-medium">Laporan Rapat</span>
                    <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">Laporan Rapat</span>
                </x-sidebar-link>

                <x-sidebar-link :href="route('laporan.kegiatan')" :active="request()->routeIs('laporan.kegiatan*')" class="group relative">
                    <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </span>
                    <span x-show="!collapsed" class="hidden lg:inline font-medium">Laporan Kegiatan</span>
                    <span x-show="collapsed && isMobile" class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-50 hidden md:inline-block">Laporan Kegiatan</span>
                </x-sidebar-link>
            </div>
            
        </nav>

        <!-- Footer/User Actions for Mobile -->
        <div x-show="!collapsed" class="hidden lg:block pt-6 border-t border-gray-200 mt-auto">
            <div class="text-xs text-gray-500 px-4 py-2 truncate">
                Logged in as: <br> <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>
    </aside>
</div>
