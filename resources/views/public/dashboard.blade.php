@extends('layouts.public')
@section('content')

@php
    $headline = $postingans->first();
    $sideNews = $postingans->skip(1)->take(2);
    $gridNews = $postingans->skip(3)->take(4);
    $headlineAgenda = $agendas->first();
    $respondedAspirasi = $aspirasis->firstWhere('tanggapan_pemda', '!=', null) ?? $aspirasis->first();
@endphp

{{-- ====================================== --}}
{{-- HERO: HEADLINE BERITA + AGENDA/ASPIRASI --}}
{{-- ====================================== --}}

<section class="mt-4">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-b border-gray-300 pb-6">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- Headline berita --}}
                <div class="xl:col-span-2">
                    @if($headline)
                        <a href="{{ route('public.postingan.show', $headline) }}" class="group block">
                            <div class="uppercase tracking-[3px] text-[10px] text-gray-500 font-bold">
                                {{ ucfirst($headline->jenis_konten ?? $headline->jenis) }}
                            </div>
                            <h1 class="mt-2 text-2xl xl:text-3xl font-black leading-tight group-hover:text-blue-700 transition"
                                style="font-family:'Playfair Display',serif;">
                                {{ $headline->judul }}
                            </h1>
                            @if($headline->foto)
                                <div class="mt-4 w-full bg-gray-100">
                                    <img src="{{ storage_url($headline->foto) }}" alt="{{ $headline->judul }}"
                                         class="w-full h-64 object-cover">
                                </div>
                            @endif
                            <p class="mt-3 text-gray-600 text-sm leading-6">
                                {{ Str::limit(strip_tags($headline->isi_konten), 220) }}
                            </p>
                            <div class="mt-2 text-[10px] uppercase tracking-widest text-gray-400">
                                {{ ($headline->tanggal_publish ?? $headline->dibuat_pada)->format('d M Y') }}
                            </div>
                        </a>
                    @else
                        <p class="text-sm text-gray-500">Belum ada berita.</p>
                    @endif
                </div>

                {{-- Agenda terdekat & aspirasi ditanggapi --}}
                <div class="flex flex-col gap-4">

                    @if($headlineAgenda)
                        <a href="{{ route('public.agenda.show', $headlineAgenda) }}" class="group block border border-gray-200 rounded-sm overflow-hidden">
                            @if($headlineAgenda->gambar_poster)
                                <img src="{{ storage_url($headlineAgenda->gambar_poster) }}"
                                     class="w-full h-24 object-cover">
                            @endif
                            <div class="p-3">
                                <div class="uppercase tracking-[2px] text-[9px] text-gray-500 font-bold">
                                    Agenda Terdekat
                                </div>
                                <h3 class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                                    style="font-family:'Playfair Display',serif;">
                                    {{ $headlineAgenda->nama_agenda }}
                                </h3>
                                <div class="mt-1 text-[10px] text-gray-500 uppercase tracking-widest">
                                    {{ $headlineAgenda->waktu_mulai->format('d M Y') }} &middot; {{ $headlineAgenda->tempat }}
                                </div>
                            </div>
                        </a>
                    @endif

                    @if($respondedAspirasi)
                        <a href="{{ route('public.aspirasi.show', $respondedAspirasi) }}" class="group block border border-gray-200 rounded-sm p-3 bg-gray-50">
                            <div class="uppercase tracking-[2px] text-[9px] text-gray-500 font-bold">
                                {{ $respondedAspirasi->tanggapan_pemda ? 'Aspirasi Ditanggapi' : 'Aspirasi Menunggu' }}
                            </div>
                            <h4 class="mt-1 text-xs font-black leading-tight group-hover:text-blue-700 transition"
                                style="font-family:'Playfair Display',serif;">
                                {{ $respondedAspirasi->topik_aspirasi }}
                            </h4>
                            <div class="mt-1 text-[10px] text-gray-500">
                                {{ $respondedAspirasi->profilOrmada->nama_universitas ?? '-' }}
                            </div>
                        </a>
                    @endif

                </div>

            </div>
        </div>
    </div>
</section>

{{-- ====================================== --}}
{{-- TERBARU: TAB KATEGORI --}}
{{-- ====================================== --}}

