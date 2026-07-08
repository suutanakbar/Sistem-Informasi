<x-layouts.pengurus title="Postingan Saya" headerTitle="Postingan Saya">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Postingan Saya</h1>
            <a href="{{ route('postingan.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                Buat Postingan
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($postingans as $postingan)
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                @if($postingan->foto)
                <img src="{{ asset('storage/' . $postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            {{ ucfirst($postingan->jenis_konten) }}
                        </span>
                        @if($postingan->is_published)
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Published
                        </span>
                        @else
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            Draft
                        </span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">{{ $postingan->judul }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                        {{ Str::limit($postingan->isi_konten, 150) }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>{{ $postingan->dibuat_pada->format('d M Y') }}</span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('postingan.show', $postingan) }}" class="text-orange-600 hover:text-orange-800 text-sm">
                            Detail
                        </a>
                        <a href="{{ route('postingan.edit', $postingan) }}" class="text-blue-600 hover:text-blue-800 text-sm ml-3">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Belum ada postingan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $postingans->links() }}
        </div>
    </div>
</div>
</x-layouts.pengurus>