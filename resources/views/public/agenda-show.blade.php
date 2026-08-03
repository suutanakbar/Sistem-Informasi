@extends('layouts.public')
@section('title', $agenda->nama_agenda . ' - SI Ormada Temanggung')
@section('content')
    <!-- Page Header -->
    <section class="bg-white border-t border-b border-gray-300 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="{{ route('public.agenda') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700 mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Agenda Kegiatan
            </a>
            <div class="max-w-4xl">
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                        {{ str_replace('_', ' ', $agenda->kategori) }}
                    </span>
                    @if($agenda->kuota_volunteer)
                    <span class="px-2 py-1 text-[10px] font-medium bg-green-100 text-green-800 rounded-full">Volunteer</span>
                    @endif
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight mb-3" style="font-family:'Playfair Display',serif;">{{ $agenda->nama_agenda }}</h2>
                <div class="flex flex-wrap items-center gap-3 text-[10px] text-gray-500 uppercase tracking-widest">
                    <span>Oleh: {{ $agenda->admin->nama }}</span>
                    <span class="font-bold">•</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $agenda->dibuat_pada->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agenda Detail -->
    <section class="bg-white py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="border border-gray-200 rounded-sm overflow-hidden hover:shadow-md transition-shadow">
                @if($agenda->gambar_poster)
                <div class="w-full p-4 bg-gray-100 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-auto object-contain object-center">
                </div>
                @endif
                
                <div class="p-4 sm:p-6">
                    <!-- Description -->
                    <div class="text-gray-700 whitespace-pre-line mb-8 text-base leading-relaxed">
                        {{ $agenda->deskripsi_agenda }}
                    </div>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pb-8 border-b border-gray-200">
                        <div class="flex items-start gap-3">
                            <div class="text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Waktu Mulai</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $agenda->waktu_mulai->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Waktu Selesai</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $agenda->waktu_selesai->format('d F Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 md:col-span-2">
                            <div class="text-blue-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-900 uppercase tracking-wider">Tempat</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $agenda->tempat }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Volunteer Registration -->
                    @if($agenda->kuota_volunteer)
                    <div class="bg-blue-50 border border-blue-200 rounded-sm p-6 mb-6">
                        <h3 class="text-lg font-bold text-blue-900 mb-4">Pendaftaran Volunteer</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <p class="text-xs text-blue-700 font-medium mb-1">Kuota</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $agenda->kuota_volunteer }}</p>
                                <p class="text-xs text-gray-500">orang</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <p class="text-xs text-blue-700 font-medium mb-1">Terdaftar</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $volunteerDiterima }}</p>
                                <p class="text-xs text-gray-500">orang</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <p class="text-xs text-blue-700 font-medium mb-1">Sisa Kuota</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $agenda->kuota_volunteer - $volunteerDiterima }}</p>
                                <p class="text-xs text-gray-500">orang</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <p class="text-xs text-blue-700 font-medium mb-1">Deadline</p>
                                <p class="text-sm font-bold text-blue-900">{{ $agenda->deadline_pendaftaran->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $agenda->deadline_pendaftaran->format('H:i') }}</p>
                            </div>
                        </div>

                        @if($agenda->deadline_pendaftaran >= now() && $volunteerDiterima < $agenda->kuota_volunteer)
                        <div class="bg-white border border-gray-200 rounded-sm p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Daftar Sebagai Volunteer</h4>
                            
                            @if(session('success'))
                            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-sm">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-sm">
                                {{ session('error') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('agenda.daftar-volunteer', $agenda) }}">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Masukkan nama lengkap Anda">
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                        <input type="email" name="email" id="email" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="contoh@email.com">
                                    </div>

                                    <div>
                                        <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                                        <input type="text" name="no_hp" id="no_hp" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Masukkan nomor HP Anda">
                                    </div>

                                    <div>
                                        <label for="alasan" class="block text-sm font-semibold text-gray-700 mb-2">Alasan Bergabung (Opsional)</label>
                                        <textarea name="alasan" id="alasan" rows="4"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Ceritakan mengapa Anda ingin menjadi volunteer..."></textarea>
                                    </div>

                                    <button type="submit" 
                                        class="w-full bg-blue-700 text-white px-6 py-3 rounded-sm font-semibold hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                        Daftar Volunteer
                                    </button>
                                </div>
                            </form>
                        </div>
                        @elseif($agenda->deadline_pendaftaran < now())
                        <div class="bg-yellow-50 border border-yellow-200 rounded-sm p-4">
                            <p class="text-yellow-800 font-medium">Pendaftaran volunteer sudah ditutup.</p>
                        </div>
                        @elseif($volunteerDiterima >= $agenda->kuota_volunteer)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-sm p-4">
                            <p class="text-yellow-800 font-medium">Kuota volunteer sudah penuh.</p>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
