<x-layouts.admin title="Dashboard Admin" headerTitle="Dashboard Admin">
    <div class="space-y-6">
    <!-- Welcome Message -->
    <div class="rounded-lg border border-blue-200 bg-blue-50 p-6">
        <h2 class="text-lg font-semibold text-blue-900">Selamat Datang, {{ auth()->user()->nama }}!</h2>
        <p class="mt-2 text-sm text-blue-700">Anda login sebagai Admin dengan akses penuh ke semua fitur sistem.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            'Ormada' => $totalOrmada,
            'Anggota' => $totalAnggota,
            'Pengurus' => $totalPengurus,
            'Mahasiswa' => $totalMahasiswa,
        ] as $label => $value)
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">{{ $label }}</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <!-- Quick Actions -->
    <section class="rounded-lg border border-zinc-200 bg-white p-6">
        <h2 class="font-semibold">Aksi Cepat</h2>
        <div class="mt-4 flex flex-wrap gap-2">
            <a href="{{ route('profil-ormada.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Ormada
            </a>
            <a href="{{ route('anggota-ormada.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Anggota
            </a>
            <a href="{{ route('agenda.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Buat Agenda
            </a>
            <a href="{{ route('postingan.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Buat Postingan
            </a>
            <a href="{{ route('proposal.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Buat Proposal
            </a>
        </div>
    </section>

    <!-- Management Links -->
    <section class="rounded-lg border border-zinc-200 bg-white p-6">
        <h2 class="font-semibold">Manajemen Data</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('profil-ormada.index') }}" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Profil Ormada</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola data profil semua ormada</p>
            </a>
            <a href="{{ route('anggota-ormada.index') }}" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Anggota Ormada</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola data anggota ormada</p>
            </a>
            <a href="{{ route('agenda.index') }}" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Agenda</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola agenda kegiatan</p>
            </a>
            <a href="{{ route('postingan.index') }}" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Postingan</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola postingan dan berita</p>
            </a>
            <a href="{{ route('proposal.index') }}" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Proposal</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola proposal kegiatan</p>
            </a>
            <a href="{{ route('aspirasi.index') }}" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Aspirasi</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola aspirasi mahasiswa</p>
            </a>
        </div>
    </section>
    </div>
</x-layouts.admin>
