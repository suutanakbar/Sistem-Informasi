@extends('layouts.public')
@section('title', 'Aspirasi Ormada - SI Ormada Temanggung')
@section('content')
    <!-- Page Header with Search -->
    <section class="hero-gradient text-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">Aspirasi</h2>
                <p class="mt-4 text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto">Ruang aspirasi mahasiswa daerah untuk menyampaikan suara mereka kepada Pemda Temanggung.</p>
            </div>
            
            <!-- Search Bar -->
            <div class="mt-8 max-w-2xl mx-auto">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari..." 
                           class="w-full px-4 py-3 pl-12 pr-4 text-gray-900 bg-white rounded-lg border-0 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Aspirasi Grid -->
    @if($aspirasis->isNotEmpty())
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($aspirasis as $aspirasi)
                <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                    @if($aspirasi->profilOrmada->logo)
                    <div class="w-full h-48 overflow-hidden bg-gray-100">
                        <img src="{{ profil_logo_url($aspirasi->profilOrmada->logo) }}" alt="{{ $aspirasi->profilOrmada->nama_universitas }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>
                    @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-700 text-xl font-bold text-white">
                            {{ strtoupper(substr($aspirasi->profilOrmada->nama_universitas, 0, 2)) }}
                        </div>
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs text-gray-400 mb-2">
                            {{ $aspirasi->dibuat_pada->format('d M Y') }}
                        </div>
                        <h3 class="font-bold text-base leading-tight text-gray-900 mb-3">
                            <a href="{{ route('public.aspirasi.show', $aspirasi) }}" class="hover:text-blue-700 transition">
                                {{ $aspirasi->topik_aspirasi }}
                            </a>
                        </h3>
                        <a href="{{ route('public.aspirasi.show', $aspirasi) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                            Baca selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @else
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <p class="mt-4 text-sm text-gray-500">Belum ada aspirasi.</p>
            </div>
        </div>
    </section>
    @endif
@endsection