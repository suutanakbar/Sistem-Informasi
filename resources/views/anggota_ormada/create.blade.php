<x-layouts.app title="Tambah Anggota">
    <x-page-header title="Tambah Anggota" description="Tambahkan data anggota ke profil ormada.">
        <x-button-link href="{{ route('anggota-ormada.index') }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <form method="POST" action="{{ route('anggota-ormada.store') }}" class="rounded-lg border border-zinc-200 bg-white p-6">
        @csrf
        @include('anggota_ormada.partials.form')
    </form>
</x-layouts.app>
