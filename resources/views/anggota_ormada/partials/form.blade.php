@php($anggotaOrmada = $anggotaOrmada ?? null)

<div class="grid gap-5 md:grid-cols-2">
    @if (! auth()->user()->isPengurusOrmada())
        <label class="block md:col-span-2">
            <span class="text-sm font-medium text-zinc-700">Profil ormada</span>
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

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Nama lengkap</span>
        <input name="nama_lengkap" value="{{ old('nama_lengkap', $anggotaOrmada?->nama_lengkap) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">NIM</span>
        <input name="nim" value="{{ old('nim', $anggotaOrmada?->nim) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Program studi</span>
        <input name="program_studi" value="{{ old('program_studi', $anggotaOrmada?->program_studi) }}" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Nomor HP</span>
        <input name="no_hp" value="{{ old('no_hp', $anggotaOrmada?->no_hp) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Pengurus</span>
        <select name="is_pengurus" required id="is_pengurus" onchange="toggleJabatan()" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
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
            <span class="text-sm font-medium text-zinc-700">Tanggal mulai jabatan</span>
            <input type="date" name="tanggal_mulai_jabatan" value="{{ old('tanggal_mulai_jabatan', $anggotaOrmada?->tanggal_mulai_jabatan?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
        </label>
        <label class="block">
            <span class="text-sm font-medium text-zinc-700">Tanggal akhir jabatan</span>
            <input type="date" name="tanggal_akhir_jabatan" value="{{ old('tanggal_akhir_jabatan', $anggotaOrmada?->tanggal_akhir_jabatan?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
        </label>
    </div>

    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Tanggal masuk kuliah</span>
        <input type="date" name="tanggal_masuk_kuliah" value="{{ old('tanggal_masuk_kuliah', $anggotaOrmada?->tanggal_masuk_kuliah?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Tanggal lulus kuliah</span>
        <input type="date" name="tanggal_lulus_kuliah" value="{{ old('tanggal_lulus_kuliah', $anggotaOrmada?->tanggal_lulus_kuliah?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>
</div>

<div class="mt-6 flex justify-end">
    <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">Simpan</button>
</div>

    @push('scripts')
    <script>
        function toggleJabatan() {
            const isPengurus = document.getElementById('is_pengurus').value;
            const jabatanField = document.getElementById('jabatanField');
            const tanggalJabatanFields = document.getElementById('tanggalJabatanFields');
            
            if (isPengurus === 'YA') {
                jabatanField.classList.remove('hidden');
                tanggalJabatanFields.classList.remove('hidden');
                document.getElementById('jabatan').required = true;
            } else {
                jabatanField.classList.add('hidden');
                tanggalJabatanFields.classList.add('hidden');
                document.getElementById('jabatan').required = false;
            }
        }

        // Initialize on page load
        toggleJabatan();
    </script>
    @endpush
