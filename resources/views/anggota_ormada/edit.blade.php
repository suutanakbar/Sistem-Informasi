<x-layouts.app title="Edit Anggota Ormada">
    <x-page-header title="Edit Anggota Ormada" description="Perbarui data anggota">
        <x-button-link href="{{ route("anggota-ormada.show", $anggotaOrmada) }}" variant="secondary">Kembali ke Detail</x-button-link>
    </x-page-header>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="{{ route("anggota-ormada.update", $anggotaOrmada) }}">
                @csrf
                @method("PUT")
                @include("anggota_ormada.partials.form", ["anggotaOrmada" => $anggotaOrmada, "profilOrmadas" => $profilOrmadas])
            </form>
        </div>
    </div>
</x-layouts.app>