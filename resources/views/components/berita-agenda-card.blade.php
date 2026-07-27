@props([
    'postingan',
    'class' => ''
])
<div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow {{ $class }}">
    @if($postingan->foto)
    <img src="{{ asset('storage/' . $postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-40 object-cover">
    @endif
    <div class="p-4">
        <div class="flex items-center gap-1.5 mb-1.5">
            <span class="px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                {{ ucfirst($postingan->jenis_konten) }}
            </span>
            @if($postingan->is_published)
            <span class="px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                Published
            </span>
            @else
            <span class="px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                Draft
            </span>
            @endif
        </div>
        <h3 class="font-semibold text-gray-900 text-sm mb-1.5 line-clamp-2">{{ $postingan->judul }}</h3>
        <p class="text-xs text-gray-600 line-clamp-2 mb-2">
            {{ Str::limit($postingan->isi_konten, 100) }}
        </p>
        <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>{{ $postingan->dibuat_pada->format('d M Y') }}</span>
        </div>
        <div class="text-xs text-gray-500 mb-2">
            {{ $postingan->admin->nama }}
        </div>
        <div class="flex gap-2 pt-2 border-t border-gray-100">
            <a href="{{ route('postingan.show', $postingan) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                Detail
            </a>
            @can('update', $postingan)
            <a href="{{ route('postingan.edit', $postingan) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium ml-2">
                Edit
            </a>
            @endcan
            @can('publish', $postingan)
            @if(!$postingan->is_published)
            <form method="POST" action="{{ route('postingan.publish', $postingan) }}" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="text-green-600 hover:text-green-800 text-xs font-medium ml-2">
                    Publish
                </button>
            </form>
            @endif
            @endcan
        </div>
    </div>
</div>
