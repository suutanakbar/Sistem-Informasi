<x-layouts.app title="Edit Profil Ormada">
    <x-page-header title="Edit Profil Ormada" description="Perbarui identitas ormada dan logo bila diperlukan.">
        <x-button-link href="{{ route('profil-ormada.show', $profilOrmada) }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <form method="POST" action="{{ route('profil-ormada.update', $profilOrmada) }}" enctype="multipart/form-data" class="rounded-lg border border-zinc-200 bg-white p-6">
        @csrf
        @method('PUT')
        @include('profil_ormada.partials.form', ['profilOrmada' => $profilOrmada])
    </form>
</x-layouts.app>
