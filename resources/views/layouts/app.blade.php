<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('pks-logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Leaflet CSS and JS (for maps) -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Leaflet Map Custom Styles */
            #map {
                z-index: 0;
                font-family: inherit;
                border-radius: 8px;
            }
            
            .leaflet-container {
                font-family: inherit;
                background: #f5f5f5;
            }
            
            .leaflet-popup-content-wrapper {
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                border: none;
            }
            
            .leaflet-popup-content {
                margin: 0;
                padding: 0;
            }
            
            .custom-location-popup .leaflet-popup-content-wrapper {
                background: transparent !important;
            }
            
            .map-info-control {
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
            }
            
            .leaflet-control-scale {
                background: linear-gradient(135deg, rgba(17,24,39,0.9), rgba(59,130,246,0.05)) !important;
                color: white !important;
                border-radius: 8px;
                border: none !important;
            }
            
            .leaflet-control-scale-line {
                border: 2px solid white !important;
                border-top: none !important;
                color: white !important;
            }
            
            .leaflet-control-attribution {
                background: linear-gradient(135deg, rgba(17,24,39,0.7), rgba(59,130,246,0.05)) !important;
                color: #a0aec0 !important;
                font-size: 11px;
                border-radius: 6px;
                padding: 4px 8px !important;
            }
            
            .leaflet-tooltip {
                background: linear-gradient(135deg, rgba(17,24,39,0.95), rgba(59,130,246,0.1));
                color: #f0f9ff;
                border: 2px solid #8B5CF6;
                border-radius: 8px;
                box-shadow: 0 8px 16px rgba(0,0,0,0.2);
                font-weight: 600;
                padding: 6px 12px;
            }
            
            /* Sidebar collapse transition */
            @media (min-width: 1024px) {
                .main-content-wrapper {
                    margin-left: 16rem;
                    transition: margin-left 0.3s ease-in-out;
                }
                
                .main-content-wrapper.collapsed {
                    margin-left: 5rem;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen bg-gray-50 flex">
            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col lg:ml-64 main-content-wrapper" x-data="{}" x-on:sidebar-collapse.window="$el.classList.toggle('collapsed')">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 bg-gray-50">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>
