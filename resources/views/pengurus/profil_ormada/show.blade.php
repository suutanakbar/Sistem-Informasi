<x-layouts.pengurus title="Detail Profil Ormada" headerTitle="Detail Profil Ormada">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('profil-ormada.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali</a>
            <a href="{{ route('profil-ormada.edit', $profilOrmada) }}" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 text-sm">
                Edit Profil
            </a>
        </div>

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
                        <h2 class="text-xl font-semibold text-zinc-950">{{ $profilOrmada->nama_universitas }}</h2>
                        <p class="mt-1 text-sm text-zinc-600">{{ $profilOrmada->alamat_universitas }}</p>
                        <p class="mt-2 text-sm text-zinc-700">{{ $profilOrmada->deskripsi ?: 'Belum ada deskripsi.' }}</p>
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
                <p class="text-sm text-zinc-500">Mahasiswa</p>
                <p class="mt-1 text-2xl font-semibold">{{ $profilOrmada->anggota_count - $profilOrmada->pengurus_count }}</p>
            </div>
            </aside>
        </div>

        <!-- Anggota Section -->
        <section class="mt-6 rounded-lg border border-zinc-200 bg-white">
            <div class="border-b border-zinc-200 px-5 py-4 flex justify-between items-center">
                <h2 class="font-semibold text-lg">Daftar Anggota</h2>
                <a href="{{ route('anggota-ormada.create') }}" class="text-sm bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700">
                    + Tambah Anggota
                </a>
            </div>

            <!-- Search and Filter -->
            <div class="px-5 py-3 bg-gray-50 border-b border-zinc-200">
                <form method="GET" action="{{ route('profil-ormada.show', $profilOrmada) }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama, NIM, atau Program Studi..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="status_aktif" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status_aktif" id="status_aktif" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="fungsionaris" {{ request('status_aktif') === 'fungsionaris' ? 'selected' : '' }}>Fungsionaris</option>
                            <option value="mahasiswa" {{ request('status_aktif') === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Anggota Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 text-sm">
                    <thead class="bg-zinc-50 text-left text-zinc-600">
                        <tr>
                            <th class="px-5 py-3">Nama</th>
                            <th class="px-5 py-3">Program Studi</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse($anggotaList as $anggota)
                            <tr>
                                <td class="px-5 py-3 font-medium">{{ $anggota->nama_lengkap }}</td>
                                <td class="px-5 py-3">{{ $anggota->program_studi }}</td>
                                <td class="px-5 py-3 text-right text-sm font-medium">
                                    <a href="{{ route('anggota-ormada.show', $anggota) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Detail
                                    </a>
                                    <span class="mx-2">|</span>
                                    <a href="{{ route('anggota-ormada.edit', $anggota) }}" class="text-green-600 hover:text-green-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('anggota-ormada.destroy', $anggota) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-6 text-center text-zinc-500">
                                    Belum ada anggota.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($anggotaList->hasPages())
            <div class="mt-4 px-4 py-3">
                {{ $anggotaList->links() }}
            </div>
            @endif
        </section>
    </div>
</div>
</x-layouts.pengurus>