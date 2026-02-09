<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ⏳ {{ __('Menunggu Persetujuan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Akun Anda sedang menunggu persetujuan dari Admin Utama</p>
            </div>
        </div>
    </x-slot>

    <style>
        @keyframes slideInScale {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shimmer {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.85;
            }
        }

        .modal-popup {
            animation: slideInScale 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .icon-float {
            animation: floating 3s ease-in-out infinite;
        }

        .shimmer-effect {
            animation: shimmer 2s ease-in-out infinite;
        }
    </style>

    <div class="py-8 bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 min-h-screen flex items-center justify-center px-4">
        <!-- Decorative Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-10 w-32 h-32 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 right-20 w-40 h-40 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-xl w-full mx-auto relative z-10">
            <!-- Main Modal -->
            <div class="modal-popup bg-white rounded-2xl shadow-2xl overflow-hidden border-0">
                <!-- Header Gradient -->
                <div class="bg-gradient-to-r from-orange-500 via-red-500 to-red-600 px-8 py-6 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=60 height=60 viewBox=0 0 60 60 xmlns=http://www.w3.org/2000/svg><g fill=none fill-rule=evenodd><g fill=%23ffffff opacity=.05><path d=M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>'); background-size: 60px 60px;"></div>
                    </div>
                    <div class="text-center relative z-10">
                        <div class="icon-float text-5xl mb-3" style="display: inline-block;">🔐</div>
                        <h2 class="text-3xl font-bold text-white">Akses Ditangguhkan</h2>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-8 py-10">
                    <!-- Main Message -->
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-8 mb-8 border-2 border-orange-200 backdrop-blur-sm">
                        <div class="flex items-start gap-4 mb-4">
                            <span class="text-4xl flex-shrink-0 animate-bounce" style="animation-duration: 2s;">⚠️</span>
                            <div>
                                <h3 class="text-2xl font-bold text-red-700 mb-2">
                                    Hubungi Admin Utama untuk bisa masuk
                                </h3>
                                <div class="text-gray-700 space-y-2">
                                    <p class="text-sm leading-relaxed">
                                        ✓ Akun Anda telah berhasil terdaftar
                                    </p>
                                    <p class="text-sm leading-relaxed">
                                        ✓ Sedang menunggu persetujuan dari Admin Utama
                                    </p>
                                    <p class="text-sm leading-relaxed font-semibold text-orange-700">
                                        → Hubungi administrator untuk mempercepat proses persetujuan
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 mb-8 border-l-4 border-blue-500">
                        <p class="text-xs text-gray-600 uppercase tracking-wide font-semibold mb-2">📧 Kontak Admin Utama</p>
                        <p class="text-xl font-bold text-blue-700 break-all">admin@gmail.com</p>
                        <p class="text-xs text-gray-600 mt-2">Hubungi melalui email di atas untuk persetujuan akun</p>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-3 mb-8">
                        <p class="text-xs text-gray-600 uppercase tracking-wide font-semibold">Langkah Selanjutnya:</p>
                        <div class="space-y-2">
                            <div class="flex gap-3 items-start">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500 text-white text-xs font-bold flex items-center justify-center">1</span>
                                <span class="text-sm text-gray-700 pt-0.5">Hubungi Admin Utama melalui email</span>
                            </div>
                            <div class="flex gap-3 items-start">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500 text-white text-xs font-bold flex items-center justify-center">2</span>
                                <span class="text-sm text-gray-700 pt-0.5">Tunggu persetujuan dari sistem</span>
                            </div>
                            <div class="flex gap-3 items-start">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-orange-500 text-white text-xs font-bold flex items-center justify-center">3</span>
                                <span class="text-sm text-gray-700 pt-0.5">Login kembali setelah akun disetujui</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-semibold transition-all duration-200 border border-gray-300 hover:border-gray-400">
                                🚪 Logout
                            </button>
                        </form>
                        <a href="{{ route('home') }}" class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-semibold transition-all duration-200 text-center shadow-md hover:shadow-lg">
                            ← Kembali
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-4 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-500">
                        ⏱️ Status: <span class="font-semibold text-gray-700">Menunggu Persetujuan Admin Utama</span>
                    </p>
                </div>
            </div>

            <!-- Info Card Below -->
            <div class="mt-8 bg-white/80 backdrop-blur rounded-xl shadow-lg p-6 border border-white/50">
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-2xl">💡</span>
                    <h4 class="font-bold text-gray-800">Butuh Bantuan?</h4>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Jika Anda memiliki pertanyaan tentang proses persetujuan, silakan hubungi admin melalui email atau lihat panduan sistem yang tersedia.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
