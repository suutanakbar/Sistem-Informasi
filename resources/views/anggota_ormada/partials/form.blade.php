@php($anggotaOrmada = $anggotaOrmada ?? null)

<div class="grid gap-5">
    @if (! auth()->user()->isPengurusOrmada())
        <label class="block">
            <span class="text-sm font-medium text-zinc-700">Profil Ormada</span>
            <select name="profil_ormada_id" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                <option value="">Pilih ormada</option>
                @foreach ($profilOrmadas as $profil)
                    <option value="{{ $profil->id }}" @selected((string) old('profil_ormada_id', $anggotaOrmada?->profil_ormada_id) === (string) $profil->id)>{{ $profil->nama_universitas }}</option>
                @endforeach
            </select>
        </label>
    @else
        <input type="hidden" name="profil_ormada_id" value="{{ auth()->user()->profilOrmada?->id }}">
    @endif

    <!-- Biodata Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Biodata</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Nama Lengkap <span class="text-red-500">*</span></span>
                <input name="nama_lengkap" value="{{ old('nama_lengkap', $anggotaOrmada?->nama_lengkap) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">NIK <span class="text-red-500">*</span></span>
                <input name="nik" value="{{ old('nik', $anggotaOrmada?->nik) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tempat Lahir</span>
                <input name="tempat_lahir" value="{{ old('tempat_lahir', $anggotaOrmada?->tempat_lahir) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tanggal Lahir</span>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $anggotaOrmada?->tanggal_lahir?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Agama</span>
                <select name="agama" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="">Pilih Agama</option>
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $agamaOption)
                        <option value="{{ $agamaOption }}" @selected(old('agama', $anggotaOrmada?->agama) === $agamaOption)>{{ $agamaOption }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Golongan Darah</span>
                <select name="golongan_darah" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="">Pilih</option>
                    @foreach(['A','B','AB','O'] as $golongan)
                        <option value="{{ $golongan }}" @selected(old('golongan_darah', $anggotaOrmada?->golongan_darah) === $golongan)>{{ $golongan }}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </div>

    <!-- Akademik Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Akademik</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">NIM <span class="text-red-500">*</span></span>
                <input name="nim" value="{{ old('nim', $anggotaOrmada?->nim) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Program Studi <span class="text-red-500">*</span></span>
                <input name="program_studi" value="{{ old('program_studi', $anggotaOrmada?->program_studi) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Fakultas</span>
                <input name="fakultas" value="{{ old('fakultas', $anggotaOrmada?->fakultas) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tanggal Masuk Kuliah</span>
                <input type="date" name="tanggal_masuk_kuliah" value="{{ old('tanggal_masuk_kuliah', $anggotaOrmada?->tanggal_masuk_kuliah?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tanggal Lulus Kuliah</span>
                <input type="date" name="tanggal_lulus_kuliah" value="{{ old('tanggal_lulus_kuliah', $anggotaOrmada?->tanggal_lulus_kuliah?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
        </div>
    </div>

    <!-- Kontak Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Kontak</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Nomor HP</span>
                <input name="no_hp" value="{{ old('no_hp', $anggotaOrmada?->no_hp) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Email</span>
                <input type="email" name="email" value="{{ old('email', $anggotaOrmada?->email) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block md:col-span-2">
                <span class="text-sm font-medium text-zinc-700">Alamat</span>
                <textarea name="alamat" rows="3" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">{{ old('alamat', $anggotaOrmada?->alamat) }}</textarea>
            </label>
            <label class="block md:col-span-2">
                <span class="text-sm font-medium text-zinc-700">CV (PDF)</span>
                <input type="file" name="cv" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                @if($anggotaOrmada?->cv_path)
                    <p class="mt-1 text-sm text-gray-600">CV saat ini: <a href="{{ asset('storage/'.$anggotaOrmada->cv_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat CV</a></p>
                @endif
            </label>
        </div>
    </div>

    <!-- Pengurus Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Pengurus</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Pengurus <span class="text-red-500">*</span></span>
                <select name="is_pengurus" id="is_pengurus" required onchange="toggleJabatan()" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="TIDAK" @selected(old('is_pengurus', $anggotaOrmada?->is_pengurus ?? 'TIDAK') === 'TIDAK')>TIDAK</option>
                    <option value="YA" @selected(old('is_pengurus', $anggotaOrmada?->is_pengurus) === 'YA')>YA</option>
                </select>
            </label>
            <label class="block md:col-span-2 {{ ($anggotaOrmada?->is_pengurus === 'YA') ? '' : 'hidden' }}" id="jabatanField">
                <span class="text-sm font-medium text-zinc-700">Jabatan</span>
                <select name="jabatan" id="jabatan" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="">Pilih jabatan</option>
                    <option value="Ketua" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Ketua')>Ketua</option>
                    <option value="Wakil Ketua" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Wakil Ketua')>Wakil Ketua</option>
                    <option value="Sekretaris" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Sekretaris')>Sekretaris</option>
                    <option value="Bendahara" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Bendahara')>Bendahara</option>
                    <option value="Kepala Divisi" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Kepala Divisi')>Kepala Divisi</option>
                    <option value="Wakil Kepala Divisi" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Wakil Kepala Divisi')>Wakil Kepala Divisi</option>
                    <option value="Staff Divisi" @selected(old('jabatan', $anggotaOrmada?->jabatan) === 'Staff Divisi')>Staff Divisi</option>
                </select>
            </label>

            <div id="tanggalJabatanFields" class="{{ ($anggotaOrmada?->is_pengurus === 'YA') ? '' : 'hidden' }}">
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700">Tanggal Mulai Jabatan</span>
                    <input type="date" name="tanggal_mulai_jabatan" value="{{ old('tanggal_mulai_jabatan', $anggotaOrmada?->tanggal_mulai_jabatan?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                </label>
            </div>
            <div id="tanggalAkhirJabatanField" class="{{ ($anggotaOrmada?->is_pengurus === 'YA') ? '' : 'hidden' }}">
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700">Tanggal Akhir Jabatan</span>
                    <input type="date" name="tanggal_akhir_jabatan" value="{{ old('tanggal_akhir_jabatan', $anggotaOrmada?->tanggal_akhir_jabatan?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                </label>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 flex justify-end">
    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Simpan
    </button>
</div>

@push('scripts')
<script>
    function toggleJabatan() {
        const isPengurus = document.getElementById('is_pengurus').value;
        const jabatanField = document.getElementById('jabatanField');
        const tanggalJabatanFields = document.getElementById('tanggalJabatanFields');
        const tanggalAkhirJabatanField = document.getElementById('tanggalAkhirJabatanField');
        
        if (isPengurus === 'YA') {
            jabatanField.classList.remove('hidden');
            tanggalJabatanFields.classList.remove('hidden');
            tanggalAkhirJabatanField.classList.remove('hidden');
            document.getElementById('jabatan').required = true;
        } else {
            jabatanField.classList.add('hidden');
            tanggalJabatanFields.classList.add('hidden');
            tanggalAkhirJabatanField.classList.add('hidden');
            document.getElementById('jabatan').required = false;
        }
    }

    // Initialize on page load
    toggleJabatan();
</script>
@endpush
