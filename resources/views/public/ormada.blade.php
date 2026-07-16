@extends('layouts.public')
@section('title', 'Profil Ormada - SI Ormada Temanggung')
@section('content')
            <section class="bg-gray-50 py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <!-- Header -->
                    <div class="text-center mb-12">
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Daftar Profil Ormada</h2>
                        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Daftar lengkap organisasi mahasiswa daerah (Ormada) yang terdaftar di sistem.</p>
                    </div>

                    @if ($profilOrmadas->isNotEmpty())
                        <!-- Grid Layout -->
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($profilOrmadas as $profil)
                            <a href="{{ route('public.ormada.show', $profil) }}" class="block bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300">
                                <div class="text-center mb-4">
                                    @if ($profil->logo)
                                        <img src="{{ profil_logo_url($profil->logo) }}" alt="Logo {{ $profil->nama_universitas }}" class="h-20 w-20 mx-auto rounded-xl object-cover shadow-md">
                                    @else
                                        <div class="flex h-20 w-20 mx-auto items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-indigo-700 text-2xl font-bold text-white shadow-md">
                                            {{ strtoupper(substr($profil->nama_universitas, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <h3 class="text-center font-bold text-xl text-gray-900 mb-3">{{ $profil->nama_universitas }}</h3>
                                
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Total Anggota</span>
                                        <span class="font-semibold text-blue-700">{{ number_format($profil->anggota_count) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Pengurus</span>
                                        <span class="font-semibold text-indigo-700">{{ number_format($profil->pengurus_count) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Mahasiswa</span>
                                        <span class="font-semibold text-gray-700">{{ number_format($profil->anggota_count - $profil->pengurus_count) }}</span>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-center justify-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12">
                            {{ $profilOrmadas->links() }}
                        </div>
                    @else
                        <div class="rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500">Belum ada profil ormada yang terdaftar.</p>
                        </div>
                    @endif
                </div>
            </section>
@endsection