<x-layouts.app title="Kelola Volunteer - {{ $agenda->nama_agenda }}">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <a href="{{ route('agenda.show', $agenda) }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700 mb-4 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Agenda
                </a>
                <h1 class="text-3xl font-black text-gray-900" style="font-family:'Playfair Display',serif;">Kelola Volunteer</h1>
                <p class="mt-2 text-sm text-gray-600">{{ $agenda->nama_agenda }}</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
                <div class="border border-gray-200 rounded-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-xs font-medium uppercase tracking-wider">Total Pendaftar</p>
                            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $volunteers->total() }}</p>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-3">
                            <svg class="w-6 h-6 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-xs font-medium uppercase tracking-wider">Menunggu</p>
                            <p class="mt-2 text-3xl font-bold text-yellow-900">{{ $volunteers->where('status', 'pending')->count() }}</p>
                        </div>
                        <div class="bg-yellow-50 rounded-lg p-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-xs font-medium uppercase tracking-wider">Diterima</p>
                            <p class="mt-2 text-3xl font-bold text-green-900">{{ $volunteers->where('status', 'diterima')->count() }}</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-3">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-sm p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-xs font-medium uppercase tracking-wider">Ditolak</p>
                            <p class="mt-2 text-3xl font-bold text-red-900">{{ $volunteers->where('status', 'ditolak')->count() }}</p>
                        </div>
                        <div class="bg-red-50 rounded-lg p-3">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Volunteers Table -->
            <div class="border border-gray-200 rounded-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-900">Daftar Volunteer</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No HP</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alasan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Daftar</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($volunteers as $volunteer)
                            <tr class="hover:bg-gray-50 transition">
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
                                        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'diterima' => 'bg-green-100 text-green-800 border border-green-200',
                                        'ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                                    ];
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$volunteer->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200' }}">
                                        {{ ucfirst($volunteer->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $volunteer->dibuat_pada->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                @if($volunteer->status === 'pending')
                                <a href="{{ route('volunteer.edit', $volunteer) }}" class="text-blue-600 hover:text-blue-900 font-semibold mr-3">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline" onsubmit="return confirm('Terima volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold">
                                        Terima
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('volunteer.update-status', $volunteer) }}" class="inline ml-3" onsubmit="return confirm('Tolak volunteer ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
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
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
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
</x-layouts.app>