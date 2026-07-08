@php
    $isPemda = ($layout ?? 'admin') === 'pemda';
    $headerTitle = 'Detail Proposal';
    $layoutTag = $isPemda ? 'layouts.pemda' : 'layouts.admin';
@endphp
<x-layouts.{{ $layoutTag }} title="Detail Proposal" headerTitle="{{ $headerTitle }}">
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Proposal</h1>
            <div class="flex gap-2">
                @can('update', $proposal)
                <a href="{{ route('proposal.edit', $proposal) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Edit Proposal
                </a>
                @endcan
                <a href="{{ route('proposal.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Proposal</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Judul Kegiatan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $proposal->judul_kegiatan }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pengaju</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $proposal->pengaju->nama }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dinas Tujuan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $proposal->dinasTujuan->nama }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jenis Bantuan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($proposal->jenis_bantuan) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Anggaran Dibutuhkan</dt>
                                <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($proposal->anggaran_dibutuhkan, 0, ',', '.') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tanggal Diajukan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $proposal->dibuat_pada->format('d F Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Proposal</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @php
                            $statusColors = [
                            'diajukan' => 'bg-yellow-100 text-yellow-800',
                            'diproses_pemda' => 'bg-blue-100 text-blue-800',
                            'dana_cair' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            ];
                            @endphp
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusColors[$proposal->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($proposal->status) }}
                            </span>
                        </div>

                        @if(auth()->user()->isPemda() || auth()->user()->isAdmin())
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Update Status</h4>
                            <form method="POST" action="{{ route('proposal.update-status', $proposal) }}" class="space-y-3">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status Baru</label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="diajukan" {{ $proposal->status === 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                        <option value="diproses_pemda" {{ $proposal->status === 'diproses_pemda' ? 'selected' : '' }}>Diproses Pemda</option>
                                        <option value="dana_cair" {{ $proposal->status === 'dana_cair' ? 'selected' : '' }}>Dana Cair</option>
                                        <option value="ditolak" {{ $proposal->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="catatan_pemda" class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <textarea name="catatan_pemda" id="catatan_pemda" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('catatan_pemda', $proposal->catatan_pemda) }}</textarea>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                    Update Status
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Deskripsi Kegiatan</h3>
                    <div class="prose max-w-none text-sm text-gray-700">
                        {!! nl2br(e($proposal->deskripsi_kegiatan)) !!}
                    </div>
                </div>

                @if($proposal->catatan_pemda)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Catatan Pemda</h3>
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                        <div class="text-sm text-gray-700">
                            {!! nl2br(e($proposal->catatan_pemda)) !!}
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">File Proposal</h3>
                    <a href="{{ asset('storage/' . $proposal->file_proposal) }}" target="_blank"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Proposal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.{{ $layoutTag }}>
