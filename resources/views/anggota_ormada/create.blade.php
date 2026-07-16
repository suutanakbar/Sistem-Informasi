<x-layouts.app title="Tambah Anggota Ormada">
    <x-page-header title="Tambah Anggota Ormada" description="Isi form berikut untuk menambahkan anggota baru">
        <x-button-link href="{{ route('profil-ormada.index') }}" variant="secondary">Kembali</x-button-link>
    </x-page-header>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="{{ route('anggota-ormada.store') }}" enctype="multipart/form-data">
                @csrf
                @include('anggota_ormada.partials.form', ['anggotaOrmada' => null, 'profilOrmadas' => $profilOrmadas])
            </form>
        </div>
    </div>
</x-layouts.app>
