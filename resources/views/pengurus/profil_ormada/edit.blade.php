<x-layouts.pengurus title="Edit Profil Ormada" headerTitle="Edit Profil Ormada">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('profil-ormada.show', $profilOrmada) }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Detail</a>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Profil Ormada</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui identitas ormada dan logo bila diperlukan.</p>
        </div>

        <form method="POST" action="{{ route('profil-ormada.update', $profilOrmada) }}" enctype="multipart/form-data" class="rounded-lg border border-zinc-200 bg-white p-6">
            @csrf
            @method('PUT')
            @include('profil_ormada.partials.form', ['profilOrmada' => $profilOrmada])
        </form>
    </div>
</div>
</x-layouts.pengurus>