<x-layouts.pengurus title="Edit Agenda" headerTitle="Edit Agenda">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Agenda</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui data agenda yang telah dibuat.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('agenda.update', $agenda) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="nama_agenda" class="block text-sm font-medium text-gray-700">Nama Agenda</label>
                            <input type="text" name="nama_agenda" id="nama_agenda" value="{{ old('nama_agenda', $agenda->nama_agenda) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('nama_agenda') border-red-500 @enderror"
                                placeholder="Contoh: Rapat Rutin Ormada">
                            @error('nama_agenda')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" id="kategori" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('kategori') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="kegiatan_ormada" {{ old('kategori', $agenda->kategori) === 'kegiatan_ormada' ? 'selected' : '' }}>Kegiatan Ormada</option>
                                <option value="baksos" {{ old('kategori', $agenda->kategori) === 'baksos' ? 'selected' : '' }}>Bakti Sosial</option>
                                <option value="pendidikan" {{ old('kategori', $agenda->kategori) === 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="kesehatan" {{ old('kategori', $agenda->kategori) === 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="lingkungan" {{ old('kategori', $agenda->kategori) === 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="lainnya" {{ old('kategori', $agenda->kategori) === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi_agenda" class="block text-sm font-medium text-gray-700">Deskripsi Agenda</label>
                            <textarea name="deskripsi_agenda" id="deskripsi_agenda" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('deskripsi_agenda') border-red-500 @enderror"
                                placeholder="Jelaskan agenda kegiatan ini...">{{ old('deskripsi_agenda', $agenda->deskripsi_agenda) }}</textarea>
                            @error('deskripsi_agenda')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gambar_poster" class="block text-sm font-medium text-gray-700">Poster Agenda (Opsional)</label>
                            <input type="file" name="gambar_poster" id="gambar_poster"
                                class="mt-1 block w-full text-sm text-gray-500 @error('gambar_poster') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah poster.</p>
                            @if($agenda->gambar_poster)
                            <p class="mt-1 text-sm text-gray-600">Poster saat ini: <a href="{{ asset('storage/' . $agenda->gambar_poster) }}" target="_blank" class="text-orange-600 hover:text-orange-800">Lihat Poster</a></p>
                            @endif
                            @error('gambar_poster')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai', $agenda->waktu_mulai->format('Y-m-d\TH:i')) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('waktu_mulai') border-red-500 @enderror">
                                @error('waktu_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai', $agenda->waktu_selesai->format('Y-m-d\TH:i')) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('waktu_selesai') border-red-500 @enderror">
                                @error('waktu_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                            <input type="text" name="tempat" id="tempat" value="{{ old('tempat', $agenda->tempat) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tempat') border-red-500 @enderror"
                                placeholder="Contoh: Gedung Serbaguna Ormada">
                            @error('tempat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Volunteer (Opsional)</h3>
                            <p class="text-sm text-gray-600 mb-4">Isi bagian ini jika agenda membuka pendaftaran volunteer.</p>

                            <div class="space-y-4">
                                <div>
                                    <label for="kuota_volunteer" class="block text-sm font-medium text-gray-700">Kuota Volunteer</label>
                                    <input type="number" name="kuota_volunteer" id="kuota_volunteer" value="{{ old('kuota_volunteer', $agenda->kuota_volunteer) }}" min="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('kuota_volunteer') border-red-500 @enderror"
                                        placeholder="Contoh: 50">
                                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak membuka volunteer.</p>
                                    @error('kuota_volunteer')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="deadline_pendaftaran" class="block text-sm font-medium text-gray-700">Deadline Pendaftaran</label>
                                    <input type="datetime-local" name="deadline_pendaftaran" id="deadline_pendaftaran" value="{{ old('deadline_pendaftaran', $agenda->deadline_pendaftaran?->format('Y-m-d\TH:i')) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('deadline_pendaftaran') border-red-500 @enderror">
                                    <p class="mt-1 text-xs text-gray-500">Harus sebelum waktu mulai agenda.</p>
                                    @error('deadline_pendaftaran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $agenda->is_published) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-orange-600 shadow-sm">
                            <label for="is_published" class="text-sm font-medium text-gray-700">
                                Publikasikan sekarang
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">Jika dicentang, agenda akan langsung terlihat oleh publik.</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('agenda.show', $agenda) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layouts.pengurus>