@extends('layouts.public')
@section('title', 'Berita & Pengumuman - SI Ormada Temanggung')
@section('content')
            <!-- Page Header -->
            <section class="hero-gradient text-white py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">Berita & Pengumuman</h2>
                        <p class="mt-4 text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto">Informasi terbaru dari ormada dan Pemda Temanggung.</p>
                    </div>
                </div>
            </section>

            <!-- Postingan List -->
            <section class="bg-gray-50 py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($postingans as $postingan)
                        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            @if($postingan->foto)
                            <img src="{{ asset('storage/' . $postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full border border-blue-200">
                                        {{ ucfirst($postingan->jenis_konten) }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-base leading-6 text-gray-900 mb-2">{{ $postingan->judul }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                                    {{ Str::limit($postingan->isi_konten, 120) }}
                                </p>
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="bg-blue-100 rounded-full p-1">
                                            <svg class="w-4 h-4 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs text-gray-600">{{ $postingan->admin->nama }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $postingan->tanggal_publish->diffForHumans() }}</span>
                                </div>
                            </div>
                        </article>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v1m-4 9v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500">Belum ada postingan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endsection
