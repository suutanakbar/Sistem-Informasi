<?php
$f = 'resources/views/public/postingan.blade.php';
$c = <<<'BLADE'
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
            @php $hero = $postingans->first(); @endphp

            <a href="{{ route('public.postingan.show', $hero) }}" class="block mb-16 group">
                @if($hero->foto)
                <div class="w-full h-[500px] overflow-hidden mb-8">
                    <img src="{{ storage_url($hero->foto) }}" alt="{{ $hero->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                </div>
                @endif
                <div class="max-w-4xl">
                    <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-4">
                        {{ $hero->tanggal_publish->format('d M Y') }}
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-black leading-tight mb-4 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                        {{ $hero->judul }}
                    </h2>
                    <p class="text-base text-gray-600 leading-7">
                        {{ \Illuminate\Support\Str::limit(strip_tags($hero->isi_konten), 220) }}
                    </p>
                </div>
            </a>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 pb-16">
                @foreach($postingans->skip(1) as $postingan)
                <article class="group border border-gray-200 bg-white">
                    <a href="{{ route('public.postingan.show', $postingan) }}" class="block">
                        @if($postingan->foto)
                        <div class="overflow-hidden border-b border-gray-200">
                            <img src="{{ storage_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-3">
                                {{ $postingan->tanggal_publish->format('d M Y') }}
                            </div>
                            <h3 class="text-lg font-black leading-tight mb-3 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                                {{ $postingan->judul }}
                            </h3>
                            <p class="text-sm text-gray-600 leading-6 mb-4">
                                {{ \Illuminate\Support\Str::limit(strip_tags($postingan->isi_konten), 120) }}
                            </p>
                            <span class="inline-block text-xs font-bold uppercase tracking-widest text-blue-700 group-hover:text-blue-800 transition">
                                Baca Selengkapnya →
                            </span>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
            @endif

        </div>
    </section>
@endsection
BLADE;

file_put_contents($f, $c);
echo 'Updated';