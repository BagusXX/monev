<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    🏘️ {{ __('Manajemen Kelurahan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data kelurahan di sistem</p>
            </div>
            <a href="{{ route('kelurahan.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-primary-600 to-pink-600 text-white rounded-lg hover:shadow-lg transition font-bold text-sm">
                <span>➕</span> Tambah Kelurahan
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-primary-50 to-primary-50 border-l-4 border-primary-500 text-primary-800 rounded-r-lg flex items-start gap-3">
                    <span class="text-xl">✅</span>
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-2 border-gray-200 hover:shadow-xl transition">
                <div class="p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">📋 Daftar Kelurahan</h3>
                    <p class="text-gray-600 text-sm mb-6">Total: <span class="font-bold text-violet-600">{{ $kelurahans->total() }}</span> kelurahan</p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border-2 border-gray-200">
                            <thead class="bg-gradient-to-r from-primary-50 to-primary-50">
                                <tr class="border-b-2 border-gray-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">🔢 No</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">📝 Nama Kelurahan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">📅 Tanggal Dibuat</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">⚙️ Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($kelurahans as $index => $kelurahan)
                                    <tr class="hover:bg-violet-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kelurahans->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kelurahan->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $kelurahan->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('kelurahan.edit', $kelurahan) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-primary-100 text-primary-700 rounded-full hover:bg-primary-200 transition font-semibold text-xs">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('kelurahan.destroy', $kelurahan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelurahan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-full hover:bg-red-200 transition font-semibold text-xs">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                            <div class="text-4xl mb-2">📭</div>
                                            Tidak ada data kelurahan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($kelurahans->hasPages())
                        <div class="mt-6 border-t pt-4">
                            {{ $kelurahans->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
