<x-layouts.app title="Dashboard">
    <x-page-header title="Dashboard" description="Ringkasan data sesuai peran akun yang sedang login.">
        @if (auth()->user()->isPengurusOrmada() && ! $profil)
            <x-button-link href="{{ route('profil-ormada.create') }}">Lengkapi Profil</x-button-link>
        @endif
    </x-page-header>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ([
            'Ormada' => $totalOrmada,
            'Anggota' => $totalAnggota,
            'Pengurus' => $totalPengurus,
            'Alumni' => $totalAlumni,
            'Demisioner' => $totalDemisioner,
        ] as $label => $value)
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">{{ $label }}</p>
                <p class="mt-2 text-2xl font-semibold">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <section class="mt-6 rounded-lg border border-zinc-200 bg-white p-6">
        <h2 class="font-semibold">Akses cepat</h2>
        <div class="mt-4 flex flex-wrap gap-2">
            <x-button-link href="{{ route('profil-ormada.index') }}" variant="secondary">Profil Ormada</x-button-link>
            <x-button-link href="{{ route('anggota-ormada.index') }}" variant="secondary">Anggota Ormada</x-button-link>
            <x-button-link href="{{ route('proposal.index') }}" variant="secondary">Proposal</x-button-link>
        </div>
    </section>
</x-layouts.app>
