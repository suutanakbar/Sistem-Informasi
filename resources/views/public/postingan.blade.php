@extends('layouts.public')
@section('title', 'Berita & Pengumuman - SI Ormada Temanggung')
@section('content')
    <!-- Page Header -->
    <section class="bg-white py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Berita Terbaru</h2>
                    <p class="mt-2 text-sm text-gray-600">Informasi terbaru dari ormada dan Pemda Temanggung.</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <!-- Filter Tabs -->
                    <div class="flex items-center gap-2 bg-gray-100 p-1 rounded-lg">
                        <a href="{{ route('public.postingan') }}" 
                           class="px-4 py-2 text-sm font-medium rounded-md transition {{ !$jenis ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Utama
                        </a>
                        <a href="{{ route('public.postingan', ['jenis' => 'kegiatan']) }}" 
                           class="px-4 py-2 text-sm font-medium rounded-md transition {{ $jenis === 'kegiatan' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Kegiatan
                        </a>
                        <a href="{{ route('public.postingan', ['jenis' => 'daerah']) }}" 
                           class="px-4 py-2 text-sm font-medium rounded-md transition {{ $jenis === 'daerah' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Daerah
                        </a>
                    </div>
                    
                    <a href="#" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                        Lihat Semuanya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Postingan List - 3 Column Grid -->
    <section class="bg-gray-50 py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if($postingans->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($postingans as $postingan)
                    <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm flex">
                        @if($postingan->foto)
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $postingan->foto) }}" 
                                 alt="{{ $postingan->judul }}" 
                                 class="w-48 h-48 object-cover">
                        </div>
                        @else
                        <div class="flex-shrink-0 w-48 h-48 bg-gray-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div class="p-6 flex flex-col flex-1">
                            <div class="text-xs text-gray-400 mb-2">
                                {{ $postingan->tanggal_publish->format('d M Y') }}
                            </div>
                            <h3 class="font-bold text-base leading-6 text-gray-900 mb-2">
                                <a href="{{ route('public.postingan.show', $postingan) }}" class="hover:text-blue-700 transition">
                                    {{ $postingan->judul }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 leading-relaxed mb-4 flex-1">
                                {{ Str::limit($postingan->isi_konten, 100) }}
                            </p>
                            <div class="flex items-center justify-end">
                                <a href="{{ route('public.postingan.show', $postingan) }}" 
                                   class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                                    Baca selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Mobile "Lihat Semuanya" Link -->
                <div class="mt-8 sm:hidden">
                    <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                        Lihat Semuanya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v1m-4 9v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <p class="mt-4 text-sm text-gray-500">Belum ada postingan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection