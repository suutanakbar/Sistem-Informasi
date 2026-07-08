<x-layouts.pemda title="Kelola Volunteer" headerTitle="Kelola Volunteer">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Daftar Volunteer</h2>
                <p class="mt-1 text-sm text-zinc-500">Kelola pendaftaran volunteer untuk agenda kegiatan.</p>
            </div>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white overflow-hidden">
            <table class="min-w-full divide-y divide-zinc-200">
                <thead class="bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">No. Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Agenda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Ormada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse ($volunteers as $volunteer)
                        <tr class="hover:bg-zinc-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900">
                                {{ $volunteer->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                {{ $volunteer->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                {{ $volunteer->no_telepon }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                {{ $volunteer->agenda->nama ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                {{ $volunteer->profilOrmada->nama_ormada ?? 'Umum' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($volunteer->status === 'menunggu')
                                    <span class="inline-flex rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">Menunggu</span>
                                @elseif($volunteer->status === 'diterima')
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Diterima</span>
                                @else
                                    <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($volunteer->status === 'menunggu')
                                    <form action="{{ route('volunteer.update-status', $volunteer) }}" method="POST" class="inline-block" onsubmit="return confirm('Terima volunteer ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" class="text-green-600 hover:text-green-900">Terima</button>
                                    </form>
                                    <form action="{{ route('volunteer.update-status', $volunteer) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Tolak volunteer ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                    </form>
                                @else
                                    <span class="text-zinc-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-zinc-500">Belum ada pendaftar volunteer.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.pemda>