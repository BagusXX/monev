<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    🗺️ {{ __('Manajemen Daerah') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data provinsi/daerah di sistem</p>
            </div>
            <a href="{{ route('daerah.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-amber-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                <span>➕</span> Tambah Daerah
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-r-lg flex items-start gap-3">
                    <span class="text-xl">✅</span>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 rounded-r-lg flex items-start gap-3">
                    <span class="text-xl">❌</span>
                    <div>
                        <p class="font-bold">Gagal!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">📋 Daftar Daerah</h3>
                    <p class="text-gray-600 text-sm mb-6">Total: <span class="font-bold text-yellow-600">{{ $daerahs->total() }}</span> daerah</p>

                    <!-- Desktop/Table view -->
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-yellow-50 to-amber-50 border-b-2 border-gray-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kode Daerah</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Daerah</th>
                                    
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($daerahs as $index => $daerah)
                                    <tr class="hover:bg-yellow-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $daerahs->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-yellow-700 bg-yellow-50 rounded">{{ $daerah->kode }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center gap-2">
                                                <span class="text-lg">🏛️</span>
                                                <span class="font-medium">{{ $daerah->nama }}</span>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="{{ route('daerah.edit', $daerah) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition font-medium text-xs">
                                                    <span>✏️</span> Edit
                                                </a>
                                                <form action="{{ route('daerah.destroy', $daerah) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus daerah ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium text-xs">
                                                        <span>🗑️</span> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <span class="text-4xl">📭</span>
                                                <p class="font-medium">Tidak ada data daerah.</p>
                                                <a href="{{ route('daerah.create') }}" class="text-yellow-600 hover:text-yellow-800 underline text-sm mt-2">Buat daerah baru</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                        <!-- Mobile/List view -->
                        <div class="sm:hidden space-y-3">
                            @forelse($daerahs as $index => $daerah)
                                <div class="bg-white p-4 border-2 border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-lg">🏛️</span>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $daerah->nama }}</div>
                                                    <div class="text-xs text-yellow-700 font-bold bg-yellow-50 inline-block px-2 py-0.5 rounded mt-1">{{ $daerah->kode }}</div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-gray-500">No. {{ $daerahs->firstItem() + $index }}</div>
                                        </div>

                                        <div class="flex flex-col items-end gap-2">
                                            <a href="{{ route('daerah.edit', $daerah) }}" class="w-28 text-center px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-sm">✏️ Edit</a>
                                            <form action="{{ route('daerah.destroy', $daerah) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus daerah ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-28 text-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm">🗑️ Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-white p-6 border-2 border-gray-200 rounded-lg text-center">
                                    <span class="text-4xl">📭</span>
                                    <p class="font-medium mt-2">Tidak ada data daerah.</p>
                                    <a href="{{ route('daerah.create') }}" class="text-yellow-600 hover:text-yellow-800 underline text-sm mt-2 inline-block">Buat daerah baru</a>
                                </div>
                            @endforelse
                        </div>

                    @if($daerahs->hasPages())
                        <div class="mt-6">
                            {{ $daerahs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
