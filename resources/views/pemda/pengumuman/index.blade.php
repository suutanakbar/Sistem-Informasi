<x-layouts.admin title="Manajemen Pengumuman" headerTitle="Manajemen Pengumuman">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Daftar Pengumuman</h2>
                <p class="mt-1 text-sm text-zinc-500">Kelola pengumuman untuk publik.</p>
            </div>
            <a href="{{ route('pengumuman.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Pengumuman
            </a>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white overflow-hidden">
            <table class="min-w-full divide-y divide-zinc-200">
                <thead class="bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Tanggal Publish</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse ($pengumumans as $item)
                        <tr class="hover:bg-zinc-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-zinc-900">{{ $item->judul }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">{{ $item->tanggal_publish->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('pengumuman.edit', $item) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('pengumuman.destroy', $item) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-zinc-500">Belum ada pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pengumumans->links() }}
        </div>
    </div>
</x-layouts.admin>