<section class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-b border-gray-300 pb-6">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-black uppercase tracking-wide" style="font-family:'Playfair Display',serif;">
                    Terbaru
                </h2>
                <div class="flex gap-3 text-[10px] uppercase tracking-widest text-gray-500">
                    <a href="{{ route('public.postingan') }}" class="text-gray-900 font-bold">Semua</a>
                    <a href="{{ route('public.postingan', ['jenis' => 'berita']) }}" class="hover:text-blue-700 transition">Berita</a>
                    <a href="{{ route('public.agenda') }}" class="hover:text-blue-700 transition">Agenda</a>
                    <a href="{{ route('public.postingan', ['jenis' => 'prestasi']) }}" class="hover:text-blue-700 transition">Prestasi</a>
                </div>
            </div>

            @if($sideNews->isNotEmpty() || $gridNews->isNotEmpty())
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

                    @if($sideNews->isNotEmpty())
                        @foreach($sideNews->take(1) as $item)
                            <a href="{{ route('public.postingan.show', $item) }}" class="group xl:col-span-2 block border border-gray-200 rounded-sm overflow-hidden">
                                @if($item->foto)
                                    <img src="{{ storage_url($item->foto) }}" alt="{{ $item->judul }}"
                                         class="w-full h-40 object-cover">
                                @endif
                                <div class="p-3">
                                    <div class="uppercase tracking-[2px] text-[9px] text-gray-500 font-bold">
                                        {{ ucfirst($item->jenis_konten ?? $item->jenis) }}
                                    </div>
                                    <h3 class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                                        style="font-family:'Playfair Display',serif;">
                                        {{ $item->judul }}
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    <div class="flex flex-col gap-3">
                        @foreach($sideNews->skip(1)->take(2) as $item)
                            <a href="{{ route('public.postingan.show', $item) }}" class="group flex gap-2 items-start">
                                @if($item->foto)
                                    <img src="{{ storage_url($item->foto) }}" alt="{{ $item->judul }}"
                                         class="w-14 h-14 object-cover rounded-sm flex-shrink-0">
                                @endif
                                <div class="text-xs font-bold leading-tight group-hover:text-blue-700 transition"
                                     style="font-family:'Playfair Display',serif;">
                                    {{ $item->judul }}
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            @else
                <p class="text-sm text-gray-500">Belum ada konten terbaru.</p>
            @endif

        </div>
    </div>
</section>

{{-- ====================================== --}}
{{-- HIGHLIGHT CAMPURAN --}}
{{-- ====================================== --}}

<section class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-b border-gray-300 pb-6">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- List kecil: profil ormada --}}
                <div class="flex flex-col gap-4">
                    <div class="uppercase tracking-widest text-[11px] font-bold text-gray-500 border-b border-gray-200 pb-2">
                        Profil Ormada
                    </div>
                    @forelse($profilOrmadas->take(3) as $profil)
                        <a href="{{ route('public.ormada.show', $profil) }}" class="group flex gap-3 items-center">
                            @if($profil->logo)
                                <img src="{{ profil_logo_url($profil->logo) }}" alt="{{ $profil->nama_universitas }}"
                                     class="w-12 h-12 object-cover rounded-sm flex-shrink-0 border border-gray-200">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-sm flex items-center justify-center flex-shrink-0 border border-gray-200">
                                    <span class="text-xs font-black">{{ strtoupper(substr($profil->nama_universitas, 0, 2)) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-xs font-black leading-tight group-hover:text-blue-700 transition"
                                    style="font-family:'Playfair Display',serif;">
                                    {{ $profil->nama_universitas }}
                                </h3>
                                <p class="mt-0.5 text-[10px] text-gray-500">
                                    {{ number_format($profil->anggota_count) }} anggota
                                </p>
                            </div>
                        </a>
                    @empty
                        <p class="text-xs text-gray-500">Belum ada profil ormada.</p>
                    @endforelse
                </div>

                {{-- Gambar besar: agenda berikutnya --}}
                <div class="xl:col-span-2">
                    @php $secondAgenda = $agendas->skip(1)->first(); @endphp
                    @if($secondAgenda)
                        <a href="{{ route('public.agenda.show', $secondAgenda) }}" class="group block">
                            @if($secondAgenda->gambar_poster)
                                <img src="{{ storage_url($secondAgenda->gambar_poster) }}"
                                     class="w-full h-56 object-cover rounded-sm">
                            @endif
                            <div class="uppercase tracking-[3px] text-[10px] text-gray-500 font-bold mt-3">
                                {{ strtoupper($secondAgenda->kategori) }}
                            </div>
                            <h2 class="mt-1 text-xl font-black leading-tight group-hover:text-blue-700 transition"
                                style="font-family:'Playfair Display',serif;">
                                {{ $secondAgenda->nama_agenda }}
                            </h2>
                        </a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ====================================== --}}
{{-- THUMBNAIL STRIP --}}
{{-- ====================================== --}}

