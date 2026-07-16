@extends('layouts.public')
@section('title', $profilOrmada->nama_universitas . ' - SI Ormada Temanggung')
@section('content')
    <!-- Page Header -->
    <section class="hero-gradient text-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.home') }}" class="inline-flex items-center text-sm text-blue-100 hover:text-white mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Beranda
            </a>
            <div class="max-w-4xl">
                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-xs font-semibold bg-white/20 text-white rounded-full border border-white/30">
                        Profil Ormada
                    </span>
                </div>
                <div class="flex items-start gap-6">
                    @if($profilOrmada->logo)
                    <img src="{{ profil_logo_url($profilOrmada->logo) }}" alt="Logo {{ $profilOrmada->nama_universitas }}" class="h-20 w-20 sm:h-24 sm:w-24 rounded-xl object-cover shadow-lg border-2 border-white/30">
                    @else
                    <div class="flex h-20 w-20 sm:h-24 sm:w-24 shrink-0 items-center justify-center rounded-xl bg-white/20 text-2xl sm:text-3xl font-bold text-white shadow-lg border-2 border-white/30">
                        {{ strtoupper(substr($profilOrmada->nama_universitas, 0, 2)) }}
                    </div>
                    @endif
                    <div class="flex-1">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-3">{{ $profilOrmada->nama_universitas }}</h2>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-blue-100">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $profilOrmada->alamat_universitas }}
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                {{ number_format($profilOrmada->total_mahasiswa_univ) }} Mahasiswa
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Cards -->
    <section class="bg-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <div class="stat-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-700 text-sm font-medium">Total Anggota</p>
                            <p class="mt-2 text-3xl sm:text-4xl font-bold text-blue-900">{{ number_format($profilOrmada->anggota_count) }}</p>
                        </div>
                        <div class="bg-blue-700 rounded-lg p-3">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-700 text-sm font-medium">Pengurus Aktif</p>
                            <p class="mt-2 text-3xl sm:text-4xl font-bold text-green-900">{{ number_format($profilOrmada->pengurus_count) }}</p>
                        </div>
                        <div class="bg-green-700 rounded-lg p-3">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 border border-indigo-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-indigo-700 text-sm font-medium">Mahasiswa</p>
                            <p class="mt-2 text-3xl sm:text-4xl font-bold text-indigo-900">{{ number_format($profilOrmada->anggota_count - $profilOrmada->pengurus_count) }}</p>
                        </div>
                        <div class="bg-indigo-700 rounded-lg p-3">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Deskripsi -->
    <section class="bg-gray-50 py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6 sm:p-8 shadow-sm">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Tentang Ormada</h3>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $profilOrmada->deskripsi ?: 'Belum ada deskripsi profil untuk ormada ini.' }}</p>
            </div>
        </div>
    </section>

    <!-- Anggota Terbaru -->
    <section class="bg-white py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h3 class="text-3xl sm:text-4xl font-bold text-gray-900">Anggota Terbaru</h3>
                <p class="mt-4 text-lg text-gray-600">Daftar anggota yang baru bergabung</p>
            </div>

            @if($anggotaTerbaru->isNotEmpty())
            <div class="mt-8 overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Program Studi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($anggotaTerbaru as $anggota)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-700 text-sm font-bold text-white">
                                        {{ strtoupper(substr($anggota->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $anggota->nama_lengkap }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $anggota->program_studi ?: '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusLabel = $anggota->status_aktif_label;
                                    $statusColor = 'bg-blue-100 text-blue-800 border-blue-200';

                                    if (str_contains($statusLabel, 'Fungsionaris')) {
                                        $statusColor = 'bg-purple-100 text-purple-800 border-purple-200';
                                    } elseif (str_starts_with($statusLabel, 'Lulus')) {
                                        $statusColor = 'bg-green-100 text-green-800 border-green-200';
                                    }
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusColor }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="mt-8 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <p class="mt-4 text-sm text-gray-500">Belum ada anggota yang terdaftar.</p>
            </div>
            @endif
        </div>
    </section>
@endsection