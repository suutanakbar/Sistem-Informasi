@extends('layouts.public')
@section('title', 'Beranda - SI Ormada Temanggung')
@section('content')
            <!-- Hero Section -->
            <section class="hero-gradient text-white py-16 sm:py-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto">
                        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight">Sistem Informasi Ormada</h2>
                        <p class="mt-4 text-xl sm:text-2xl text-blue-100">Temanggung Lintas Kampus</p>
                        <p class="mt-6 text-base sm:text-lg text-blue-100 max-w-2xl mx-auto">Pusat informasi ormada dan mahasiswa daerah. Lihat ringkasan ormada terdaftar, jumlah anggota terdata, dan persebaran profil organisasi mahasiswa Temanggung.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="mt-12 grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Ormada Terdaftar</p>
                                    <p class="mt-2 text-3xl sm:text-4xl font-bold">{{ number_format($totalOrmada) }}</p>
                                </div>
                                <div class="bg-white/20 rounded-lg p-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 14.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Anggota Terdata</p>
                                    <p class="mt-2 text-3xl sm:text-4xl font-bold">{{ number_format($totalAnggota) }}</p>
                                </div>
                                <div class="bg-white/20 rounded-lg p-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Pengurus Aktif</p>
                                    <p class="mt-2 text-3xl sm:text-4xl font-bold">{{ number_format($totalPengurus) }}</p>
                                </div>
                                <div class="bg-white/20 rounded-lg p-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Alumni Terdata</p>
                                    <p class="mt-2 text-3xl sm:text-4xl font-bold">{{ number_format($totalAlumni) }}</p>
                                </div>
                                <div class="bg-white/20 rounded-lg p-3">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="profil" class="bg-white py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Profil Ormada</h2>
                        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Ringkasan organisasi berdasarkan universitas. Data anggota ditampilkan sebagai jumlah agregat saja.</p>
                    </div>

                    @if ($profilOrmadas->isNotEmpty())
                        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                            @foreach ($profilOrmadas as $profil)
                                <article class="content-card bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                                    <div class="flex items-start gap-4">
                                        @if ($profil->logo)
                                            <img src="{{ asset('storage/'.$profil->logo) }}" alt="Logo {{ $profil->nama_universitas }}" class="h-16 w-16 rounded-lg object-cover shadow-sm">
                                        @else
                                            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-lg bg-blue-700 text-lg font-bold text-white shadow-sm">
                                                {{ strtoupper(substr($profil->nama_universitas, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <h3 class="font-bold text-base leading-6 text-gray-900">{{ $profil->nama_universitas }}</h3>
                                            <p class="mt-1 text-xs text-gray-500 line-clamp-2">{{ $profil->alamat_universitas }}</p>
                                        </div>
                                    </div>

                                    <p class="mt-4 text-sm text-gray-600 line-clamp-3">{{ $profil->deskripsi ?: 'Belum ada deskripsi profil.' }}</p>

                                    <div class="mt-5 grid grid-cols-2 gap-3">
                                        <div class="rounded-lg bg-blue-50 p-3 border border-blue-100">
                                            <p class="text-xs text-blue-700 font-medium">Mahasiswa Univ.</p>
                                            <p class="mt-1 text-xl font-bold text-blue-900">{{ number_format($profil->total_mahasiswa_univ) }}</p>
                                        </div>
                                        <div class="rounded-lg bg-blue-50 p-3 border border-blue-100">
                                            <p class="text-xs text-blue-700 font-medium">Anggota</p>
                                            <p class="mt-1 text-xl font-bold text-blue-900">{{ number_format($profil->anggota_count) }}</p>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-8 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500">Belum ada profil ormada yang terdaftar.</p>
                        </div>
                    @endif
                </div>
            </section>

            @if($aspirasis->isNotEmpty())
            <section id="aspirasi" class="bg-gray-50 py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <!-- Header with Title and Filter Tabs -->
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Pengumuman dan Artikel</h2>
                        
                        <div class="flex items-center gap-2">
                            <button class="px-4 py-2 text-sm font-medium rounded-lg border-2 border-blue-700 bg-blue-700 text-white">
                                Pengumuman
                            </button>
                            <button class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                                Artikel
                            </button>
                            <a href="{{ route('public.aspirasi') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition ml-2">
                                Lihat Semuanya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Aspirasi Cards Grid -->
                    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($aspirasis as $aspirasi)
                        <article class="content-card bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                            <div class="flex items-start justify-between mb-3">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Pengumuman</span>
                                <span class="text-xs text-gray-400">{{ $aspirasi->dibuat_pada->format('d M Y') }}</span>
                            </div>
                            <h3 class="font-bold text-base leading-tight text-gray-900 mb-2">
                                {{ $aspirasi->topik_aspirasi }}
                            </h3>
                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                {{ Str::limit($aspirasi->detail_aspirasi, 100) }}
                            </p>
                        </article>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            @if($postingans->isNotEmpty())
            <section id="berita" class="bg-white py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <!-- Header with Title and Filter Tabs -->
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Berita Terbaru</h2>
                        
                        <div class="flex items-center gap-2">
                            <button onclick="filterPostingan('')" class="filter-btn active px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50 transition" data-filter="">
                                Utama
                            </button>
                            <button onclick="filterPostingan('kegiatan')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50 transition" data-filter="kegiatan">
                                Kegiatan
                            </button>
                            <button onclick="filterPostingan('daerah')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50 transition" data-filter="daerah">
                                Daerah
                            </button>
                            <a href="{{ route('public.postingan') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition ml-2">
                                Lihat Semua
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- News Grid Layout -->
                    <div class="mt-10 grid gap-6 lg:grid-cols-2">
                        <!-- Hero Card (Left - First Post) -->
                        @if($postingans->isNotEmpty())
                        @php $heroPost = $postingans->first(); @endphp
                        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                            @if($heroPost->foto)
                            <div class="w-full h-64 sm:h-80 overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/'.$heroPost->foto) }}" alt="{{ $heroPost->judul }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                            </div>
                            @endif
                            <div class="p-6">
                                <div class="text-xs text-gray-400 mb-2">
                                    {{ $heroPost->tanggal_publish->format('d M Y') }}
                                </div>
                                <h3 class="font-bold text-xl sm:text-2xl leading-tight text-gray-900 mb-3">
                                    <a href="{{ route('public.postingan.show', $heroPost) }}" class="hover:text-blue-700 transition">
                                        {{ $heroPost->judul }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                                    {{ Str::limit($heroPost->isi_konten, 150) }}
                                </p>
                                <a href="{{ route('public.postingan.show', $heroPost) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                                    Baca selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                        @endif

                        <!-- Right Side - Smaller Cards (Max 2) -->
                        <div class="flex flex-col gap-6">
                            @foreach($postingans->skip(1)->take(2) as $postingan)
                            <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex">
                                @if($postingan->foto)
                                <div class="flex-shrink-0 w-32 sm:w-40">
                                    <img src="{{ asset('storage/'.$postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-full object-cover">
                                </div>
                                @endif
                                <div class="p-5 flex flex-col flex-1">
                                    <div class="text-xs text-gray-400 mb-1">
                                        {{ $postingan->tanggal_publish->format('d M Y') }}
                                    </div>
                                    <h3 class="font-bold text-base leading-tight text-gray-900 mb-2 flex-1">
                                        <a href="{{ route('public.postingan.show', $postingan) }}" class="hover:text-blue-700 transition">
                                            {{ $postingan->judul }}
                                        </a>
                                    </h3>
                                    <a href="{{ route('public.postingan.show', $postingan) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition mt-auto">
                                        Baca selengkapnya
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif

            @if($agendas->isNotEmpty())
            <section id="agenda" class="bg-gray-50 py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between mb-8">
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Agenda Kegiatan</h2>
                            <p class="mt-4 text-lg text-gray-600 max-w-2xl">Jadwal kegiatan yang akan datang. Dapatkan informasi terbaru tentang kegiatan ormada.</p>
                        </div>
                        <a href="{{ route('public.agenda') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition shadow-sm">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Featured Agenda - Master Detail Layout -->
                    @if($agendas->isNotEmpty())
                    @php $featuredAgenda = $agendas[$agendaIndex] ?? $agendas->first(); @endphp
                    <div class="relative">
                        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                            <div class="grid md:grid-cols-2 gap-0">
                                <!-- Left Side - Visual -->
                                <div class="relative bg-gray-100">
                                    @if($featuredAgenda->gambar_poster)
                                    <img src="{{ asset('storage/'.$featuredAgenda->gambar_poster) }}" alt="{{ $featuredAgenda->nama_agenda }}" class="w-full h-64 md:h-full object-cover">
                                    @else
                                    <div class="w-full h-64 md:h-96 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    @endif
                                    <!-- Search Icon Overlay -->
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-md">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Right Side - Information -->
                                <div class="p-6 md:p-8 flex flex-col">
                                    <!-- Badge and Time -->
                                    <div class="flex items-start justify-between mb-4">
                                        <span class="px-3 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded-full border border-purple-200">
                                            {{ ucfirst(str_replace('_', ' ', $featuredAgenda->kategori)) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $featuredAgenda->waktu_mulai->format('d M Y') }} • {{ $featuredAgenda->waktu_mulai->format('H:i') }} WIB
                                        </span>
                                    </div>

                                    <!-- Title - Main Focus -->
                                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                                        {{ $featuredAgenda->nama_agenda }}
                                    </h3>

                                    <!-- Description -->
                                    <p class="text-sm text-gray-600 leading-relaxed mb-6 flex-1">
                                        {{ Str::limit($featuredAgenda->deskripsi_agenda, 200) }}
                                    </p>

                                    <!-- Info Cards -->
                                    <div class="grid grid-cols-3 gap-3 mb-6">
                                        <!-- Waktu -->
                                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                            <div class="flex items-center gap-2 mb-1">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-xs text-gray-500">Waktu</span>
                                            </div>
                                            <p class="text-xs font-semibold text-gray-900">
                                                {{ $featuredAgenda->waktu_mulai->format('H:i') }}
                                            </p>
                                        </div>

                                        <!-- Tempat -->
                                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                            <div class="flex items-center gap-2 mb-1">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                <span class="text-xs text-gray-500">Tempat</span>
                                            </div>
                                            <p class="text-xs font-semibold text-gray-900 line-clamp-2">
                                                {{ Str::limit($featuredAgenda->tempat, 15) }}
                                            </p>
                                        </div>

                                        <!-- Kuota -->
                                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                            <div class="flex items-center gap-2 mb-1">
                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                                <span class="text-xs text-gray-500">Kuota</span>
                                            </div>
                                            <p class="text-xs font-semibold text-gray-900">
                                                {{ $featuredAgenda->kuota_volunteer ?? '∞' }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Deadline Info Box -->
                                    @if($featuredAgenda->deadline_pendaftaran)
                                    <div class="bg-blue-50 rounded-lg p-4 mb-4 border border-blue-200">
                                        <p class="text-xs text-blue-800">
                                            <span class="font-semibold">Deadline Pendaftaran:</span><br>
                                            {{ $featuredAgenda->deadline_pendaftaran->format('d M Y H:i') }} WIB
                                        </p>
                                    </div>
                                    @endif

                                    <!-- Action Link -->
                                    <a href="{{ route('public.agenda.show', $featuredAgenda) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Carousel Navigation -->
                        @if($agendas->count() > 1)
                        <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-50 text-gray-800 p-3 rounded-full shadow-lg border border-gray-200 transition z-20 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white hover:bg-gray-50 text-gray-800 p-3 rounded-full shadow-lg border border-gray-200 transition z-20 cursor-pointer">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        @endif
                    </div>

                    <!-- Dots Indicator -->
                    @if($agendas->count() > 1)
                    <div class="flex justify-center gap-2 mt-6">
                        @foreach($agendas as $index => $agenda)
                        <button class="carousel-dot w-2 h-2 rounded-full bg-gray-300 hover:bg-gray-400 transition" data-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                    @endif
                    @endif
                </div>
            </section>
            @endif
@endsection

@push('scripts')
<script>
function filterPostingan(jenis) {
    // Update active button state
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-blue-700', 'text-white', 'border-blue-700');
        btn.classList.add('border-gray-200', 'hover:bg-gray-50');
    });
    
    const activeBtn = document.querySelector(`[data-filter="${jenis}"]`);
    if (activeBtn) {
        activeBtn.classList.add('active', 'bg-blue-700', 'text-white', 'border-blue-700');
        activeBtn.classList.remove('border-gray-200', 'hover:bg-gray-50');
    }

    // Show loading state
    const newsGrid = document.querySelector('#berita .grid');
    newsGrid.innerHTML = '<div class="col-span-2 text-center py-12"><div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-700"></div></div>';

    // Fetch filtered data
    fetch(`{{ route('public.postingan.filter') }}?jenis=${jenis}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                renderNewsCards(data.data);
            } else {
                newsGrid.innerHTML = '<div class="col-span-2 text-center py-12 text-gray-500">Tidak ada berita untuk kategori ini.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            newsGrid.innerHTML = '<div class="col-span-2 text-center py-12 text-red-500">Terjadi kesalahan saat memuat data.</div>';
        });
}

function renderNewsCards(postingans) {
    const newsGrid = document.querySelector('#berita .grid');
    
    if (postingans.length === 0) {
        newsGrid.innerHTML = '<div class="col-span-2 text-center py-12 text-gray-500">Tidak ada berita untuk kategori ini.</div>';
        return;
    }

    let html = '';
    
    // Hero Card (First post)
    const heroPost = postingans[0];
    html += `
        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
            ${heroPost.foto ? `
            <div class="w-full h-64 sm:h-80 overflow-hidden bg-gray-100">
                <img src="/storage/${heroPost.foto}" alt="${heroPost.judul}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
            </div>
            ` : ''}
            <div class="p-6">
                <div class="text-xs text-gray-400 mb-2">
                    ${new Date(heroPost.tanggal_publish).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}
                </div>
                <h3 class="font-bold text-xl sm:text-2xl leading-tight text-gray-900 mb-3">
                    <a href="/publik/postingan/${heroPost.id}" class="hover:text-blue-700 transition">
                        ${heroPost.judul}
                    </a>
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                    ${heroPost.isi_konten.substring(0, 150)}${heroPost.isi_konten.length > 150 ? '...' : ''}
                </p>
                <a href="/publik/postingan/${heroPost.id}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                    Baca selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </article>
    `;

    // Right side cards (max 2)
    html += '<div class="flex flex-col gap-6">';
    const maxRightCards = Math.min(postingans.length - 1, 2);
    for (let i = 0; i < maxRightCards; i++) {
        const postingan = postingans[i + 1];
        html += `
            <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex">
                ${postingan.foto ? `
                <div class="flex-shrink-0 w-32 sm:w-40">
                    <img src="/storage/${postingan.foto}" alt="${postingan.judul}" class="w-full h-full object-cover">
                </div>
                ` : ''}
                <div class="p-5 flex flex-col flex-1">
                    <div class="text-xs text-gray-400 mb-1">
                        ${new Date(postingan.tanggal_publish).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}
                    </div>
                    <h3 class="font-bold text-base leading-tight text-gray-900 mb-2 flex-1">
                        <a href="/publik/postingan/${postingan.id}" class="hover:text-blue-700 transition">
                            ${postingan.judul}
                        </a>
                    </h3>
                    <a href="/publik/postingan/${postingan.id}" class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition mt-auto">
                        Baca selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
        `;
    }
    html += '</div>';

    newsGrid.innerHTML = html;
}

// Set initial active state
document.addEventListener('DOMContentLoaded', function() {
    const defaultBtn = document.querySelector('[data-filter=""]');
    if (defaultBtn) {
        defaultBtn.classList.add('bg-blue-700', 'text-white', 'border-blue-700');
        defaultBtn.classList.remove('border-gray-200', 'hover:bg-gray-50');
    }
});

// Agenda Carousel Functionality
let currentSlide = 0;
const totalSlides = {{ $agendas->count() }};

function updateCarousel() {
    // Update dots
    document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
        if (index === currentSlide) {
            dot.classList.remove('bg-gray-300');
            dot.classList.add('bg-blue-700');
        } else {
            dot.classList.remove('bg-blue-700');
            dot.classList.add('bg-gray-300');
        }
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    loadAgendaSlide(currentSlide);
    updateCarousel();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    loadAgendaSlide(currentSlide);
    updateCarousel();
}

function loadAgendaSlide(index) {
    // This will be handled by the server-side rendering
    // For now, we'll use a simple approach - reload the page with a parameter
    // Or better, we can use AJAX to fetch the agenda data
    
    // For simplicity, let's use URL parameter approach
    const url = new URL(window.location.href);
    url.searchParams.set('agenda_index', index);
    window.location.href = url.toString();
}

// Navigation button event listeners
document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }
    
    // Dot navigation
    document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            loadAgendaSlide(currentSlide);
            updateCarousel();
        });
    });
    
    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    const agendaSection = document.getElementById('agenda');
    
    if (agendaSection) {
        agendaSection.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        agendaSection.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
    
    // Initialize first dot as active
    if (totalSlides > 0) {
        updateCarousel();
    }
});
</script>
@endpush
