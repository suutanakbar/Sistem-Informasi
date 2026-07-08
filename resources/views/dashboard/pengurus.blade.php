<x-layouts.pengurus title="Dashboard Pengurus" headerTitle="Dashboard Pengurus Ormada">
    <div class="space-y-6">
        <!-- Welcome Message -->
        <div class="rounded-lg border border-orange-200 bg-orange-50 p-6">
            <h2 class="text-lg font-semibold text-orange-900">Selamat Datang, {{ auth()->user()->nama }}!</h2>
            <p class="mt-2 text-sm text-orange-700">
                @if(auth()->user()->profilOrmada)
                    Anda login sebagai Pengurus Ormada <strong>{{ auth()->user()->profilOrmada->nama_ormada }}</strong>.
                @else
                    Anda login sebagai Pengurus Ormada. Silakan lengkapi profil ormada Anda.
                @endif
            </p>
        </div>

        @if(!auth()->user()->profilOrmada)
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                <p class="text-sm text-yellow-800">Anda belum memiliki profil ormada. 
                    <a href="{{ route('profil-ormada.create') }}" class="font-medium underline">Klik di sini untuk membuat profil</a>.
                </p>
            </div>
        @endif

        <!-- Statistics -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Anggota</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($totalAnggota ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Pengurus</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($totalPengurus ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Alumni</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($totalAlumni ?? 0) }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Proposal Saya</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($totalProposal ?? 0) }}</p>
            </div>
        </div>

        <!-- Agenda from Pemda -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Agenda dari Pemerintah Daerah</h2>
                <a href="{{ route('agenda.index') }}" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Agenda kegiatan yang dibuat oleh Pemerintah Daerah. Anda dapat melihat detail dan mendaftar volunteer.</p>
        </section>

        <!-- Volunteer Section -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Volunteer</h2>
                <a href="{{ route('volunteer.index') }}" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Daftar volunteer yang tersedia dan status pendaftaran Anda.</p>
            <div class="mt-4">
                <a href="{{ route('volunteer.index') }}" class="rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
                    Lihat & Daftar Volunteer
                </a>
            </div>
        </section>

        <!-- My Postingan -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Postingan/Berita Saya</h2>
                <a href="{{ route('postingan.index') }}" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Kelola postingan dan berita untuk ormada Anda.</p>
            <div class="mt-4">
                <a href="{{ route('postingan.create') }}" class="rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
                    Buat Postingan Baru
                </a>
            </div>
        </section>

        <!-- My Proposal -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Proposal Saya</h2>
                <a href="{{ route('proposal.index') }}" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Kelola proposal yang telah Anda ajukan.</p>
            <div class="mt-4">
                <a href="{{ route('proposal.create') }}" class="rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
                    Buat Proposal Baru
                </a>
            </div>
        </section>
    </div>
</x-layouts.pengurus>