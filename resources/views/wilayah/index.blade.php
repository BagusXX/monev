<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    🗺️ {{ __('Manajemen Wilayah') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data kota dan kabupaten di sistem</p>
            </div>
            <a href="{{ route('wilayah.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                <span>➕</span> Tambah Wilayah
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-r-lg flex items-start gap-3">
                    <span class="text-xl">✅</span>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Tab Navigation -->
            <div class="bg-white border-2 border-gray-200 rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="flex border-b-2 border-gray-200">
                    <a href="{{ route('wilayah.index', ['type' => 'kota']) }}"
                        class="flex-1 py-4 px-6 text-center font-bold transition {{ $type === 'kota' ? 'bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 border-b-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        🏙️ Kota
                    </a>
                    <a href="{{ route('wilayah.index', ['type' => 'kabupaten']) }}"
                        class="flex-1 py-4 px-6 text-center font-bold transition {{ $type === 'kabupaten' ? 'bg-gradient-to-r from-orange-50 to-amber-50 text-orange-700 border-b-4 border-orange-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        🌍 Kabupaten
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-6 sm:p-8">
                    @if($type === 'kota')
                        <h3 class="text-xl font-bold text-gray-900 mb-2">📋 Daftar Kota</h3>
                        <p class="text-gray-600 text-sm mb-6">Total: <span class="font-bold text-blue-600">{{ $kotas->total() }}</span> kota</p>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-50 to-cyan-50 border-b-2 border-gray-200">
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Kota</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Dibuat</th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($kotas as $index => $item)
                                        <tr class="hover:bg-blue-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $kotas->firstItem() + $index }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-lg">🌆</span>
                                                    <span class="font-medium">{{ $item->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-3">
                                                    <a href="{{ route('wilayah.edit.kota', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition font-medium text-xs">
                                                        <span>✏️</span> Edit
                                                    </a>
                                                    <form action="{{ route('wilayah.destroy.kota', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kota ini?');">
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
                                                    <p class="font-medium">Tidak ada data kota.</p>
                                                    <a href="{{ route('wilayah.create') }}" class="text-blue-600 hover:text-blue-800 underline text-sm mt-2">Buat kota baru</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($kotas->hasPages())
                            <div class="mt-6 flex justify-center">
                                {{ $kotas->links() }}
                            </div>
                        @endif
                    @else
                        <h3 class="text-xl font-bold text-gray-900 mb-2">📋 Daftar Kabupaten</h3>
                        <p class="text-gray-600 text-sm mb-6">Total: <span class="font-bold text-orange-600">{{ $kabupatens->total() }}</span> kabupaten</p>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gradient-to-r from-orange-50 to-amber-50 border-b-2 border-gray-200">
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Kabupaten</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Dibuat</th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($kabupatens as $index => $item)
                                        <tr class="hover:bg-orange-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $kabupatens->firstItem() + $index }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-lg">🗺️</span>
                                                    <span class="font-medium">{{ $item->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-3">
                                                    <a href="{{ route('wilayah.edit.kabupaten', $item) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition font-medium text-xs">
                                                        <span>✏️</span> Edit
                                                    </a>
                                                    <form action="{{ route('wilayah.destroy.kabupaten', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kabupaten ini?');">
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
                                                    <p class="font-medium">Tidak ada data kabupaten.</p>
                                                    <a href="{{ route('wilayah.create') }}" class="text-orange-600 hover:text-orange-800 underline text-sm mt-2">Buat kabupaten baru</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($kabupatens->hasPages())
                            <div class="mt-6 flex justify-center">
                                {{ $kabupatens->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
