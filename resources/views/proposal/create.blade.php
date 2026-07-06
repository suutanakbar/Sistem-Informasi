<x-layouts.app title="Buat Proposal">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Buat Proposal Baru</h1>
            <p class="mt-1 text-sm text-gray-600">Ajukan proposal bantuan kepada dinas terkait.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('proposal.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="dinas_tujuan_id" class="block text-sm font-medium text-gray-700">Dinas Tujuan</label>
                            <select name="dinas_tujuan_id" id="dinas_tujuan_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('dinas_tujuan_id') border-red-500 @enderror">
                                <option value="">Pilih Dinas Tujuan</option>
                                @foreach($dinasTujuanList as $dinas)
                                <option value="{{ $dinas->id }}" {{ old('dinas_tujuan_id') == $dinas->id ? 'selected' : '' }}>
                                    {{ $dinas->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('dinas_tujuan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="judul_kegiatan" class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                            <input type="text" name="judul_kegiatan" id="judul_kegiatan" value="{{ old('judul_kegiatan') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('judul_kegiatan') border-red-500 @enderror">
                            @error('judul_kegiatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jenis_bantuan" class="block text-sm font-medium text-gray-700">Jenis Bantuan</label>
                            <select name="jenis_bantuan" id="jenis_bantuan" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('jenis_bantuan') border-red-500 @enderror">
                                <option value="">Pilih Jenis Bantuan</option>
                                <option value="dana" {{ old('jenis_bantuan') == 'dana' ? 'selected' : '' }}>Dana</option>
                                <option value="izin" {{ old('jenis_bantuan') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="tempat" {{ old('jenis_bantuan') == 'tempat' ? 'selected' : '' }}>Tempat</option>
                                <option value="fasilitas" {{ old('jenis_bantuan') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                            </select>
                            @error('jenis_bantuan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi_kegiatan" class="block text-sm font-medium text-gray-700">Deskripsi Kegiatan</label>
                            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" rows="5" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('deskripsi_kegiatan') border-red-500 @enderror">{{ old('deskripsi_kegiatan') }}</textarea>
                            @error('deskripsi_kegiatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="anggaran_dibutuhkan" class="block text-sm font-medium text-gray-700">Anggaran Dibutuhkan (Rp)</label>
                            <input type="number" name="anggaran_dibutuhkan" id="anggaran_dibutuhkan" value="{{ old('anggaran_dibutuhkan', 0) }}" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('anggaran_dibutuhkan') border-red-500 @enderror">
                            @error('anggaran_dibutuhkan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="file_proposal" class="block text-sm font-medium text-gray-700">File Proposal</label>
                            <input type="file" name="file_proposal" id="file_proposal" required
                                class="mt-1 block w-full text-sm text-gray-500 @error('file_proposal') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX. Maksimal 5MB.</p>
                            @error('file_proposal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('proposal.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Ajukan Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
