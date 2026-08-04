<x-layouts.admin title="Kelola Volunteer - SI Ormada Temanggung">
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-gray-900">Kelola Volunteer</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola pendaftaran volunteer untuk semua agenda kegiatan</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Total</p>
                    <p class="mt-1 text-xl font-bold text-gray-900">{{ $volunteers->total() }}</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Menunggu</p>
                    <p class="mt-1 text-xl font-bold text-yellow-900">{{ $volunteers->where('status', 'pending')->count() }}</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Diterima</p>
                    <p class="mt-1 text-xl font-bold text-green-900">{{ $volunteers->where('status', 'diterima')->count() }}</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Ditolak</p>
                    <p class="mt-1 text-xl font-bold text-red-900">{{ $volunteers->where('status', 'ditolak')->count() }}</p>
                </div>
            </div>

            <!-- Volunteers Table -->
            <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-base font-semibold text-gray-900">Daftar Semua Volunteer</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Email</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No. Telepon</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Agenda</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Ormada</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Alasan</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($volunteers as $volunteer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $volunteer->nama }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    {{ $volunteer->email }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    {{ $volunteer->no_hp }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    {{ $volunteer->agenda->nama_agenda ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    {{ $volunteer->agenda->admin->nama ?? 'Umum' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'diterima' => 'bg-green-100 text-green-800 border border-green-200',
                                        'ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                                    ];
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$volunteer->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200' }}">
                                        {{ ucfirst($volunteer->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    @if($volunteer->status === 'ditolak')
                                        {{ $volunteer->catatan_penolakan ?? '-' }}
                                    @else
                                        {{ $volunteer->alasan ?? '-' }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                @if($volunteer->status === 'pending')
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Terima volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold mr-1">
                                        Terima
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Tolak volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                        Tolak
                                    </button>
                                </form>
                                @elseif($volunteer->status === 'diterima')
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Tolak volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold mr-1">
                                        Tolak
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Batalkan penerimaan volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 font-semibold">
                                        Batalkan
                                    </button>
                                </form>
                                @elseif($volunteer->status === 'ditolak')
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Terima volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold mr-1">
                                        Terima
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Batalkan penolakan volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 font-semibold">
                                        Batalkan
                                    </button>
                                </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Belum ada pendaftar volunteer.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($volunteers->hasPages())
                <div class="mt-4 px-4 py-3 border-t border-gray-200 bg-gray-50">
                    {{ $volunteers->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
