<x-layouts.app title="Anggota Ormada">
    <x-page-header title="Anggota Ormada" description="Data anggota internal ormada. Pemda dapat melihat detail, masyarakat umum tidak punya akses ke halaman ini.">
        @if (auth()->user()->isAdmin() || auth()->user()->isPengurusOrmada())
            <x-button-link href="{{ route('anggota-ormada.create') }}">Tambah Anggota</x-button-link>
        @endif
    </x-page-header>

    <form method="GET" class="mb-5 grid gap-3 rounded-lg border border-zinc-200 bg-white p-4 md:grid-cols-4">
        <input name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, prodi" class="rounded-md border border-zinc-300 px-3 py-2 text-sm">
        <select name="status_aktif" class="rounded-md border border-zinc-300 px-3 py-2 text-sm">
            <option value="">Semua status</option>
            @foreach (['fungsionaris' => 'Fungsionaris', 'mahasiswa_biasa' => 'Mahasiswa biasa', 'demisioner' => 'Demisioner', 'alumni' => 'Alumni'] as $value => $label)
                <option value="{{ $value }}" @selected(request('status_aktif') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <select name="is_pengurus" class="rounded-md border border-zinc-300 px-3 py-2 text-sm">
            <option value="">Semua pengurus</option>
            <option value="YA" @selected(request('is_pengurus') === 'YA')>Pengurus</option>
            <option value="TIDAK" @selected(request('is_pengurus') === 'TIDAK')>Bukan pengurus</option>
        </select>
        @if (! auth()->user()->isPengurusOrmada())
            <select name="profil_ormada_id" class="rounded-md border border-zinc-300 px-3 py-2 text-sm">
                <option value="">Semua ormada</option>
                @foreach ($profilOrmadas as $profil)
                    <option value="{{ $profil->id }}" @selected((string) request('profil_ormada_id') === (string) $profil->id)>{{ $profil->nama_universitas }}</option>
                @endforeach
            </select>
        @endif
        <div class="flex gap-2 md:col-span-4">
            <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">Filter</button>
            <a href="{{ route('anggota-ormada.index') }}" class="rounded-md border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-800 hover:bg-zinc-50">Reset</a>
        </div>
    </form>

    <div class="overflow-hidden rounded-lg border border-zinc-200 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-zinc-600">
                    <tr>
                        <th class="px-5 py-3">Nama</th>
                        <th class="px-5 py-3">NIM</th>
                        <th class="px-5 py-3">Program Studi</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Jabatan</th>
                        <th class="px-5 py-3">Ormada</th>
                        <th class="px-5 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($anggotaOrmadas as $anggota)
                        <tr>
                            <td class="px-5 py-3 font-medium">{{ $anggota->nama_lengkap }}</td>
                            <td class="px-5 py-3">{{ $anggota->nim }}</td>
                            <td class="px-5 py-3">{{ $anggota->program_studi }}</td>
                            <td class="px-5 py-3">{{ str_replace('_', ' ', $anggota->status_aktif) }}</td>
                            <td class="px-5 py-3">{{ $anggota->jabatan ?: '-' }}</td>
                            <td class="px-5 py-3">{{ $anggota->profilOrmada?->nama_universitas }}</td>
                            <td class="px-5 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a class="text-zinc-950 underline" href="{{ route('anggota-ormada.show', $anggota) }}">Detail</a>
                                    @if (auth()->user()->isAdmin() || auth()->id() === $anggota->profilOrmada?->admin_id)
                                        <a class="text-zinc-950 underline" href="{{ route('anggota-ormada.edit', $anggota) }}">Edit</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-zinc-500">Belum ada anggota sesuai filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $anggotaOrmadas->links() }}</div>
</x-layouts.app>
