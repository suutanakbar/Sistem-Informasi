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
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Aspirasi Ormada</h2>
                            <p class="mt-4 text-lg text-gray-600 max-w-2xl">Ruang aspirasi mahasiswa daerah untuk menyampaikan suara mereka kepada Pemda Temanggung.</p>
                        </div>
                        <a href="{{ route('public.aspirasi') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition shadow-sm">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($aspirasis as $aspirasi)
                        <article class="content-card bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            <div class="flex items-start gap-4">
                                @if($aspirasi->profilOrmada->logo)
                                <img src="{{ asset('storage/'.$aspirasi->profilOrmada->logo) }}" 
                                     alt="{{ $aspirasi->profilOrmada->nama_universitas }}" 
                                     class="h-12 w-12 rounded-full object-cover flex-shrink-0 shadow-sm">
                                @else
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-700 text-sm font-bold text-white shadow-sm">
                                    {{ strtoupper(substr($aspirasi->profilOrmada->nama_universitas, 0, 2)) }}
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-base leading-6 text-gray-900">{{ $aspirasi->topik_aspirasi }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $aspirasi->profilOrmada->nama_universitas }}</p>
                                    <div class="mt-2">
                                        @if(!$aspirasi->tanggapan_pemda)
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full border border-yellow-200">
                                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                            Menunggu Tanggapan
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold bg-green-100 text-green-800 rounded-full border border-green-200">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                            Sudah Ditanggapi
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-gray-600 leading-relaxed">
                                {{ Str::limit($aspirasi->detail_aspirasi, 120) }}
                            </p>
                            @if($aspirasi->tanggapan_pemda)
                            <div class="mt-4 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                                <p class="text-xs font-semibold text-blue-900 mb-1">Tanggapan Pemda:</p>
                                <p class="text-sm text-gray-700">
                                    {{ Str::limit($aspirasi->tanggapan_pemda, 100) }}
                                </p>
                            </div>
                            @endif
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400">{{ $aspirasi->dibuat_pada->diffForHumans() }}</p>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            @if($postingans->isNotEmpty())
            <section id="berita" class="bg-white py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Berita & Pengumuman</h2>
                            <p class="mt-4 text-lg text-gray-600 max-w-2xl">Informasi terbaru dari ormada dan Pemda Temanggung.</p>
                        </div>
                        <a href="{{ route('public.postingan') }}" class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition shadow-sm">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($postingans as $postingan)
                        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            @if($postingan->foto)
                            <img src="{{ asset('storage/'.$postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full border border-blue-200">
                                        {{ ucfirst($postingan->jenis_konten) }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-base leading-6 text-gray-900 mb-2">{{ $postingan->judul }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    {{ Str::limit($postingan->isi_konten, 120) }}
                                </p>
                                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <p class="text-xs text-gray-400">{{ $postingan->tanggal_publish->diffForHumans() }}</p>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            @if($agendas->isNotEmpty())
            <section id="agenda" class="bg-gray-50 py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
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

                    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($agendas as $agenda)
                        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            @if($agenda->gambar_poster)
                            <img src="{{ asset('storage/'.$agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded-full border border-purple-200">
                                        {{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}
                                    </span>
                                    @if($agenda->kuota_volunteer)
                                    <span class="px-3 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full border border-orange-200">
                                        Volunteer
                                    </span>
                                    @endif
                                </div>
                                <a href="{{ route('public.agenda.show', $agenda) }}" class="block hover:text-blue-700">
                                    <h3 class="font-bold text-base leading-6 text-gray-900 mb-2">{{ $agenda->nama_agenda }}</h3>
                                </a>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    {{ Str::limit($agenda->deskripsi_agenda, 120) }}
                                </p>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-center text-xs text-gray-500 mb-2">
                                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="truncate">{{ $agenda->tempat }}</span>
                                    </div>
                                    <a href="{{ route('public.agenda.show', $agenda) }}" class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-800">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif
@endsection