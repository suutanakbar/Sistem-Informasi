@extends('layouts.public')
@section('title', 'Aspirasi Ormada - SI Ormada Temanggung')
@section('content')
            <!-- Page Header -->
            <section class="hero-gradient text-white py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">Aspirasi Ormada</h2>
                        <p class="mt-4 text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto">Ruang aspirasi mahasiswa daerah untuk menyampaikan suara mereka kepada Pemda Temanggung.</p>
                    </div>
                </div>
            </section>

            <!-- Aspirasi List -->
            <section class="bg-gray-50 py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($aspirasis as $aspirasi)
                        <article class="content-card bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            <div class="flex items-start gap-4">
                                @if($aspirasi->profilOrmada->logo)
                                <img src="{{ asset('storage/' . $aspirasi->profilOrmada->logo) }}" 
                                     alt="{{ $aspirasi->profilOrmada->nama_universitas }}" 
                                     class="h-12 w-12 rounded-full object-cover flex-shrink-0 shadow-sm">
                                @else
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-700 text-sm font-bold text-white shadow-sm">
                                    {{ strtoupper(substr($aspirasi->profilOrmada->nama_universitas, 0, 2)) }}
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-base leading-6 text-gray-900">{{ $aspirasi->topik_aspirasi }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $aspirasi->profilOrmada->nama_universitas }}</p>
                                    <div class="mt-2">
                                        @if(!$aspirasi->tanggapan_pemda)
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full border border-yellow-200">
                                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                            Menunggu Tanggapan
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold bg-green-100 text-green-800 rounded-full border border-green-200">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                            Sudah Ditanggapi
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-gray-600 leading-relaxed">
                                {{ Str::limit($aspirasi->detail_aspirasi, 120) }}
                            </p>
                            @if($aspirasi->tanggapan_pemda)
                            <div class="mt-4 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                                <p class="text-xs font-semibold text-blue-900 mb-1">Tanggapan Pemda:</p>
                                <p class="text-sm text-gray-700">
                                    {{ Str::limit($aspirasi->tanggapan_pemda, 100) }}
                                </p>
                            </div>
                            @endif
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400">{{ $aspirasi->dibuat_pada->diffForHumans() }}</p>
                            </div>
                        </article>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500">Belum ada aspirasi.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $aspirasis->links() }}
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
