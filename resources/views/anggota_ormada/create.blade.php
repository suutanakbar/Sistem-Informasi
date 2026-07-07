<x-layouts.app title="Tambah Anggota Ormada">
    <x-page-header title="Tambah Anggota Ormada" description="Isi form berikut untuk menambahkan anggota baru">
        <x-button-link href="{{ route('anggota-ormada.index') }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="{{ route('anggota-ormada.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                        <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('nim') border-red-500 @enderror">
                        @error('nim')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi <span class="text-red-500">*</span></label>
                        <input type="text" name="program_studi" id="program_studi" value="{{ old('program_studi') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('program_studi') border-red-500 @enderror">
                        @error('program_studi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_aktif" class="block text-sm font-medium text-gray-700">Status Aktif <span class="text-red-500">*</span></label>
                        <select name="status_aktif" id="status_aktif" required onchange="toggleJabatan()"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('status_aktif') border-red-500 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="fungsionaris" {{ old('status_aktif') === 'fungsionaris' ? 'selected' : '' }}>Fungsionaris</option>
                            <option value="mahasiswa_biasa" {{ old('status_aktif') === 'mahasiswa_biasa' ? 'selected' : '' }}>Mahasiswa Biasa</option>
                            <option value="demisioner" {{ old('status_aktif') === 'demisioner' ? 'selected' : '' }}>Demisioner</option>
                            <option value="alumni" {{ old('status_aktif') === 'alumni' ? 'selected' : '' }}>Alumni</option>
                        </select>
                        @error('status_aktif')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="is_pengurus" class="block text-sm font-medium text-gray-700">Pengurus <span class="text-red-500">*</span></label>
                        <select name="is_pengurus" id="is_pengurus" required onchange="toggleJabatan()"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('is_pengurus') border-red-500 @enderror">
                            <option value="">Pilih</option>
                            <option value="TIDAK" {{ old('is_pengurus') === 'TIDAK' ? 'selected' : '' }}>Tidak</option>
                            <option value="YA" {{ old('is_pengurus') === 'YA' ? 'selected' : '' }}>Ya</option>
                        </select>
                        @error('is_pengurus')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="jabatanField" class="hidden">
                        <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan <span class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('jabatan') border-red-500 @enderror">
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('no_hp') border-red-500 @enderror">
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_masuk_kuliah" class="block text-sm font-medium text-gray-700">Tanggal Masuk Kuliah</label>
                        <input type="date" name="tanggal_masuk_kuliah" id="tanggal_masuk_kuliah" value="{{ old('tanggal_masuk_kuliah') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tanggal_masuk_kuliah') border-red-500 @enderror">
                        @error('tanggal_masuk_kuliah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lulus_kuliah" class="block text-sm font-medium text-gray-700">Tanggal Lulus Kuliah</label>
                        <input type="date" name="tanggal_lulus_kuliah" id="tanggal_lulus_kuliah" value="{{ old('tanggal_lulus_kuliah') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tanggal_lulus_kuliah') border-red-500 @enderror">
                        @error('tanggal_lulus_kuliah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_mulai_jabatan" class="block text-sm font-medium text-gray-700">Tanggal Mulai Jabatan</label>
                        <input type="date" name="tanggal_mulai_jabatan" id="tanggal_mulai_jabatan" value="{{ old('tanggal_mulai_jabatan') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tanggal_mulai_jabatan') border-red-500 @enderror">
                        @error('tanggal_mulai_jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_akhir_jabatan" class="block text-sm font-medium text-gray-700">Tanggal Akhir Jabatan</label>
                        <input type="date" name="tanggal_akhir_jabatan" id="tanggal_akhir_jabatan" value="{{ old('tanggal_akhir_jabatan') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tanggal_akhir_jabatan') border-red-500 @enderror">
                        @error('tanggal_akhir_jabatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_demisioner" class="block text-sm font-medium text-gray-700">Tanggal Demisioner</label>
                        <input type="date" name="tanggal_demisioner" id="tanggal_demisioner" value="{{ old('tanggal_demisioner') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tanggal_demisioner') border-red-500 @enderror">
                        @error('tanggal_demisioner')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lulus" class="block text-sm font-medium text-gray-700">Tanggal Lulus</label>
                        <input type="date" name="tanggal_lulus" id="tanggal_lulus" value="{{ old('tanggal_lulus') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tanggal_lulus') border-red-500 @enderror">
                        @error('tanggal_lulus')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(auth()->user()->isAdmin())
                    <div class="md:col-span-2">
                        <label for="profil_ormada_id" class="block text-sm font-medium text-gray-700">Profil Ormada <span class="text-red-500">*</span></label>
                        <select name="profil_ormada_id" id="profil_ormada_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('profil_ormada_id') border-red-500 @enderror">
                            <option value="">Pilih Ormada</option>
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
                    @endif
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-button-link href="{{ route('anggota-ormada.index') }}" variant="secondary">Batal</x-button-link>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleJabatan() {
            const isPengurus = document.getElementById('is_pengurus').value;
            const jabatanField = document.getElementById('jabatanField');
            
            if (isPengurus === 'YA') {
                jabatanField.classList.remove('hidden');
                document.getElementById('jabatan').required = true;
            } else {
                jabatanField.classList.add('hidden');
                document.getElementById('jabatan').required = false;
            }
        }

        // Initialize on page load
        toggleJabatan();
    </script>
    @endpush
</x-layouts.app>