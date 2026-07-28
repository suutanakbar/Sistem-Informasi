<x-layouts.admin title="Buat Aspirasi" headerTitle="Buat Aspirasi">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Buat Aspirasi Baru</h1>
            <p class="mt-1 text-sm text-gray-600">Sampaikan aspirasi ormada kepada Pemda Temanggung.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="topik_aspirasi" class="block text-sm font-medium text-gray-700">Topik Aspirasi</label>
                            <input type="text" name="topik_aspirasi" id="topik_aspirasi" value="{{ old('topik_aspirasi') }}" required
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
                                placeholder="Jelaskan aspirasi Anda secara detail...">{{ old('detail_aspirasi') }}</textarea>
                            @error('detail_aspirasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="profil_ormada_id" class="block text-sm font-medium text-gray-700">Profil Ormada <span class="text-red-500">*</span></label>
                            <select name="profil_ormada_id" id="profil_ormada_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('profil_ormada_id') border-red-500 @enderror">
                                <option value="">-- Pilih Ormada --</option>
                                @foreach($profilOrmadas as $profil)
                                    <option value="{{ $profil->id }}" {{ old('profil_ormada_id') == $profil->id ? 'selected' : '' }}>
                                        {{ $profil->nama_universitas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('profil_ormada_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700">File Pendukung (Opsional)</label>
                            <input type="file" name="file" id="file"
                                class="mt-1 block w-full text-sm text-gray-500 @error('file') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimal 5MB.</p>
                            @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('aspirasi.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Ajukan Aspirasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin>