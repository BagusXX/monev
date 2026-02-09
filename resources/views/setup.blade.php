<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ⚙️ {{ __('Setup & Pengaturan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola user dan pengaturan sistem</p>
            </div>
            <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">👥 User Management</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-8 text-gray-900">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                                <span class="text-3xl">👤</span> {{ __('Manajemen User') }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola dan administrasi pengguna sistem</p>
                        </div>
                        <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-yellow-600 to-amber-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-wider hover:shadow-lg hover:from-yellow-700 hover:to-amber-700 active:from-yellow-800 active:to-amber-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                            <span>➕</span> {{ __('Tambah User') }}
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-lg flex items-center gap-3 shadow-sm animate-pulse">
                            <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="font-semibold">✅ {{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-xl border-2 border-gray-200 shadow-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-yellow-50 to-amber-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-yellow-900 uppercase tracking-wider">👤 Nama</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-yellow-900 uppercase tracking-wider">📧 Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-yellow-900 uppercase tracking-wider">🗺️ Wilayah</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-yellow-900 uppercase tracking-wider">✅ Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-yellow-900 uppercase tracking-wider">⚡ Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users ?? [] as $user)
                                    <tr class="hover:bg-yellow-50 transition {{ $user->is_rejected ? 'bg-red-50 border-l-4 border-red-400' : (!$user->is_approved && !$user->is_main_admin ? 'bg-blue-50 border-l-4 border-blue-400' : '') }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $user->email }}</code></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full font-medium text-xs">{{ $user->daerah_label }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($user->is_main_admin)
                                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full font-semibold text-xs">👑 Admin Utama</span>
                                            @elseif($user->is_rejected)
                                                <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-full font-semibold text-xs">❌ Ditolak</span>
                                            @elseif(!$user->is_approved)
                                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold text-xs">⏳ Menunggu</span>
                                            @else
                                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full font-semibold text-xs">✅ Disetujui</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if(!$user->is_main_admin)
                                                @if($user->is_rejected)
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 transition font-semibold text-xs">
                                                            <span>🗑️</span> Hapus
                                                        </button>
                                                    </form>
                                                @elseif(!$user->is_approved)
                                                    @if(auth()->user()->is_main_admin)
                                                        <div class="flex items-center gap-2">
                                                            <form action="{{ route('users.approve', $user) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-semibold text-xs">
                                                                    <span>✅</span> Setujui
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('users.reject', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menolak user ini?');">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition font-semibold text-xs">
                                                                    <span>❌</span> Tolak
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <span class="text-gray-400 text-xs">Menunggu persetujuan admin</span>
                                                    @endif
                                                @else
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 hover:text-yellow-700 transition font-semibold text-xs">
                                                            <span>✏️</span> Edit
                                                        </a>
                                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 transition font-semibold text-xs">
                                                                <span>🗑️</span> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="text-4xl mb-2">📭</span>
                                                <p class="text-sm text-gray-500 font-medium">Tidak ada user. Buat user baru dengan klik tombol di atas.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($users) && $users->hasPages())
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
