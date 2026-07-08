<x-layouts.admin title="Manajemen Admin" headerTitle="Manajemen Admin">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Daftar Admin</h2>
                <p class="mt-1 text-sm text-zinc-500">Kelola akun admin, pemda, dan pengurus ormada.</p>
            </div>
            <a href="{{ route('admin.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Admin
            </a>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white overflow-hidden">
            <table class="min-w-full divide-y divide-zinc-200">
                <thead class="bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Peran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Terakhir Masuk</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse ($admins as $admin)
                        <tr class="hover:bg-zinc-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-800">{{ substr($admin->nama, 0, 2) }}</span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-zinc-900">{{ $admin->nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">{{ $admin->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($admin->peran === 'admin')
                                    <span class="inline-flex rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">Admin</span>
                                @elseif($admin->peran === 'pemda')
                                    <span class="inline-flex rounded-full bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-800">Pemda</span>
                                @else
                                    <span class="inline-flex rounded-full bg-orange-100 px-2 py-1 text-xs font-semibold text-orange-800">Pengurus Ormada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                {{ $admin->terakhir_masuk ? $admin->terakhir_masuk->format('d/m/Y H:i') : 'Belum pernah' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.edit', $admin) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                @if($admin->id !== auth()->id())
                                    <form action="{{ route('admin.destroy', $admin) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-zinc-500">Belum ada data admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>