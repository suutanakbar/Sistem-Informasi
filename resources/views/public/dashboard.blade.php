@extends('layouts.public')
@section('content')

@php
    $headline = $postingans->first();
@endphp


<!-- ====================================== -->
<!-- HERO NEWSPAPER -->
<!-- ====================================== -->

<section class="mt-4">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-4">

            {{-- ================================= --}}
            {{-- KALENDER (utama) --}}
            {{-- ================================= --}}

            <section class="xl:col-span-6">

                <div class="border border-gray-300">

                    <div class="border-b border-gray-300 py-2">

                        <h2 class="text-center text-xl font-black uppercase"
                            style="font-family:'Playfair Display',serif;">

                            Kalender Agenda

                        </h2>

                    </div>

                    <div id="calendar-public" style="height:360px;"></div>

                </div>

            </section>


            {{-- ================================= --}}
            {{-- ASPIRASI --}}
            {{-- ================================= --}}

            <section class="xl:col-span-6">

                <h3 class="text-base font-black uppercase tracking-widest border-b border-gray-300 pb-2 mb-4"
                    style="font-family:'Playfair Display',serif;">

                    Aspirasi

                </h3>

                @if($aspirasis->isNotEmpty())
                <div class="space-y-4">

                    @foreach($aspirasis->take(4) as $aspirasi)

                    <a href="{{ route('public.aspirasi.show',$aspirasi) }}"
                       class="block group pb-3 mb-3 border-b border-gray-200 last:border-b-0 last:pb-0 last:mb-0">

                        <div class="uppercase tracking-[3px] text-[10px] text-gray-500 font-bold">

                            {{ $aspirasi->tanggapan_pemda ? 'DITANGGAPI' : 'MENUNGGU' }}

                        </div>

                        <h4 class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                            {{ $aspirasi->topik_aspirasi }}

                        </h4>

                        <div class="mt-1 text-xs text-gray-500">

                            {{ $aspirasi->profilOrmada->nama_universitas ?? '-' }}

                        </div>

                        <p class="mt-1 text-[11px] leading-5 text-gray-600 line-clamp-3">

                            {{ Str::limit(strip_tags($aspirasi->detail_aspirasi),90) }}

                        </p>

                        <div class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">

                            Lihat Selengkapnya →

                        </div>

                    </a>

                    @endforeach

                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-xs text-gray-500">Belum ada aspirasi.</p>
                </div>
                @endif

            </aside>


            </div>
        </div>
    </div>
</section>

<!-- ====================================== -->
<!-- Aspirasi -->
<!-- ====================================== -->