<section class="mt-6 mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">

            @if($gridNews->isNotEmpty())
                @foreach($gridNews->take(1) as $item)
                    <a href="{{ route('public.postingan.show', $item) }}" class="group block">
                        @if($item->foto)
                            <img src="{{ storage_url($item->foto) }}" alt="{{ $item->judul }}"
                                 class="w-full h-16 object-cover rounded-sm">
                        @endif
                        <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">
                            {{ ucfirst($item->jenis_konten ?? $item->jenis) }}
                        </div>
                        <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                             style="font-family:'Playfair Display',serif;">
                            {{ Str::limit($item->judul, 30) }}
                        </div>
                    </a>
                @endforeach
            @endif

            @if($headlineAgenda)
                <a href="{{ route('public.agenda.show', $headlineAgenda) }}" class="group block">
                    @if($headlineAgenda->gambar_poster)
                        <img src="{{ storage_url($headlineAgenda->gambar_poster) }}"
                             class="w-full h-16 object-cover rounded-sm">
                    @endif
                    <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">Agenda</div>
                    <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                         style="font-family:'Playfair Display',serif;">
                        {{ Str::limit($headlineAgenda->nama_agenda, 30) }}
                    </div>
                </a>
            @endif

            @if($respondedAspirasi)
                <a href="{{ route('public.aspirasi.show', $respondedAspirasi) }}" class="group block">
                    <div class="w-full h-16 bg-gray-100 rounded-sm flex items-center justify-center">
                        <span class="text-[9px] text-gray-400 uppercase tracking-widest">Aspirasi</span>
                    </div>
                    <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">Aspirasi</div>
                    <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                         style="font-family:'Playfair Display',serif;">
                        {{ Str::limit($respondedAspirasi->topik_aspirasi, 30) }}
                    </div>
                </a>
            @endif

            @php $thirdProfil = $profilOrmadas->skip(2)->first(); @endphp
            @if($thirdProfil)
                <a href="{{ route('public.ormada.show', $thirdProfil) }}" class="group block">
                    @if($thirdProfil->logo)
                        <img src="{{ profil_logo_url($thirdProfil->logo) }}"
                             class="w-full h-16 object-cover rounded-sm">
                    @else
                        <div class="w-full h-16 bg-gray-100 rounded-sm flex items-center justify-center">
                            <span class="text-sm font-black">{{ strtoupper(substr($thirdProfil->nama_universitas, 0, 2)) }}</span>
                        </div>
                    @endif
                    <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">Ormada</div>
                    <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                         style="font-family:'Playfair Display',serif;">
                        {{ Str::limit($thirdProfil->nama_universitas, 30) }}
                    </div>
                </a>
            @endif

            @if($gridNews->count() > 1)
                @foreach($gridNews->skip(1)->take(1) as $item)
                    <a href="{{ route('public.postingan.show', $item) }}" class="group block">
                        @if($item->foto)
                            <img src="{{ storage_url($item->foto) }}" alt="{{ $item->judul }}"
                                 class="w-full h-16 object-cover rounded-sm">
                        @endif
                        <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">
                            {{ ucfirst($item->jenis_konten ?? $item->jenis) }}
                        </div>
                        <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                             style="font-family:'Playfair Display',serif;">
                            {{ Str::limit($item->judul, 30) }}
                        </div>
                    </a>
                @endforeach
            @endif

        </div>
    </div>
</section>

@endsection