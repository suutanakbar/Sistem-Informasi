@extends('layouts.public')
@section('title', 'Berita - SI Ormada Temanggung')
@section('content')
    <section class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 pb-16">

            <div class="border-t border-b border-gray-300 py-8 mb-10 bg-white -mx-4 px-4">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-2">EDISI 005 / 2026</div>
                        <h1 class="text-4xl lg:text-5xl font-black uppercase pb-4 border-b border-gray-300" style="font-family:'Playfair Display',serif;">Berita</h1>
                    </div>
                    <p class="hidden lg:block text-sm text-gray-600 max-w-sm text-right pt-1">
                        Kumpulan berita terbaru seputar kegiatan ormada, prestasi mahasiswa, dan informasi terkini.
                    </p>
                </div>
            </div>

            @if($postingans->isNotEmpty())
            <div class="columns-1 md:columns-2 xl:columns-3 gap-6">
                @foreach($postingans as $postingan)
                <article class="break-inside-avoid mb-6 bg-white border border-gray-200 group">
                    <a href="{{ route('public.postingan.show', $postingan) }}" class="block">
                        @if($postingan->foto)
                        <div class="w-full overflow-hidden">
                            <img src="{{ storage_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-auto object-cover transition duration-500 group-hover:opacity-90">
                        </div>
                        @endif
                        <div class="p-4">
                            <!-- Badges -->
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700">
                                    {{ ucfirst($postingan->jenis_konten ?? $postingan->jenis) }}
                                </span>
                                @if($postingan->is_published)
                                <span class="text-[10px] font-bold uppercase tracking-wider text-green-700">Published</span>
                                @else
                                <span class="text-[10px] font-bold uppercase tracking-wider text-yellow-700">Draft</span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-base font-black leading-tight mb-2 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                                {{ $postingan->judul }}
                            </h3>

                            <!-- Summary -->
                            <p class="text-gray-600 leading-5 text-xs mb-3">
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
                            <div class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-3">
                                {{ $postingan->admin->nama ?? 'Admin' }}
                            </div>

                            <!-- Footer -->
                            <div class="pt-3 border-t border-gray-200">
                                <span class="inline-flex items-center px-4 py-1.5 border border-gray-900 rounded-full text-[10px] font-bold uppercase tracking-wider text-gray-900 group-hover:bg-gray-900 group-hover:text-white transition">
                                    Detail
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