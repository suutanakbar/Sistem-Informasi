<x-layouts.app title="Detail Profil Ormada">
    <x-page-header title="{{ $profilOrmada->nama_universitas }}" description="{{ $profilOrmada->alamat_universitas }}">
        @if (auth()->user()->isAdmin() || auth()->id() === $profilOrmada->admin_id)
            <x-button-link href="{{ route('profil-ormada.edit', $profilOrmada) }}">Edit Profil</x-button-link>
        @endif
        <x-button-link href="{{ route('anggota-ormada.index', ['profil_ormada_id' => $profilOrmada->id]) }}" variant="secondary">Lihat Anggota</x-button-link>
    </x-page-header>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex flex-col gap-5 sm:flex-row">
                <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-lg bg-zinc-100 text-xl font-semibold text-zinc-600">
                    @if ($profilOrmada->logo)
                        <img src="{{ asset('storage/'.$profilOrmada->logo) }}" alt="Logo {{ $profilOrmada->nama_universitas }}" class="h-24 w-24 rounded-lg object-cover">
                    @else
                        {{ strtoupper(substr($profilOrmada->nama_universitas, 0, 2)) }}
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500">Deskripsi</p>
                    <p class="mt-2 leading-7 text-zinc-700">{{ $profilOrmada->deskripsi ?: 'Belum ada deskripsi.' }}</p>
                </div>
            </div>
        </section>

        <aside class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total mahasiswa universitas</p>
                <p class="mt-1 text-2xl font-semibold">{{ number_format($profilOrmada->total_mahasiswa_univ) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Anggota terdata</p>
                <p class="mt-1 text-2xl font-semibold">{{ $profilOrmada->anggota_count }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Pengurus aktif</p>
                <p class="mt-1 text-2xl font-semibold">{{ $profilOrmada->pengurus_count }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Alumni / Demisioner</p>
                <p class="mt-1 text-2xl font-semibold">{{ $profilOrmada->alumni_count }} / {{ $profilOrmada->demisioner_count }}</p>
            </div>
        </aside>
    </div>

    <section class="mt-6 rounded-lg border border-zinc-200 bg-white">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="font-semibold">Anggota terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-zinc-600">
                    <tr>
                        <th class="px-5 py-3">Nama</th>
                        <th class="px-5 py-3">NIM</th>
                        <th class="px-5 py-3">Program Studi</th>
                        <th class="px-5 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($anggotaRingkas as $anggota)
                        <tr>
                            <td class="px-5 py-3"><a class="font-medium hover:underline" href="{{ route('anggota-ormada.show', $anggota) }}">{{ $anggota->nama_lengkap }}</a></td>
                            <td class="px-5 py-3">{{ $anggota->nim }}</td>
                            <td class="px-5 py-3">{{ $anggota->program_studi }}</td>
                            <td class="px-5 py-3">{{ str_replace('_', ' ', $anggota->status_aktif) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-zinc-500">Belum ada anggota.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-layouts.app>
