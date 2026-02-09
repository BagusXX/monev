<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    🏘️ {{ __('Data Kelurahan') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data kelurahan dalam sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-gray-200 rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-primary-600 to-pink-600 p-6">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-lg text-white">📋 Daftar Kelurahan</h3>
                        <a href="{{ route('kelurahan.create') }}" class="inline-flex items-center px-4 py-2.5 bg-white text-violet-700 rounded-lg font-bold hover:shadow-lg transition">
                            ➕ Tambah Kelurahan
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 rounded-r-lg p-4 flex items-start gap-3">
                            <span class="text-xl">✅</span>
                            <div>
                                <p class="font-bold">Berhasil!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-primary-50 to-primary-50 border-b-2 border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">🏘️ Nama Kelurahan</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">📅 Tanggal Dibuat</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-violet-700 uppercase tracking-wider">⚙️ Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($kelurahans as $index => $kelurahan)
                                    <tr class="hover:bg-violet-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $kelurahans->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $kelurahan->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $kelurahan->created_at->format('d-m-Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex items-center">
                                            <a href="{{ route('kelurahan.edit', $kelurahan) }}" class="inline-flex items-center px-3 py-1.5 bg-primary-100 text-primary-700 rounded-lg hover:bg-primary-200 transition font-bold">✏️ Edit</a>
                                            <form action="{{ route('kelurahan.destroy', $kelurahan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelurahan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-bold">🗑️ Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center">
                                            <div class="text-4xl mb-2">📭</div>
                                            <p class="text-sm text-gray-500">Tidak ada data kelurahan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($kelurahans->hasPages())
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            {{ $kelurahans->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

