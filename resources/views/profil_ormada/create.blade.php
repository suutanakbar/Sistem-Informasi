<x-layouts.app title="Tambah Profil Ormada">
    <x-page-header title="Tambah Profil Ormada" description="Lengkapi identitas ormada berdasarkan universitas.">
        <x-button-link href="{{ route('profil-ormada.index') }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <form method="POST" action="{{ route('profil-ormada.store') }}" enctype="multipart/form-data" class="rounded-lg border border-zinc-200 bg-white p-6">
        @csrf
        @include('profil_ormada.partials.form')
    </form>
</x-layouts.app>
