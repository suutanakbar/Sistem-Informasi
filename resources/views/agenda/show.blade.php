<x-layouts.admin title="{{ $agenda->nama_agenda }}" headerTitle="Detail Agenda">
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Agenda</h1>
            <div class="flex gap-2">
                @can('update', $agenda)
                <a href="{{ route('agenda.edit', $agenda) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Edit Agenda
                </a>
                @endcan
                <a href="{{ route('agenda.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
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
                    @if($agenda->is_published)
                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                        Published
                    </span>
                    @else
                    <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                        Draft
                    </span>
                    @endif
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
                @endif
            </div>
        </div>

        @can('publish', $agenda)
        @if(!$agenda->is_published)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-sm text-yellow-800 mb-3">Agenda ini masih dalam status draft.</p>
            <form method="POST" action="{{ route('agenda.publish', $agenda) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Publikasikan Agenda
                </button>
            </form>
        </div>
        @endif
        @endcan

        @can('manageVolunteer', $agenda)
        @if($agenda->kuota_volunteer)
        <div class="bg-white shadow sm:rounded-lg mt-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Kelola Volunteer</h3>
                    <a href="{{ route('agenda.volunteer', $agenda) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        Lihat Semua →
                    </a>
                </div>
                <p class="text-sm text-gray-600">
                    Total pendaftar: {{ $agenda->volunteers()->count() }} | 
                    Menunggu: {{ $agenda->volunteers()->where('status', 'pending')->count() }} | 
                    Diterima: {{ $volunteerDiterima }} | 
                    Ditolak: {{ $agenda->volunteers()->where('status', 'ditolak')->count() }}
                </p>
            </div>
        </div>
        @endif
        @endcan
    </div>
</div>
</x-layouts.admin>
