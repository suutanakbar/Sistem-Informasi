@extends('layouts.public')
@section('title', 'Agenda Kegiatan - SI Ormada Temanggung')
@section('content')
    <!-- Page Header with Search -->
    <section class="hero-gradient text-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">Agenda Kegiatan</h2>
                <p class="mt-4 text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto">Jadwal kegiatan yang akan datang. Dapatkan informasi terbaru tentang kegiatan ormada.</p>
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

    <!-- Agenda Grid -->
    @if($agendas->isNotEmpty())
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($agendas as $agenda)
                <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                    @if($agenda->gambar_poster)
                    <div class="w-full h-48 overflow-hidden bg-gray-100">
                        <img src="{{ storage_url($agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs text-gray-400 mb-2">
                            {{ $agenda->waktu_mulai->format('d M Y') }}
                        </div>
                        <h3 class="font-bold text-base leading-tight text-gray-900 mb-3">
                            <a href="{{ route('public.agenda.show', $agenda) }}" class="hover:text-blue-700 transition">
                                {{ $agenda->nama_agenda }}
                            </a>
                        </h3>
                        <a href="{{ route('public.agenda.show', $agenda) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                            Lihat Detail
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="mt-4 text-sm text-gray-500">Belum ada agenda kegiatan.</p>
            </div>
        </div>
    </section>
    @endif
@endsection