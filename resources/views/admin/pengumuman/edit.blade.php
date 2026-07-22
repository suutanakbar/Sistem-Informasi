<x-layouts.admin title="Edit Pengumuman" headerTitle="Edit Pengumuman">
    <div class="max-w-2xl">
        <div class="rounded-lg border border-zinc-200 bg-white p-6">
            <form method="POST" action="{{ route('pengumuman.update', $pengumuman) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-zinc-700">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $pengumuman->judul) }}" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_publish" class="block text-sm font-medium text-zinc-700">Tanggal Publish</label>
                        <input type="date" name="tanggal_publish" id="tanggal_publish" value="{{ old('tanggal_publish', $pengumuman->tanggal_publish) }}" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('tanggal_publish')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="isi" class="block text-sm font-medium text-zinc-700">Isi Pengumuman</label>
                        <textarea name="isi" id="isi" rows="8" required
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('isi', $pengumuman->isi) }}</textarea>
                        @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="foto" class="block text-sm font-medium text-zinc-700">Foto (opsional)</label>
                        <input type="file" name="foto" id="foto" accept="image/*"
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-zinc-700">File Lampiran (opsional)</label>
                        <input type="file" name="file" id="file"
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center gap-4">
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                        Update
                    </button>
                    <a href="{{ route('pengumuman.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>