<section id="tmgnews" class="mt-5">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">

        <!-- Header -->
        <div class="border-b border-gray-300 pb-2 mb-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black uppercase tracking-wide"
                    style="font-family:'Playfair Display',serif;">
                    Berita
                </h2>
                <a href="{{ route('public.postingan') }}"
                   class="text-[11px] font-semibold uppercase tracking-widest hover:text-blue-700 transition">
                    View All →
                </a>
            </div>
        </div>


        <!-- Featured News Section -->
        @if($postingans->isNotEmpty())
        @php $featured = $postingans->first(); @endphp
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
            
            <!-- Featured Article (Left - 50%) -->
            <article class="bg-white border border-gray-200 rounded-sm hover:shadow-md transition-shadow">
                <a href="{{ route('public.postingan.show', $featured) }}" class="block">
                    @if($featured->foto)
                    <div class="w-full p-4 bg-gray-100 flex items-center justify-center">
                        <img src="{{ storage_url($featured->foto) }}" alt="{{ $featured->judul }}" class="w-full h-auto object-contain object-center transition duration-500 group-hover:scale-105">
                    </div>
                    @endif
                    <div class="p-5">
                        <!-- Badges -->
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                                {{ ucfirst($featured->jenis_konten ?? $featured->jenis) }}
                            </span>
                            @if($featured->is_published)
                            <span class="px-2 py-1 text-[10px] font-medium bg-green-100 text-green-800 rounded-full">Published</span>
                            @else
                            <span class="px-2 py-1 text-[10px] font-medium bg-yellow-100 text-yellow-800 rounded-full">Draft</span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl sm:text-2xl font-black leading-tight mb-2 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                            {{ $featured->judul }}
                        </h3>

                        <!-- Summary -->
                        <p class="text-gray-600 leading-5 text-xs sm:text-sm mb-3 line-clamp-3">
                            {{ Str::limit(strip_tags($featured->isi_konten),200) }}
                        </p>

                        <!-- Date -->
                        <div class="flex items-center gap-1 text-[10px] text-gray-500 uppercase tracking-widest">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ ($featured->tanggal_publish ?? $featured->dibuat_pada)->format('d M Y') }}
                        </div>

                        <!-- Footer -->
                        <div class="mt-3 pt-2 border-t border-gray-200">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-700 group-hover:text-blue-800 transition">
                                Baca selengkapnya →
                            </span>
                        </div>
                    </div>
                </a>
            </article>

            <!-- Side Articles (Right - 50% Vertical Stack) -->
            @if($postingans->count() > 1)
            <div class="flex flex-col gap-4">
                @foreach($postingans->skip(1)->take(2) as $postingan)
                <article class="group bg-white border border-gray-200 rounded-sm hover:shadow-md transition-shadow">
                    <a href="{{ route('public.postingan.show', $postingan) }}" class="block">
                        @if($postingan->foto)
                        <div class="w-full p-2 bg-gray-100 flex items-center justify-center">
                            <img src="{{ storage_url($postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-32 object-cover object-center transition duration-500 group-hover:scale-105">
                        </div>
                        @endif
                        <div class="p-3">
                            <!-- Badges -->
                            <div class="flex items-center gap-1 mb-1">
                                <span class="px-1 py-0.5 text-[8px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-wider">
                                    {{ ucfirst($postingan->jenis_konten ?? $postingan->jenis) }}
                                </span>
                                @if($postingan->is_published)
                                <span class="px-1 py-0.5 text-[8px] font-medium bg-green-100 text-green-800 rounded-full">Pub</span>
                                @endif
                            </div>

                            <!-- Title -->
                            <h3 class="text-[11px] sm:text-xs font-black leading-tight mb-1 line-clamp-2 group-hover:text-blue-700 transition flex-1" style="font-family:'Playfair Display',serif;">
                                {{ $postingan->judul }}
                            </h3>

                            <!-- Date -->
                            <div class="flex items-center gap-1 text-[8px] text-gray-500 uppercase tracking-wider">
                                <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2z"></path>
                                </svg>
                                {{ ($postingan->tanggal_publish ?? $postingan->dibuat_pada)->format('d M Y') }}
                            </div>

                            <!-- Footer -->
                            <div class="mt-2 pt-1.5 border-t border-gray-200">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 group-hover:text-blue-800 transition">
                                    Baca selengkapnya →
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
            @endif
        </div>
        @endif

        </div>
    </div>
</section>

<!-- ====================================== -->
<!-- PROFIL ORMADA -->
<!-- ====================================== -->

<section id="profil" class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">

        <!-- Header -->
        <div class="border-b border-gray-300 pb-2 mb-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black uppercase"
                    style="font-family:'Playfair Display',serif;">

                    Profil Ormada

                </h2>
                <a href="{{ route('public.ormada') }}"
                   class="text-[11px] uppercase tracking-widest font-semibold hover:text-blue-700">

                    View All →

                </a>
            </div>
        </div>


        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

            @foreach($profilOrmadas->take(4) as $profil)

            <article class="group border border-gray-200 rounded-sm overflow-hidden">

                    <!-- Logo -->

                    <div class="overflow-hidden border-b border-gray-200">

                        @if($profil->logo)

                            <img
                                src="{{ profil_logo_url($profil->logo) }}"
                                class="w-full h-36 object-cover transition duration-500 group-hover:scale-105">

                        @else

                            <div class="w-full h-36 bg-gray-100 flex items-center justify-center">

                                <span class="text-3xl font-black">

                                    {{ strtoupper(substr($profil->nama_universitas,0,2)) }}

                                </span>

                            </div>

                        @endif

                    </div>


                    <!-- Content -->

                    <div class="p-4">

                        <div class="uppercase text-[11px] tracking-[3px] font-bold text-gray-500">

                            ORGANISASI MAHASISWA

                        </div>

                        <h3
                            class="mt-2 text-base font-black leading-tight group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                            {{ $profil->nama_universitas }}

                        </h3>

                        <p class="mt-1 text-[11px] text-gray-600 leading-5">

                            Memiliki
                            <strong>{{ number_format($profil->anggota_count) }}</strong>
                            anggota dan
                            <strong>{{ number_format($profil->pengurus_count) }}</strong>
                            pengurus aktif.

                        </p>

                        <a href="{{ route('public.ormada.show',$profil) }}"
                           class="inline-block mt-2 uppercase tracking-widest text-[11px] font-bold hover:text-blue-700">

                            Lihat Profil →

                        </a>

                    </div>

                </article>

                @endforeach

            </div>
        </div>

        </div>
    </div>
</section>

<!-- ====================================== -->
<!-- AGENDA -->
<!-- ====================================== -->

<section id="agenda" class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">

        <div class="border-b border-gray-300 pb-2 mb-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black uppercase tracking-wide"
                    style="font-family:'Playfair Display',serif;">

                    Agenda

                </h2>
                <a href="{{ route('public.agenda') }}"
                   class="text-[11px] font-semibold uppercase tracking-widest hover:text-blue-700">

                    View All →

                </a>
            </div>
        </div>

        @php
            $headlineAgenda = $agendas->first();
        @endphp

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-4">

            {{-- ========================= --}}
            {{-- HEADLINE AGENDA --}}
            {{-- ========================= --}}

            <div class="xl:col-span-8">

                @if($headlineAgenda)

                <article class="border border-gray-200 rounded-sm overflow-hidden">

                    @if($headlineAgenda->gambar_poster)

                        <img
                            src="{{ storage_url($headlineAgenda->gambar_poster) }}"
                            class="w-full h-48 object-cover">

                    @endif

                    <div class="p-4">

                        <div
                            class="uppercase tracking-[4px] text-xs font-bold text-gray-500">

                            {{ strtoupper($headlineAgenda->kategori) }}

                        </div>

                        <h2
                            class="mt-2 text-lg leading-tight font-black"
                            style="font-family:'Playfair Display',serif;">

                            {{ $headlineAgenda->nama_agenda }}

                        </h2>

                        <p
                            class="mt-2 text-gray-600 text-xs leading-5">

                            {{ Str::limit(strip_tags($headlineAgenda->deskripsi_agenda),250) }}

                        </p>

                        <div
                            class="mt-3 flex gap-3 text-[11px] text-gray-500 uppercase tracking-widest">

                            <span>

                                📅
                                {{ $headlineAgenda->waktu_mulai->format('d M Y') }}

                            </span>

                            <span>

                                📍
                                {{ $headlineAgenda->tempat }}

                            </span>

                        </div>

                        <a
                            href="{{ route('public.agenda.show',$headlineAgenda) }}"
                            class="inline-block mt-3 text-[11px] font-bold uppercase tracking-widest hover:text-blue-700">

                            Detail Agenda →

                        </a>

                    </div>

                </article>

                @endif

            </div>

            {{-- ========================= --}}
            {{-- LIST AGENDA --}}
            {{-- ========================= --}}

            <div class="xl:col-span-4 space-y-3">

                @foreach($agendas->skip(1)->take(3) as $agenda)

                <article class="group border-b border-gray-300 pb-3">

                    @if($agenda->gambar_poster)

                        <img
                            src="{{ storage_url($agenda->gambar_poster) }}"
                            class="w-full h-20 object-cover mb-2">

                    @endif

                    <div
                        class="uppercase tracking-[3px] text-[10px] font-bold text-gray-500">

                        {{ strtoupper($agenda->kategori) }}

                    </div>

                        <h3
                            class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                        {{ $agenda->nama_agenda }}

                    </h3>

                        <p
                            class="mt-1 text-[11px] text-gray-600 leading-5 line-clamp-2">

                        {{ Str::limit(strip_tags($agenda->deskripsi_agenda),100) }}

                    </p>

                        <div
                            class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">

                        {{ $agenda->waktu_mulai->format('d M Y') }}

                    </div>

                </article>

                @endforeach

            </div>

        </div>

        </div>
    </div>
</section>

<!-- <footer class="mt-5 border-t pt-4 pb-4">
    <div class="text-center">
        <h2 class="text-2xl font-black">
            SI ORMADA TEMANGGUNG
        </h2>
        <p class="mt-2 text-gray-500 text-sm">
            Sistem Informasi Organisasi Mahasiswa Daerah Temanggung Lintas Kampus
        </p>
        <p class="mt-6 text-xs text-gray-400">
            © {{ date('Y') }} SI Ormada Temanggung
        </p>
    </div>
</footer> -->

</main>

@endsection

@push('scripts')
<script>
    window.publicCalendarEvents = @json($calendarEvents ?? []);
</script>

<!-- TEST -->
