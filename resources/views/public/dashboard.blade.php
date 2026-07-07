<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SI Ormada') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-zinc-50 text-zinc-950">
    <div class="min-h-screen">
        <header class="border-b border-zinc-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <a href="{{ route('public.home') }}" class="text-lg font-semibold">SI Ormada Temanggung</a>
                <nav class="flex items-center gap-2 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Login</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main>
            <section class="border-b border-zinc-200 bg-white">
                <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[1.15fr_0.85fr] lg:px-8">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wide text-zinc-500">Temanggung lintas kampus</p>
                        <h1 class="mt-3 max-w-3xl text-3xl font-semibold tracking-normal text-zinc-950 sm:text-5xl">Pusat informasi ormada dan mahasiswa daerah.</h1>
                        <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">Lihat ringkasan ormada terdaftar, jumlah anggota terdata, dan persebaran profil organisasi mahasiswa Temanggung tanpa membuka data personal anggota.</p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                        <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-5">
                            <p class="text-sm text-zinc-500">Ormada terdaftar</p>
                            <p class="mt-2 text-3xl font-semibold">{{ number_format($totalOrmada) }}</p>
                        </div>
                        <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-5">
                            <p class="text-sm text-zinc-500">Anggota terdata</p>
                            <p class="mt-2 text-3xl font-semibold">{{ number_format($totalAnggota) }}</p>
                        </div>
                        <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-5">
                            <p class="text-sm text-zinc-500">Pengurus aktif</p>
                            <p class="mt-2 text-3xl font-semibold">{{ number_format($totalPengurus) }}</p>
                        </div>
                        <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-5">
                            <p class="text-sm text-zinc-500">Alumni terdata</p>
                            <p class="mt-2 text-3xl font-semibold">{{ number_format($totalAlumni) }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold">Profil Ormada</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600">Ringkasan organisasi berdasarkan universitas. Data anggota ditampilkan sebagai jumlah agregat saja.</p>
                    </div>
                </div>

                @if ($profilOrmadas->isNotEmpty())
                    <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                        @foreach ($profilOrmadas as $profil)
                            <article class="rounded-lg border border-zinc-200 bg-white p-5">
                                <div class="flex items-start gap-4">
                                    @if ($profil->logo)
                                        <img src="{{ asset('storage/'.$profil->logo) }}" alt="Logo {{ $profil->nama_universitas }}" class="h-14 w-14 rounded-lg object-cover">
                                    @else
                                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-lg bg-zinc-900 text-sm font-semibold text-white">
                                            {{ strtoupper(substr($profil->nama_universitas, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <h3 class="font-semibold leading-6">{{ $profil->nama_universitas }}</h3>
                                        <p class="mt-1 text-sm leading-5 text-zinc-500">{{ $profil->alamat_universitas }}</p>
                                    </div>
                                </div>

                                <p class="mt-4 line-clamp-3 text-sm leading-6 text-zinc-600">{{ $profil->deskripsi ?: 'Belum ada deskripsi profil.' }}</p>

                                <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                                    <div class="rounded-md bg-zinc-50 p-3">
                                        <p class="text-zinc-500">Mahasiswa univ.</p>
                                        <p class="mt-1 font-semibold">{{ number_format($profil->total_mahasiswa_univ) }}</p>
                                    </div>
                                    <div class="rounded-md bg-zinc-50 p-3">
                                        <p class="text-zinc-500">Anggota</p>
                                        <p class="mt-1 font-semibold">{{ number_format($profil->anggota_count) }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="mt-6 rounded-lg border border-dashed border-zinc-300 bg-white p-8 text-center text-sm text-zinc-500">
                        Belum ada profil ormada yang terdaftar.
                    </div>
                @endif
            </section>

            @if($aspirasis->isNotEmpty())
            <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold">Aspirasi Ormada</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600">Ruang aspirasi mahasiswa daerah untuk menyampaikan suara mereka kepada Pemda Temanggung.</p>
                    </div>
                    <a href="{{ route('public.aspirasi') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Lihat Semua →
                    </a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($aspirasis as $aspirasi)
                    <article class="rounded-lg border border-zinc-200 bg-white p-5 hover:shadow-md transition-shadow">
                        <div class="flex items-start gap-3">
                            @if($aspirasi->profilOrmada->logo)
                            <img src="{{ asset('storage/'.$aspirasi->profilOrmada->logo) }}" 
                                 alt="{{ $aspirasi->profilOrmada->nama_universitas }}" 
                                 class="h-10 w-10 rounded-full object-cover flex-shrink-0">
                            @else
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-zinc-900 text-xs font-semibold text-white">
                                {{ strtoupper(substr($aspirasi->profilOrmada->nama_universitas, 0, 2)) }}
                            </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-sm leading-6 truncate">{{ $aspirasi->topik_aspirasi }}</h3>
                                <p class="mt-1 text-xs text-zinc-500">{{ $aspirasi->profilOrmada->nama_universitas }}</p>
                                <div class="mt-2">
                                    @if(!$aspirasi->tanggapan_pemda)
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                                        Menunggu
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        Ditanggapi
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-zinc-600 line-clamp-2">
                            {{ Str::limit($aspirasi->detail_aspirasi, 100) }}
                        </p>
                        @if($aspirasi->tanggapan_pemda)
                        <div class="mt-3 bg-blue-50 border-l-4 border-blue-400 p-2">
                            <p class="text-xs text-gray-700">
                                <strong>Tanggapan:</strong> {{ Str::limit($aspirasi->tanggapan_pemda, 80) }}
                            </p>
                        </div>
                        @endif
                        <p class="mt-2 text-xs text-zinc-400">
                            {{ $aspirasi->dibuat_pada->diffForHumans() }}
                        </p>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif

            @if($postingans->isNotEmpty())
            <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold">Berita & Pengumuman</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600">Informasi terbaru dari ormada dan Pemda Temanggung.</p>
                    </div>
                    <a href="{{ route('public.postingan') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Lihat Semua →
                    </a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($postingans as $postingan)
                    <article class="rounded-lg border border-zinc-200 bg-white overflow-hidden hover:shadow-md transition-shadow">
                        @if($postingan->foto)
                        <img src="{{ asset('storage/'.$postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ ucfirst($postingan->jenis_konten) }}
                                </span>
                            </div>
                            <h3 class="font-semibold text-sm leading-6">{{ $postingan->judul }}</h3>
                            <p class="mt-2 text-sm text-zinc-600 line-clamp-2">
                                {{ Str::limit($postingan->isi_konten, 100) }}
                            </p>
                            <p class="mt-3 text-xs text-zinc-400">
                                {{ $postingan->tanggal_publish->diffForHumans() }}
                            </p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif

            @if($agendas->isNotEmpty())
            <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold">Agenda Kegiatan</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600">Jadwal kegiatan yang akan datang.</p>
                    </div>
                    <a href="{{ route('public.agenda') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Lihat Semua →
                    </a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($agendas as $agenda)
                    <article class="rounded-lg border border-zinc-200 bg-white p-5 hover:shadow-md transition-shadow">
                        @if($agenda->gambar_poster)
                        <img src="{{ asset('storage/'.$agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-40 object-cover rounded-lg mb-3">
                        @endif
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                                {{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}
                            </span>
                            @if($agenda->kuota_volunteer)
                            <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                                Volunteer
                            </span>
                            @endif
                        </div>
                        <a href="{{ route('public.agenda.show', $agenda) }}" class="block hover:text-blue-600">
                            <h3 class="font-semibold text-sm leading-6">{{ $agenda->nama_agenda }}</h3>
                        </a>
                        <p class="mt-2 text-sm text-zinc-600 line-clamp-2">
                            {{ Str::limit($agenda->deskripsi_agenda, 100) }}
                        </p>
                        <div class="mt-3 flex items-center text-xs text-zinc-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $agenda->tempat }}
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('public.agenda.show', $agenda) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif
        </main>

        <footer class="border-t border-zinc-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-6 text-sm text-zinc-500 sm:px-6 lg:px-8">
                Sistem Informasi Ormada dan Sinergi Pemda Temanggung
            </div>
        </footer>
    </div>
</body>
</html>
