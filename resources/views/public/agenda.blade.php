@extends('layouts.public')
@section('title', 'Agenda Kegiatan - SI Ormada Temanggung')
@section('content')
            <!-- Page Header -->
            <section class="hero-gradient text-white py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">Agenda Kegiatan</h2>
                        <p class="mt-4 text-lg sm:text-xl text-blue-100 max-w-2xl mx-auto">Jadwal kegiatan yang akan datang. Dapatkan informasi terbaru tentang kegiatan ormada.</p>
                    </div>
                </div>
            </section>

            <!-- Agenda List -->
            <section class="bg-gray-50 py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($agendas as $agenda)
                        <article class="content-card bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            @if($agenda->gambar_poster)
                            <img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-48 object-cover">
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
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
                                    {{ Str::limit($agenda->deskripsi_agenda, 120) }}
                                </p>
                                <div class="pt-4 border-t border-gray-100 space-y-2">
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $agenda->waktu_mulai->format('d M Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="truncate">{{ $agenda->tempat }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('public.agenda.show', $agenda) }}" class="inline-flex items-center mt-4 text-sm font-semibold text-blue-700 hover:text-blue-800">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500">Belum ada agenda kegiatan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
