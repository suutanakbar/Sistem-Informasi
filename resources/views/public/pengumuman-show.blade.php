@extends('layouts.public')
@section('content')
<section class="mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between border-b-2 border-black pb-3 mb-6">
            <div class="flex-1 border-t border-black"></div>
            <h2 class="px-6 text-3xl font-black uppercase tracking-wide text-center"
                style="font-family:'Playfair Display',serif;">
                Detail Pengumuman
            </h2>
            <div class="flex-1 border-t border-black"></div>
        </div>

        <article class="bg-white border border-gray-300">
            @if($pengumuman->foto)
            <div class="overflow-hidden">
                <img src="{{ asset('storage/' . $pengumuman->foto) }}" alt="{{ $pengumuman->judul }}" class="w-full h-64 object-cover">
            </div>
            @endif
            <div class="p-6">
                <div class="uppercase tracking-[3px] text-[10px] font-bold text-gray-500 mb-2">
                    {{ $pengumuman->tanggal_publish->format('d M Y') }}
                </div>
                <h3 class="text-2xl font-black leading-tight mb-4"
                    style="font-family:'Playfair Display',serif;">
                    {{ $pengumuman->judul }}
                </h3>
                <div class="text-gray-700 leading-7">
                    {!! nl2br(e($pengumuman->isi)) !!}
                </div>
                @if($pengumuman->file)
                <div class="mt-6">
                    <a href="{{ asset('storage/' . $pengumuman->file) }}" target="_blank"
                       class="inline-block px-4 py-2 border border-black font-bold text-xs uppercase tracking-widest hover:bg-black hover:text-white transition">
                        Download Lampiran
                    </a>
                </div>
                @endif
            </div>
        </article>
    </div>
</section>
@endsection