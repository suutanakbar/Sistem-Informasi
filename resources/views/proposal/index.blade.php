<x-layouts.admin title="Daftar Proposal" headerTitle="Proposal">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Proposal</h1>
            @can('create', App\Models\Proposal::class)
            <a href="{{ route('proposal.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Buat Proposal
            </a>
            @endcan
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="p-4">
                <form method="GET" action="{{ route('proposal.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $status)
                            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jenis_bantuan" class="block text-sm font-medium text-gray-700">Jenis Bantuan</label>
                        <select name="jenis_bantuan" id="jenis_bantuan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisBantuanOptions as $jenis)
                            <option value="{{ $jenis }}" {{ request('jenis_bantuan') === $jenis ? 'selected' : '' }}>
                                {{ ucfirst($jenis) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Kegiatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengaju</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dinas Tujuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Bantuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($proposals as $proposal)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $proposal->judul_kegiatan }}</div>
                            <div class="text-sm text-gray-500">Anggaran: Rp {{ number_format($proposal->anggaran_dibutuhkan, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $proposal->pengaju->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $proposal->dinasTujuan->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ucfirst($proposal->jenis_bantuan) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                            $statusColors = [
                            'diajukan' => 'bg-yellow-100 text-yellow-800',
                            'diproses_pemda' => 'bg-blue-100 text-blue-800',
                            'dana_cair' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$proposal->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($proposal->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $proposal->dibuat_pada->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('proposal.show', $proposal) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                            @can('update', $proposal)
                            <a href="{{ route('proposal.edit', $proposal) }}" class="text-indigo-600 hover:text-indigo-900 ml-3">Edit</a>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada proposal.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $proposals->links() }}
        </div>
    </div>
</div>
</x-layouts.admin>
