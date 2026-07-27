<x-layouts.admin title="Detail Aspirasi" headerTitle="Detail Aspirasi">
    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Aspirasi</h1>
                        <p class="mt-1 text-sm text-gray-600">Informasi lengkap aspirasi mahasiswa</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('aspirasi.edit', $aspirasi) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-800 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Aspirasi
                        </a>
                        <a href="{{ route('aspirasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Aspirasi Information Card -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Aspirasi</h3>
                            <p class="text-sm text-gray-500">Data detail aspirasi mahasiswa</p>
                        </div>
                    </div>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Topik Aspirasi</dt>
                            <dd class="mt-1 text-base font-semibold text-gray-900">{{ $aspirasi->topik_aspirasi }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Ormada Pengaju</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $aspirasi->profilOrmada->nama_universitas }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Diajukan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $aspirasi->dibuat_pada->format('d F Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Status Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Status</h3>
                                <p class="text-sm text-gray-500">Status aspirasi saat ini</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            @php
                            $statusColors = [
                            'belum_ditanggapi' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'sedang_diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'selesai' => 'bg-green-100 text-green-800 border-green-200',
                            'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                            ];
                            @endphp
                            <span class="inline-flex items-center justify-center w-full px-4 py-3 rounded-lg text-sm font-bold border {{ $statusColors[$aspirasi->status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                {{ ucfirst(str_replace('_', ' ', $aspirasi->status)) }}
                            </span>
                        </div>
                    </div>

                    @if(auth()->user()->isPemda() || auth()->user()->isAdmin())
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Tanggapan</h3>
                                <p class="text-sm text-gray-500">Balas aspirasi ini</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('aspirasi.update-tanggapan', $aspirasi) }}" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="tanggapan_pemda" class="block text-sm font-medium text-gray-700 mb-1">Tanggapan</label>
                                <textarea name="tanggapan_pemda" id="tanggapan_pemda" rows="4" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('tanggapan_pemda', $aspirasi->tanggapan_pemda) }}</textarea>
                                @error('tanggapan_pemda')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="belum_ditanggapi" {{ $aspirasi->status === 'belum_ditanggapi' ? 'selected' : '' }}>Belum Ditanggapi</option>
                                    <option value="sedang_diproses" {{ $aspirasi->status === 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option value="selesai" {{ $aspirasi->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ $aspirasi->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Simpan Tanggapan
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Detail Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Detail Aspirasi</h3>
                        <p class="text-sm text-gray-500">Isi lengkap aspirasi yang diajukan</p>
                    </div>
                </div>
                <div class="prose max-w-none text-sm text-gray-700 bg-gray-50 rounded-lg p-4">
                    {!! nl2br(e($aspirasi->detail_aspirasi)) !!}
                </div>
            </div>

            <!-- File Section -->
            @if($aspirasi->file)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">File Pendukung</h3>
                        <p class="text-sm text-gray-500">Download dokumen pendukung</p>
                    </div>
                </div>
                <a href="{{ asset('storage/' . $aspirasi->file) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download File
                </a>
            </div>
            @endif
        </div>
    </div>
</x-layouts.admin>
