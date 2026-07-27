@extends('layouts.public')
@section('title', 'Berita - SI Ormada Temanggung')
@section('content')
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4">

            <div class="border-t border-b border-gray-300 py-8 mb-12">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-2">EDISI 005 / 2026</div>
                        <h1 class="text-4xl lg:text-5xl font-black uppercase" style="font-family:'Playfair Display',serif;">Berita</h1>
                    </div>
                    <p class="hidden lg:block text-sm text-gray-600 max-w-sm text-right">
                        Kumpulan berita terbaru seputar kegiatan ormada, prestasi mahasiswa, dan informasi terkini.
                    </p>
                </div>
            </div>

            @if($postingans->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 pb-16">
                @foreach($postingans as $postingan)
                <article class="group bg-white border border-gray-200 rounded-sm hover:shadow-md transition-shadow">
                    <a href="{{ route('public.postingan.show', $postingan) }}" class="block">
                        @if($postingan->foto)
                        <div class="w-full p-4 bg-gray-100 flex items-center justify-center">
                            <img src="{{ storage_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-auto object-contain object-center transition duration-500 group-hover:scale-105">
                        </div>
                        @endif
                        <div class="p-4">
                            <!-- Badges -->
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                                    {{ ucfirst($postingan->jenis_konten ?? $postingan->jenis) }}
                                </span>
                                @if($postingan->is_published)
                                <span class="px-2 py-1 text-[10px] font-medium bg-green-100 text-green-800 rounded-full">Published</span>
                                @else
                                <span class="px-2 py-1 text-[10px] font-medium bg-yellow-100 text-yellow-800 rounded-full">Draft</span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-base font-black leading-tight mb-2 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                                {{ $postingan->judul }}
                            </h3>

                            <!-- Summary -->
                            <p class="text-gray-600 leading-5 text-xs mb-3 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($postingan->isi_konten), 150) }}
                            </p>

                            <!-- Date -->
                            <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-2 uppercase tracking-widest">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ ($postingan->tanggal_publish ?? $postingan->dibuat_pada)->format('d M Y') }}
                            </div>

                            <!-- Author -->
                            <div class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">
                                {{ $postingan->admin->nama ?? 'Admin' }}
                            </div>

                            <!-- Footer -->
                            <div class="mt-3 pt-2 border-t border-gray-200">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-700 group-hover:text-blue-800 transition">
                                    Detail →
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
            @endif

        </div>
    </section>
@endsection