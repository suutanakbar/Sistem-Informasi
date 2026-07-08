<x-layouts.pengurus title="Buat Postingan" headerTitle="Buat Postingan">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Buat Postingan Baru</h1>
            <p class="mt-1 text-sm text-gray-600">Buat postingan berita, pengumuman, atau prestasi ormada.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('postingan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Postingan</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('judul') border-red-500 @enderror"
                                placeholder="Contoh: Kegiatan Bakti Sosial Ormada 2024">
                            @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jenis_konten" class="block text-sm font-medium text-gray-700">Jenis Konten</label>
                            <select name="jenis_konten" id="jenis_konten" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('jenis_konten') border-red-500 @enderror">
                                <option value="">Pilih Jenis Konten</option>
                                <option value="berita" {{ old('jenis_konten') === 'berita' ? 'selected' : '' }}>Berita</option>
                                <option value="pengumuman" {{ old('jenis_konten') === 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="prestasi" {{ old('jenis_konten') === 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                            </select>
                            @error('jenis_konten')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="isi_konten" class="block text-sm font-medium text-gray-700">Isi Konten</label>
                            <textarea name="isi_konten" id="isi_konten" rows="8" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('isi_konten') border-red-500 @enderror"
                                placeholder="Tulis konten postingan di sini...">{{ old('isi_konten') }}</textarea>
                            @error('isi_konten')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Postingan (Opsional)</label>
                            <input type="file" name="foto" id="foto"
                                class="mt-1 block w-full text-sm text-gray-500 @error('foto') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                            @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-orange-600 shadow-sm">
                            <label for="is_published" class="text-sm font-medium text-gray-700">
                                Publikasikan sekarang
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">Jika dicentang, postingan akan langsung terlihat oleh publik.</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('postingan.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                            Buat Postingan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layouts.pengurus>