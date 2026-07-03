<x-layouts.app title="Edit Anggota">
    <x-page-header title="Edit Anggota" description="Perbarui data anggota ormada.">
        <x-button-link href="{{ route('anggota-ormada.show', $anggotaOrmada) }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <form method="POST" action="{{ route('anggota-ormada.update', $anggotaOrmada) }}" class="rounded-lg border border-zinc-200 bg-white p-6">
        @csrf
        @method('PUT')
        @include('anggota_ormada.partials.form', ['anggotaOrmada' => $anggotaOrmada])
    </form>
</x-layouts.app>
