<x-layouts.pemda title="Dashboard Pemda" headerTitle="Dashboard Pemerintah Daerah">
    <div class="space-y-6">
        <!-- Welcome Message -->
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-6">
            <h2 class="text-lg font-semibold text-emerald-900">Selamat Datang, {{ auth()->user()->nama }}!</h2>
            <p class="mt-2 text-sm text-emerald-700">Anda login sebagai Pemerintah Daerah. Kelola agenda dan volunteer untuk kegiatan.</p>
        </div>

        <!-- Quick Actions -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <h2 class="font-semibold">Aksi Cepat</h2>
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ route('agenda.create') }}" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Buat Agenda Baru
                </a>
                <a href="{{ route('postingan.create') }}" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Buat Postingan/Berita
                </a>
            </div>
        </section>

        <!-- Statistics -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Ormada</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($totalOrmada ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Anggota Aktif</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($totalAnggota ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Agenda Mendatang</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($agendaMendatang ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Proposal Menunggu</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($proposalMenunggu ?? 0) }}</p>
            </div>
        </div>

        <!-- Volunteer Management -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Kelola Volunteer</h2>
                <a href="{{ route('volunteer.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Buka dan kelola pendaftaran volunteer untuk agenda kegiatan.</p>
            <div class="mt-4">
                <a href="{{ route('volunteer.index') }}" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Kelola Volunteer
                </a>
            </div>
        </section>

        <!-- Recent Agenda -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Agenda Terbaru</h2>
                <a href="{{ route('agenda.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Agenda yang akan datang dan sedang berlangsung.</p>
        </section>

        <!-- Recent Postingan -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Postingan/Berita Terbaru</h2>
                <a href="{{ route('postingan.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Berita dan postingan yang sudah dibuat.</p>
        </section>
    </div>
</x-layouts.pemda>