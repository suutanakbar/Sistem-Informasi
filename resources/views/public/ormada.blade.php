@extends('layouts.public')
@section('title', 'Profil Ormada - SI Ormada Temanggung')
@section('content')
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4">

            <div class="border-t border-b border-gray-300 py-8 mb-12">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-2">EDISI 005 / 2026</div>
                        <h1 class="text-4xl lg:text-5xl font-black uppercase" style="font-family:'Playfair Display',serif;">Profil Ormada</h1>
                    </div>
                    <p class="hidden lg:block text-sm text-gray-600 max-w-sm text-right">
                        Daftar organisasi mahasiswa yang terdaftar dalam sistem SI Ormada.
                    </p>
                </div>
            </div>

            <div class="border-b border-gray-300">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 divide-x divide-y divide-gray-200">
                    @foreach($profilOrmadas as $profil)
                    <article class="group">
                        <a href="{{ route('public.ormada.show', $profil) }}" class="block p-6">

                            <!-- Meta atas -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold uppercase tracking-[2px] text-gray-500">
                                    {{ $profil->created_at?->translatedFormat('d. F Y') ?? '—' }}
                                </span>
                                <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider border border-gray-300 text-gray-700">
                                    Ormada
                                </span>
                            </div>

                            <!-- Logo -->
                            @if($profil->logo || $profil->hover_image)
                            <div class="w-full aspect-[4/3] mb-4 bg-gray-100 overflow-hidden relative">
                                @if($profil->logo)
                                <img src="{{ asset('storage/' . $profil->logo) }}" alt="{{ $profil->nama_universitas }}" class="w-full h-full object-contain transition-all duration-500 group-hover:opacity-0">
                                @endif
                                @if($profil->hover_image)
                                <img src="{{ asset('storage/' . $profil->hover_image) }}" alt="{{ $profil->nama_universitas }} - Universitas" class="absolute inset-0 w-full h-full object-contain p-4 opacity-0 transition-all duration-500 group-hover:opacity-100">
                                @endif
                            </div>
                            @endif

                            <!-- Title -->
                            <h3 class="text-lg font-black uppercase leading-tight tracking-tight mb-2 group-hover:text-blue-700 transition">
                                {{ $profil->nama_universitas }}
                            </h3>

                            <!-- Summary -->
                            <p class="text-xs text-gray-600 leading-5 mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($profil->deskripsi), 150) }}
                            </p>

                            <!-- Stats -->
                            <div class="flex items-center gap-5 text-[10px] uppercase tracking-wider text-gray-500 pt-4 border-t border-gray-200">
                                <span><span class="font-bold text-gray-800">Anggota</span> {{ number_format($profil->anggota_count) }}</span>
                                <span><span class="font-bold text-gray-800">Pengurus</span> {{ number_format($profil->pengurus_count) }}</span>
                            </div>

                        </a>
                    </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-8">
                {{ $profilOrmadas->links() }}
            </div>
        </div>
    </section>
@endsection