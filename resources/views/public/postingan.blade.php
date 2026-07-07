<x-layouts.app title="Berita & Pengumuman">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Berita & Pengumuman</h1>
            <p class="mt-2 text-sm text-gray-600">Informasi terbaru dari ormada dan Pemda Temanggung.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($postingans as $postingan)
            <article class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                @if($postingan->foto)
                <img src="{{ asset('storage/' . $postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            {{ ucfirst($postingan->jenis_konten) }}
                        </span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $postingan->judul }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                        {{ Str::limit($postingan->isi_konten, 150) }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $postingan->admin->nama }}</span>
                        <span>{{ $postingan->tanggal_publish->diffForHumans() }}</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Belum ada postingan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
</x-layouts.app>