@extends('layouts.public')
@section('title', 'Aspirasi Ormada - SI Ormada Temanggung')
@section('content')
    <section class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 pb-16">

            <div class="border-t border-gray-300 pt-8 pb-6 mb-10">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-2">EDISI 005 / 2026</div>
                        <h1 class="text-4xl lg:text-5xl font-black uppercase pb-4 border-b border-gray-300" style="font-family:'Playfair Display',serif;">Aspirasi</h1>
                    </div>
                    <p class="hidden lg:block text-sm text-gray-600 max-w-sm text-right pt-1">
                        Kumpulan aspirasi dan saran dari ormada untuk peningkatan layanan dan fasilitas.
                    </p>
                </div>
            </div>

            @if($aspirasis->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($aspirasis as $aspirasi)
                <article class="bg-white border border-gray-200 p-8 flex flex-col">

                    <!-- Status -->
                    <div class="mb-3">
                        @if($aspirasi->tanggapan_pemda)
                        <span class="text-[10px] font-bold uppercase tracking-wider text-green-700">Sudah Ditanggapi</span>
                        @else
                        <span class="text-[10px] font-bold uppercase tracking-wider text-yellow-700">Menunggu Tanggapan</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-black leading-snug mb-4">
                        {{ $aspirasi->topik_aspirasi }}
                    </h3>

                    <!-- Date & University (meta) -->
                    <div class="text-sm font-bold text-gray-900 mb-1">
                        {{ $aspirasi->dibuat_pada->format('d M Y') }}
                    </div>
                    <div class="text-sm text-gray-500 mb-4">
                        {{ $aspirasi->profilOrmada->nama_universitas ?? 'Unknown' }}
                    </div>

                    <!-- Summary -->
                    <p class="text-sm text-gray-600 leading-6 mb-6 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($aspirasi->detail_aspirasi), 150) }}
                    </p>

                    <!-- Footer -->
                    <div class="mt-auto">
                        <a href="{{ route('public.aspirasi.show', $aspirasi) }}" class="inline-flex items-center px-5 py-2 border border-gray-900 rounded-full text-xs font-bold uppercase tracking-wider text-gray-900 hover:bg-gray-900 hover:text-white transition">
                            Lihat Detail
                        </a>
                    </div>

                </article>
                @endforeach
            </div>
            @endif

        </div>
    </section>
@endsection