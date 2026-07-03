<x-layouts.app title="Detail Anggota">
    <x-page-header title="{{ $anggotaOrmada->nama_lengkap }}" description="{{ $anggotaOrmada->profilOrmada?->nama_universitas }}">
        @if (auth()->user()->isAdmin() || auth()->id() === $anggotaOrmada->profilOrmada?->admin_id)
            <x-button-link href="{{ route('anggota-ormada.edit', $anggotaOrmada) }}">Edit Anggota</x-button-link>
        @endif
        <x-button-link href="{{ route('anggota-ormada.index') }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <section class="rounded-lg border border-zinc-200 bg-white p-6">
        <dl class="grid gap-5 md:grid-cols-2">
            @foreach ([
                'NIM' => $anggotaOrmada->nim,
                'Program studi' => $anggotaOrmada->program_studi,
                'Status aktif' => str_replace('_', ' ', $anggotaOrmada->status_aktif),
                'Pengurus' => $anggotaOrmada->is_pengurus,
                'Jabatan' => $anggotaOrmada->jabatan ?: '-',
                'Nomor HP' => $anggotaOrmada->no_hp ?: '-',
                'Tanggal masuk kuliah' => $anggotaOrmada->tanggal_masuk_kuliah?->format('d M Y') ?: '-',
                'Tanggal lulus kuliah' => $anggotaOrmada->tanggal_lulus_kuliah?->format('d M Y') ?: '-',
                'Tanggal mulai jabatan' => $anggotaOrmada->tanggal_mulai_jabatan?->format('d M Y') ?: '-',
                'Tanggal akhir jabatan' => $anggotaOrmada->tanggal_akhir_jabatan?->format('d M Y') ?: '-',
                'Tanggal demisioner' => $anggotaOrmada->tanggal_demisioner?->format('d M Y') ?: '-',
                'Tanggal lulus' => $anggotaOrmada->tanggal_lulus?->format('d M Y') ?: '-',
            ] as $label => $value)
                <div>
                    <dt class="text-sm font-medium text-zinc-500">{{ $label }}</dt>
                    <dd class="mt-1 text-zinc-950">{{ $value }}</dd>
                </div>
            @endforeach
        </dl>

        @if (auth()->user()->isAdmin() || auth()->id() === $anggotaOrmada->profilOrmada?->admin_id)
            <form method="POST" action="{{ route('anggota-ormada.destroy', $anggotaOrmada) }}" class="mt-8" onsubmit="return confirm('Hapus anggota ini?')">
                @csrf
                @method('DELETE')
                <button class="rounded-md border border-red-300 bg-white px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50">Hapus Anggota</button>
            </form>
        @endif
    </section>
</x-layouts.app>
