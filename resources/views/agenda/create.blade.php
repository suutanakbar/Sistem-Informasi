@php
    $isPemda = ($layout ?? 'admin') === 'pemda';
    $headerTitle = 'Buat Agenda';
    $layoutTag = $isPemda ? 'layouts.pemda' : 'layouts.admin';
@endphp
<x-layouts.{{ $layoutTag }} title="{{ $headerTitle }}" headerTitle="{{ $headerTitle }}">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Buat Agenda Baru</h1>
            <p class="mt-1 text-sm text-gray-600">Buat agenda kegiatan ormada atau Pemda.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('agenda.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="nama_agenda" class="block text-sm font-medium text-gray-700">Nama Agenda</label>
                            <input type="text" name="nama_agenda" id="nama_agenda" value="{{ old('nama_agenda') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('nama_agenda') border-red-500 @enderror"
                                placeholder="Contoh: Bakti Sosial 2024">
                            @error('nama_agenda')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" id="kategori" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('kategori') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="kegiatan_ormada" {{ old('kategori') === 'kegiatan_ormada' ? 'selected' : '' }}>Kegiatan Ormada</option>
                                <option value="kegiatan_pemda" {{ old('kategori') === 'kegiatan_pemda' ? 'selected' : '' }}>Kegiatan Pemda</option>
                                <option value="baksos" {{ old('kategori') === 'baksos' ? 'selected' : '' }}>Bakti Sosial</option>
                                <option value="pendidikan" {{ old('kategori') === 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="kesehatan" {{ old('kategori') === 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="lingkungan" {{ old('kategori') === 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="lainnya" {{ old('kategori') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi_agenda" class="block text-sm font-medium text-gray-700">Deskripsi Agenda</label>
                            <textarea name="deskripsi_agenda" id="deskripsi_agenda" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('deskripsi_agenda') border-red-500 @enderror"
                                placeholder="Jelaskan agenda kegiatan ini...">{{ old('deskripsi_agenda') }}</textarea>
                            @error('deskripsi_agenda')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gambar_poster" class="block text-sm font-medium text-gray-700">Poster Agenda (Opsional)</label>
                            <input type="file" name="gambar_poster" id="gambar_poster"
                                class="mt-1 block w-full text-sm text-gray-500 @error('gambar_poster') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                            @error('gambar_poster')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('waktu_mulai') border-red-500 @enderror">
                                @error('waktu_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('waktu_selesai') border-red-500 @enderror">
                                @error('waktu_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                            <input type="text" name="tempat" id="tempat" value="{{ old('tempat') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tempat') border-red-500 @enderror"
                                placeholder="Contoh: Gedung Serbaguna Pemda">
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
                                    <input type="number" name="kuota_volunteer" id="kuota_volunteer" value="{{ old('kuota_volunteer') }}" min="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('kuota_volunteer') border-red-500 @enderror"
                                        placeholder="Contoh: 50">
                                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak membuka volunteer.</p>
                                    @error('kuota_volunteer')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="deadline_pendaftaran" class="block text-sm font-medium text-gray-700">Deadline Pendaftaran</label>
                                    <input type="datetime-local" name="deadline_pendaftaran" id="deadline_pendaftaran" value="{{ old('deadline_pendaftaran') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('deadline_pendaftaran') border-red-500 @enderror">
                                    <p class="mt-1 text-xs text-gray-500">Harus sebelum waktu mulai agenda.</p>
                                    @error('deadline_pendaftaran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 shadow-sm">
                            <label for="is_published" class="text-sm font-medium text-gray-700">
                                Publikasikan sekarang
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">Jika dicentang, agenda akan langsung terlihat oleh publik.</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('agenda.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Buat Agenda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layouts.{{ $layoutTag }}>
