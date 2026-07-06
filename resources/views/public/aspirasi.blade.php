<x-layouts.app title="Aspirasi Ormada">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Aspirasi Ormada</h1>
            <p class="mt-2 text-sm text-gray-600">Ruang aspirasi mahasiswa daerah untuk menyampaikan suara mereka kepada Pemda Temanggung.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($aspirasis as $aspirasi)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-start gap-3">
                        @if($aspirasi->profilOrmada->logo)
                        <img src="{{ asset('storage/' . $aspirasi->profilOrmada->logo) }}" 
                             alt="{{ $aspirasi->profilOrmada->nama_universitas }}" 
                             class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                        @else
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-500 text-xs font-semibold">
                                {{ substr($aspirasi->profilOrmada->nama_universitas, 0, 2) }}
                            </span>
                        </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-gray-900 truncate">{{ $aspirasi->topik_aspirasi }}</h3>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $aspirasi->profilOrmada->nama_universitas }}
                            </p>
                            <div class="mt-2">
                                @if(!$aspirasi->tanggapan_pemda)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-yellow-600 rounded-full mr-1.5"></span>
                                    Menunggu Tanggapan
                                </span>
                                @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-600 rounded-full mr-1.5"></span>
                                    Sudah Ditanggapi
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                                {{ Str::limit($aspirasi->detail_aspirasi, 120) }}
                            </p>
                            @if($aspirasi->tanggapan_pemda)
                            <div class="mt-3 bg-blue-50 border-l-4 border-blue-400 p-3">
                                <p class="text-xs font-semibold text-blue-800 mb-1">Tanggapan Pemda:</p>
                                <p class="text-sm text-gray-700">
                                    {{ Str::limit($aspirasi->tanggapan_pemda, 150) }}
                                </p>
                            </div>
                            @endif
                            <div class="mt-3 text-xs text-gray-400">
                                {{ $aspirasi->dibuat_pada->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Belum ada aspirasi.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $aspirasis->links() }}
        </div>
    </div>
</div>
</x-layouts.app>