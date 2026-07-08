@php
    $isPemda = ($layout ?? 'admin') === 'pemda';
    $headerTitle = 'Agenda';
    $layoutTag = $isPemda ? 'layouts.pemda' : 'layouts.admin';
@endphp
<x-layouts.{{ $layoutTag }} title="Daftar Agenda" headerTitle="{{ $headerTitle }}">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Agenda</h1>
            @can('create', App\Models\Agenda::class)
            <a href="{{ route('agenda.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Buat Agenda
            </a>
            @endcan
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="p-4">
                <form method="GET" action="{{ route('agenda.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" id="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriOptions as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') === $kategori ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($agendas as $agenda)
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                @if($agenda->gambar_poster)
                <img src="{{ asset('storage/' . $agenda->gambar_poster) }}" alt="{{ $agenda->nama_agenda }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            {{ ucfirst(str_replace('_', ' ', $agenda->kategori)) }}
                        </span>
                        @if($agenda->is_published)
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Published
                        </span>
                        @else
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            Draft
                        </span>
                        @endif
                        @if($agenda->kuota_volunteer)
                        <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                            Volunteer
                        </span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $agenda->nama_agenda }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                        {{ Str::limit($agenda->deskripsi_agenda, 150) }}
                    </p>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $agenda->waktu_mulai->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $agenda->tempat }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $agenda->admin->nama }}</span>
                        <span>{{ $agenda->dibuat_pada->format('d M Y') }}</span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('agenda.show', $agenda) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            Detail
                        </a>
                        @can('update', $agenda)
                        <a href="{{ route('agenda.edit', $agenda) }}" class="text-indigo-600 hover:text-indigo-800 text-sm ml-3">
                            Edit
                        </a>
                        @endcan
                        @can('publish', $agenda)
                        @if(!$agenda->is_published)
                        <form method="POST" action="{{ route('agenda.publish', $agenda) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-600 hover:text-green-800 text-sm ml-3">
                                Publish
                            </button>
                        </form>
                        @endif
                        @endcan
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Belum ada agenda.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $agendas->links() }}
        </div>
    </div>
</div>
</x-layouts.{{ $layoutTag }}>
