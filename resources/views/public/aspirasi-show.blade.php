@extends('layouts.public')
@section('title', $aspirasi->topik_aspirasi . ' - SI Ormada Temanggung')
@section('content')
    <!-- Page Header -->
    <section class="bg-white border-t border-b border-gray-300 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.aspirasi') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700 mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Aspirasi
            </a>
            <div class="max-w-4xl">
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                        Aspirasi
                    </span>
                    @if($aspirasi->tanggapan_pemda)
                    <span class="px-2 py-1 text-[10px] font-medium bg-green-100 text-green-800 rounded-full">Sudah Ditanggapi</span>
                    @else
                    <span class="px-2 py-1 text-[10px] font-medium bg-yellow-100 text-yellow-800 rounded-full">Menunggu Tanggapan</span>
                    @endif
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight mb-3" style="font-family:'Playfair Display',serif;">{{ $aspirasi->topik_aspirasi }}</h2>
                <div class="flex flex-wrap items-center gap-3 text-[10px] text-gray-500 uppercase tracking-widest">
                    <span>Oleh: {{ $aspirasi->profilOrmada->nama_universitas ?? 'Unknown' }}</span>
                    <span class="font-bold">•</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $aspirasi->dibuat_pada->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Aspirasi Detail -->
    <section class="bg-white py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="border border-gray-200 rounded-sm overflow-hidden hover:shadow-md transition-shadow">
                @if($aspirasi->profilOrmada->logo)
                <div class="w-full p-4 bg-gray-100 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $aspirasi->profilOrmada->logo) }}" alt="{{ $aspirasi->profilOrmada->nama_universitas }}" class="w-full h-auto object-contain object-center">
                </div>
                @endif
                
                <div class="p-4 sm:p-6">
                    <!-- Description -->
                    <div class="text-gray-700 whitespace-pre-line mb-8 text-base leading-relaxed">
                        {{ $aspirasi->detail_aspirasi }}
                    </div>

                    <!-- Response from Pemda -->
                    @if($aspirasi->tanggapan_pemda)
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-8">
                        <h3 class="text-sm font-semibold text-blue-900 mb-2">Tanggapan Pemda:</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $aspirasi->tanggapan_pemda }}</p>
                    </div>
                    @endif

                    <!-- Author Info -->
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        @if($aspirasi->profilOrmada->logo)
                        <img src="{{ asset('storage/' . $aspirasi->profilOrmada->logo) }}" alt="{{ $aspirasi->profilOrmada->nama_universitas }}" class="h-12 w-12 rounded-lg object-cover">
                        @else
                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-700 text-sm font-bold text-white">
                            {{ strtoupper(substr($aspirasi->profilOrmada->nama_universitas ?? 'UN', 0, 2)) }}
                        </div>
                        @endif
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Diajukan oleh</p>
                            <p class="text-sm text-gray-600">{{ $aspirasi->profilOrmada->nama_universitas ?? 'Unknown' }}</p>
                            <p class="text-xs text-gray-400">{{ $aspirasi->dibuat_pada->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
