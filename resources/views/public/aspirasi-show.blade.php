@extends('layouts.public')
@section('title', $aspirasi->topik_aspirasi . ' - SI Ormada Temanggung')
@section('content')
    <!-- Page Header -->
    <section class="hero-gradient text-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.aspirasi') }}" class="inline-flex items-center text-sm text-blue-100 hover:text-white mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Aspirasi
            </a>
            <div class="max-w-4xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-xs font-semibold bg-white/20 text-white rounded-full border border-white/30">
                        Aspirasi
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">{{ $aspirasi->topik_aspirasi }}</h2>
                <div class="flex flex-wrap items-center gap-4 text-sm text-blue-100">
                    <span>Oleh: {{ $aspirasi->profilOrmada->nama_universitas ?? 'Unknown' }}</span>
                    <span>•</span>
                    <span>{{ $aspirasi->dibuat_pada->format('d F Y H:i') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Aspirasi Detail -->
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                @if($aspirasi->profilOrmada->logo)
                <div class="w-full h-64 sm:h-96 overflow-hidden bg-gray-100">
                    <img src="{{ profil_logo_url($aspirasi->profilOrmada->logo) }}" alt="{{ $aspirasi->profilOrmada->nama_universitas }}" class="w-full h-full object-cover">
                </div>
                @endif
                
                <div class="p-6 sm:p-8">
                    <!-- Status Badge -->
                    <div class="mb-6">
                        @if($aspirasi->tanggapan_pemda)
                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full border border-green-200">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                            Sudah Ditanggapi
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full border border-yellow-200">
                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                            Menunggu Tanggapan
                        </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none text-gray-700 whitespace-pre-line mb-8 text-base leading-relaxed">
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
                        <img src="{{ profil_logo_url($aspirasi->profilOrmada->logo) }}" alt="{{ $aspirasi->profilOrmada->nama_universitas }}" class="h-12 w-12 rounded-lg object-cover">
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