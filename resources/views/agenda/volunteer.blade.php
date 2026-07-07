<x-layouts.app title="Kelola Volunteer - {{ $agenda->nama_agenda }}">
    <div class="py-6">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Volunteer</h1>
                <p class="mt-1 text-sm text-gray-600">{{ $agenda->nama_agenda }}</p>
            </div>
            <a href="{{ route('agenda.show', $agenda) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                Kembali ke Agenda
            </a>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm text-blue-600">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $volunteers->total() }}</p>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4">
                        <p class="text-sm text-yellow-600">Menunggu</p>
                        <p class="text-2xl font-bold text-yellow-900">{{ $volunteers->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <p class="text-sm text-green-600">Diterima</p>
                        <p class="text-2xl font-bold text-green-900">{{ $volunteers->where('status', 'diterima')->count() }}</p>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4">
                        <p class="text-sm text-red-600">Ditolak</p>
                        <p class="text-2xl font-bold text-red-900">{{ $volunteers->where('status', 'ditolak')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($volunteers as $volunteer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $volunteer->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $volunteer->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $volunteer->no_hp }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ Str::limit($volunteer->alasan, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                    $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'diterima' => 'bg-green-100 text-green-800',
                                    'ditolak' => 'bg-red-100 text-red-800',
                                    ];
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$volunteer->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($volunteer->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $volunteer->dibuat_pada->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($volunteer->status === 'pending')
                                    <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">
                                            Terima
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Tolak
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada pendaftar volunteer.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $volunteers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>