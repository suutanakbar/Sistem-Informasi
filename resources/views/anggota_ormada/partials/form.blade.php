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
        <span class="text-sm font-medium text-zinc-700">Status aktif</span>
        <select name="status_aktif" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            @foreach (['fungsionaris' => 'Fungsionaris', 'mahasiswa_biasa' => 'Mahasiswa biasa', 'demisioner' => 'Demisioner', 'alumni' => 'Alumni'] as $value => $label)
                <option value="{{ $value }}" @selected(old('status_aktif', $anggotaOrmada?->status_aktif) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </label>
    <label class="block">
        <span class="text-sm font-medium text-zinc-700">Pengurus</span>
        <select name="is_pengurus" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            <option value="TIDAK" @selected(old('is_pengurus', $anggotaOrmada?->is_pengurus ?? 'TIDAK') === 'TIDAK')>TIDAK</option>
            <option value="YA" @selected(old('is_pengurus', $anggotaOrmada?->is_pengurus) === 'YA')>YA</option>
        </select>
    </label>
    <label class="block md:col-span-2">
        <span class="text-sm font-medium text-zinc-700">Jabatan</span>
        <input name="jabatan" value="{{ old('jabatan', $anggotaOrmada?->jabatan) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
    </label>

    @foreach ([
        'tanggal_masuk_kuliah' => 'Tanggal masuk kuliah',
        'tanggal_lulus_kuliah' => 'Tanggal lulus kuliah',
        'tanggal_mulai_jabatan' => 'Tanggal mulai jabatan',
        'tanggal_akhir_jabatan' => 'Tanggal akhir jabatan',
        'tanggal_demisioner' => 'Tanggal demisioner',
        'tanggal_lulus' => 'Tanggal lulus',
    ] as $name => $label)
        <label class="block">
            <span class="text-sm font-medium text-zinc-700">{{ $label }}</span>
            <input type="date" name="{{ $name }}" value="{{ old($name, $anggotaOrmada?->{$name}?->format('Y-m-d')) }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
        </label>
    @endforeach
</div>

<div class="mt-6 flex justify-end">
    <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">Simpan</button>
</div>
