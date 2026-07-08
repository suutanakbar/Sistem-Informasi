<x-layouts.pemda title="Edit Aspirasi" headerTitle="Edit Aspirasi">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Aspirasi</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui data aspirasi yang telah diajukan.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('aspirasi.update', $aspirasi) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="topik_aspirasi" class="block text-sm font-medium text-gray-700">Topik Aspirasi</label>
                            <input type="text" name="topik_aspirasi" id="topik_aspirasi" value="{{ old('topik_aspirasi', $aspirasi->topik_aspirasi) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('topik_aspirasi') border-red-500 @enderror"
                                placeholder="Contoh: Permintaan Bantuan Dana Kegiatan">
                            @error('topik_aspirasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="detail_aspirasi" class="block text-sm font-medium text-gray-700">Detail Aspirasi</label>
                            <textarea name="detail_aspirasi" id="detail_aspirasi" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('detail_aspirasi') border-red-500 @enderror"
                                placeholder="Jelaskan aspirasi Anda secara detail...">{{ old('detail_aspirasi', $aspirasi->detail_aspirasi) }}</textarea>
                            @error('detail_aspirasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700">File Pendukung (Opsional)</label>
                            <input type="file" name="file" id="file"
                                class="mt-1 block w-full text-sm text-gray-500 @error('file') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimal 5MB. Biarkan kosong jika tidak ingin mengubah file.</p>
                            @if($aspirasi->file)
                            <p class="mt-1 text-sm text-gray-600">File saat ini: <a href="{{ asset('storage/' . $aspirasi->file) }}" target="_blank" class="text-emerald-600 hover:text-emerald-800">Download</a></p>
                            @endif
                            @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('aspirasi.show', $aspirasi) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layouts.pemda>