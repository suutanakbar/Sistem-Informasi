@extends('layouts.public')
@section('title', 'Profil Ormada - SI Ormada Temanggung')
@section('content')
    <section>
        <div class="max-w-7xl mx-auto px-4">
            <div class="border-t border-b border-gray-300 py-3 mb-6">
                <h2 class="px-4 text-3xl font-black uppercase tracking-wide text-center"
                    style="font-family:'Playfair Display',serif;">
                    Profil Ormada
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($profilOrmadas as $profil)
                <article class="bg-white border border-gray-300 p-6">
                    <div class="uppercase tracking-[3px] text-[11px] font-bold text-gray-500 mb-3">
                        ORGANISASI MAHASISWA
                    </div>
                    <h3 class="text-xl font-black leading-tight mb-3"
                        style="font-family:'Playfair Display',serif;">
                        <a href="{{ route('public.ormada.show', $profil) }}" class="hover:text-blue-700 transition">
                            {{ $profil->nama_universitas }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 leading-6 mb-4">
                        Memiliki <strong>{{ number_format($profil->anggota_count) }}</strong> anggota dan <strong>{{ number_format($profil->pengurus_count) }}</strong> pengurus aktif.
                    </p>
                    <a href="{{ route('public.ormada.show', $profil) }}" class="inline-block text-[11px] font-bold uppercase tracking-widest text-blue-700 hover:text-blue-800 transition">
                        Lihat Profil →
                    </a>
                </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $profilOrmadas->links() }}
            </div>
        </div>
    </section>
@endsection