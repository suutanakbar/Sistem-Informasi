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
        </main>

        <footer class="border-t border-zinc-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-6 text-sm text-zinc-500 sm:px-6 lg:px-8">
                Sistem Informasi Ormada dan Sinergi Pemda Temanggung
            </div>
        </footer>
    </div>
</body>
</html>
