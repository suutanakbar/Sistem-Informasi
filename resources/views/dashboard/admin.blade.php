<x-layouts.admin title="Dashboard Admin" headerTitle="Dashboard Admin">
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
    @endpush
    <div class="space-y-4">
    <!-- Welcome Message -->
    <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
        <h2 class="text-base font-semibold text-blue-900">Selamat Datang, {{ auth()->user()->nama }}!</h2>
        <p class="mt-1 text-xs text-blue-700">Anda login sebagai Admin dengan akses penuh ke semua fitur sistem.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            'Ormada' => $totalOrmada,
            'Anggota' => $totalAnggota,
            'Pengurus' => $totalPengurus,
            'Mahasiswa' => $totalMahasiswa,
        ] as $label => $value)
            <div class="rounded-lg border border-zinc-200 bg-white p-3">
                <p class="text-xs text-zinc-500">{{ $label }}</p>
                <p class="mt-1 text-xl font-semibold">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <!-- Quick Actions -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <h2 class="text-sm font-semibold text-gray-900">Aksi Cepat</h2>
        <div class="mt-3 flex flex-wrap gap-2">
            <a href="{{ route('profil-ormada.create') }}" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Tambah Ormada
            </a>
            <a href="{{ route('anggota-ormada.create') }}" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Tambah Anggota
            </a>
            <a href="{{ route('agenda.create') }}" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Buat Agenda
            </a>
            <a href="{{ route('postingan.create') }}" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Buat Postingan
            </a>
            <a href="{{ route('proposal.create') }}" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Buat Proposal
            </a>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-sm font-semibold text-gray-900">Berita Terbaru</h2>
                <p class="mt-0.5 text-xs text-zinc-500">Postingan dan berita terkini.</p>
            </div>
            <a href="{{ route('postingan.index') }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                Lihat Semua
            </a>
        </div>
        @if($beritaTerbaru->count() === 3)
            <div class="grid gap-4 xl:grid-cols-2">
                <!-- Left: Featured card (50%) -->
                <x-berita-agenda-card :postingan="$beritaTerbaru[0]" />
                
                <!-- Right: Stack 2 cards vertically (each 25%) -->
                <div class="flex flex-col gap-4">
                    <x-berita-agenda-card :postingan="$beritaTerbaru[1]" />
                    <x-berita-agenda-card :postingan="$beritaTerbaru[2]" />
                </div>
            </div>
        @else
            <div class="grid gap-4 {{ $beritaTerbaru->count() === 2 ? 'md:grid-cols-2 xl:grid-cols-2' : 'md:grid-cols-2 xl:grid-cols-3' }}">
                @forelse($beritaTerbaru as $postingan)
                    <x-berita-agenda-card :postingan="$postingan" />
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-xs text-gray-500">Belum ada berita.</p>
                    </div>
                @endforelse
            </div>
        @endif
    </section>

    <!-- Event Calendar -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <h2 class="text-sm font-semibold text-gray-900">Kalender Agenda</h2>
        <p class="mt-1 text-xs text-zinc-500">Agenda kegiatan yang akan datang.</p>
        <div id="calendar" class="mt-3 min-h-[400px]"></div>
    </section>

    <!-- Management Links -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <h2 class="text-sm font-semibold text-gray-900">Manajemen Data</h2>
        <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('profil-ormada.index') }}" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Profil Ormada</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola data profil semua ormada</p>
            </a>
            <a href="{{ route('anggota-ormada.index') }}" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Anggota Ormada</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola data anggota ormada</p>
            </a>
            <a href="{{ route('agenda.index') }}" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Agenda</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola agenda kegiatan</p>
            </a>
            <a href="{{ route('postingan.index') }}" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Postingan</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola postingan dan berita</p>
            </a>
            <a href="{{ route('proposal.index') }}" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Proposal</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola proposal kegiatan</p>
            </a>
            <a href="{{ route('aspirasi.index') }}" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Aspirasi</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola aspirasi mahasiswa</p>
            </a>
        </div>
    </section>
    </div>
</x-layouts.admin>
