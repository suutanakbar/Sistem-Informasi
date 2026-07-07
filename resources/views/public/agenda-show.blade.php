<x-layouts.app title="{{ $agenda->nama_agenda }}">
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('public.agenda') }}" class="text-sm text-blue-600 hover:text-blue-800">
                ← Kembali ke Agenda Kegiatan
            </a>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                @if($agenda->gambar_poster)
                <img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-96 object-cover rounded-lg mb-6">
                @endif

                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-sm font-medium bg-purple-100 text-purple-800 rounded-full">
                        {{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}
                    </span>
                    @if($agenda->kuota_volunteer)
                    <span class="px-3 py-1 text-sm font-medium bg-orange-100 text-orange-800 rounded-full">
                        Volunteer ({{ $volunteerDiterima }}/{{ $agenda->kuota_volunteer }})
                    </span>
                    @endif
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $agenda->nama_agenda }}</h2>

                <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-200">
                    <span>Oleh: {{ $agenda->admin->nama }}</span>
                    <span>•</span>
                    <span>{{ $agenda->dibuat_pada->format('d F Y H:i') }}</span>
                    @if($agenda->tanggal_publish)
                    <span>•</span>
                    <span>Dipublikasi: {{ $agenda->tanggal_publish->format('d F Y H:i') }}</span>
                    @endif
                </div>

                <div class="prose max-w-none text-gray-700 whitespace-pre-line mb-6">
                    {{ $agenda->deskripsi_agenda }}
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="font-medium">Waktu Mulai</p>
                            <p>{{ $agenda->waktu_mulai->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium">Waktu Selesai</p>
                            <p>{{ $agenda->waktu_selesai->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <p class="font-medium">Tempat</p>
                        <p>{{ $agenda->tempat }}</p>
                    </div>
                </div>

                @if($agenda->kuota_volunteer)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Pendaftaran Volunteer</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-blue-700">Kuota</p>
                            <p class="font-semibold">{{ $agenda->kuota_volunteer }} orang</p>
                        </div>
                        <div>
                            <p class="text-blue-700">Terdaftar</p>
                            <p class="font-semibold">{{ $volunteerDiterima }} orang</p>
                        </div>
                        <div>
                            <p class="text-blue-700">Deadline</p>
                            <p class="font-semibold">{{ $agenda->deadline_pendaftaran->format('d F Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-blue-700">Sisa Kuota</p>
                            <p class="font-semibold">{{ $agenda->kuota_volunteer - $volunteerDiterima }} orang</p>
                        </div>
                    </div>
                </div>

                @if($agenda->deadline_pendaftaran >= now() && $volunteerDiterima < $agenda->kuota_volunteer)
                <div class="bg-white border border-gray-200 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Daftar Sebagai Volunteer</h3>
                    
                    @if(session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('agenda.daftar-volunteer', $agenda) }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="contoh@email.com">
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                                <input type="text" name="no_hp" id="no_hp" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="081234567890">
                            </div>

                            <div>
                                <label for="alasan" class="block text-sm font-medium text-gray-700 mb-1">Alasan Bergabung (Opsional)</label>
                                <textarea name="alasan" id="alasan" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Ceritakan mengapa Anda ingin menjadi volunteer..."></textarea>
                            </div>

                            <button type="submit" 
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Daftar Volunteer
                            </button>
                        </div>
                    </form>
                </div>
                @elseif($agenda->deadline_pendaftaran < now())
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800">Pendaftaran volunteer sudah ditutup.</p>
                </div>
                @elseif($volunteerDiterima >= $agenda->kuota_volunteer)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800">Kuota volunteer sudah penuh.</p>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
</x-layouts.app>