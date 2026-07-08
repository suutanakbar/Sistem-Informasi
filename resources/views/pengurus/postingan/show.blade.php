<x-layouts.pengurus title="{{ $postingan->judul }}" headerTitle="Detail Postingan">
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Postingan</h1>
            <div class="flex gap-2">
                <a href="{{ route('postingan.edit', $postingan) }}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                    Edit Postingan
                </a>
                <a href="{{ route('postingan.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                @if($postingan->foto)
                <img src="{{ asset('storage/' . $postingan->foto) }}" alt="{{ $postingan->judul }}" class="w-full h-96 object-cover rounded-lg mb-6">
                @endif

                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                        {{ ucfirst($postingan->jenis_konten) }}
                    </span>
                    @if($postingan->is_published)
                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                        Published
                    </span>
                    @else
                    <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                        Draft
                    </span>
                    @endif
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $postingan->judul }}</h2>

                <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-200">
                    <span>{{ $postingan->dibuat_pada->format('d F Y H:i') }}</span>
                    @if($postingan->tanggal_publish)
                    <span>•</span>
                    <span>Dipublikasi: {{ $postingan->tanggal_publish->format('d F Y H:i') }}</span>
                    @endif
                </div>

                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $postingan->isi_konten }}
                </div>
            </div>
        </div>

        @if(!$postingan->is_published)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-sm text-yellow-800 mb-3">Postingan ini masih dalam status draft.</p>
            <form method="POST" action="{{ route('postingan.publish', $postingan) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Publikasikan Postingan
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
</x-layouts.pengurus>