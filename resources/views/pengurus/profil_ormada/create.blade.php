<x-layouts.pengurus title="Tambah Profil Ormada" headerTitle="Tambah Profil Ormada">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('profil-ormada.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali</a>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Tambah Profil Ormada</h1>
            <p class="mt-1 text-sm text-gray-600">Lengkapi identitas ormada berdasarkan universitas.</p>
        </div>

        <form method="POST" action="{{ route('profil-ormada.store') }}" enctype="multipart/form-data" class="rounded-lg border border-zinc-200 bg-white p-6">
            @csrf
            @include('profil_ormada.partials.form')
        </form>
    </div>
</div>
</x-layouts.pengurus>