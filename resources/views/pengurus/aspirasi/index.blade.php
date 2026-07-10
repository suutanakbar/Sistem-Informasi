<x-layouts.pengurus title="Aspirasi Saya" headerTitle="Aspirasi Saya">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Aspirasi Saya</h1>
            <a href="{{ route('aspirasi.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                Buat Aspirasi
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topik Aspirasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($aspirasis as $aspirasi)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $aspirasi->topik_aspirasi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                            $statusColors = [
                            'belum_ditanggapi' => 'bg-yellow-100 text-yellow-800',
                            'sedang_diproses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$aspirasi->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $aspirasi->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $aspirasi->dibuat_pada->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('aspirasi.show', $aspirasi) }}" class="text-orange-600 hover:text-orange-900">Detail</a>
                            @can('delete', $aspirasi)
                            <form method="POST" action="{{ route('aspirasi.destroy', $aspirasi) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-3">
                                    Hapus
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Belum ada aspirasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $aspirasis->links() }}
        </div>
    </div>
</div>
</x-layouts.pengurus>