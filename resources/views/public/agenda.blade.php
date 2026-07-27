@extends('layouts.public')
@section('title', 'Agenda Kegiatan - SI Ormada Temanggung')
@section('content')
    <section>
        <div class="max-w-7xl mx-auto px-4">
            <div class="border-t border-b border-gray-300 py-3 mb-6">
                <h2 class="px-4 text-3xl font-black uppercase tracking-wide text-center"
                    style="font-family:'Playfair Display',serif;">
                    Agenda Kegiatan
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($agendas as $agenda)
                <article class="bg-white border border-gray-300 p-6">
                    <div class="uppercase tracking-[3px] text-[11px] font-bold text-gray-500 mb-3">
                        {{ $agenda->waktu_mulai->format('d M Y') }}
                    </div>
                    <h3 class="text-xl font-black leading-tight mb-3"
                        style="font-family:'Playfair Display',serif;">
                        <a href="{{ route('public.agenda.show', $agenda) }}" class="hover:text-blue-700 transition">
                            {{ $agenda->nama_agenda }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 leading-6 mb-4">
                        {{ \Illuminate\Support\Str::limit(strip_tags($agenda->deskripsi_agenda), 160) }}
                    </p>
                    <a href="{{ route('public.agenda.show', $agenda) }}" class="inline-block text-[11px] font-bold uppercase tracking-widest text-blue-700 hover:text-blue-800 transition">
                        Lihat Detail →
                    </a>
                </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection