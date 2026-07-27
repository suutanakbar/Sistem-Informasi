@extends('layouts.public')
@section('title', $postingan->judul . ' - SI Ormada Temanggung')
@section('content')
    <!-- Page Header -->
    <section class="hero-gradient text-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.postingan') }}" class="inline-flex items-center text-sm text-blue-100 hover:text-white mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Berita & Pengumuman
            </a>
            <div class="max-w-4xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-xs font-semibold bg-white/20 text-white rounded-full border border-white/30">
                        {{ ucfirst($postingan->jenis_konten) }}
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4">{{ $postingan->judul }}</h2>
                <div class="flex flex-wrap items-center gap-4 text-sm text-blue-100">
                    <span>Oleh: {{ $postingan->admin->nama }}</span>
                    <span>•</span>
                    <span>{{ $postingan->tanggal_publish->format('d F Y H:i') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Postingan Detail -->
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                @if($postingan->foto)
                <img src="{{ storage_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-96 object-cover">
                @endif
                <div class="p-6 sm:p-8">
                    <!-- Description -->
                    <div class="prose max-w-none text-gray-700 whitespace-pre-line mb-8 text-base leading-relaxed">
                        {{ $postingan->isi_konten }}
                    </div>

                    <!-- Author Info -->
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Dipublikasi oleh</p>
                            <p class="text-sm text-gray-600">{{ $postingan->admin->nama }}</p>
                            <p class="text-xs text-gray-400">{{ $postingan->tanggal_publish->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection