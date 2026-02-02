<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    ⚙️ {{ __('Setup & Pengaturan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola user dan pengaturan sistem</p>
            </div>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">👥 User Management</span>
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
                        <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-wider hover:shadow-lg hover:from-indigo-700 hover:to-blue-700 active:from-indigo-800 active:to-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
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
                            <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">👤 Nama</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">📧 Email</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">🗺️ Wilayah</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">📅 Tanggal Dibuat</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">⚡ Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users ?? [] as $user)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $user->email }}</code></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm"><span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full font-medium text-xs">{{ $user->wilayah_label }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3 flex items-center">
                                            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center gap-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition font-semibold">
                                                <span>✏️</span> Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 transition font-semibold">
                                                    <span>🗑️</span> Hapus
                                                </button>
                                            </form>
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
