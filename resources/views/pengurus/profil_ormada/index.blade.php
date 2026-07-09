<x-layouts.pengurus title="Profil Ormada" headerTitle="Profil Ormada">
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Profil Ormada</h1>
            <p class="mt-1 text-sm text-gray-600">Profil ormada yang Anda kelola.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($profilOrmadas as $profil)
                <article class="rounded-lg border border-zinc-200 bg-white p-5">
                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-zinc-100 text-sm font-semibold text-zinc-600">
                            @if ($profil->logo)
                                <img src="{{ asset('storage/'.$profil->logo) }}" alt="Logo {{ $profil->nama_universitas }}" class="h-14 w-14 rounded-md object-cover">
                            @else
                                {{ strtoupper(substr($profil->nama_universitas, 0, 2)) }}
                            @endif
                        </div>
                        <div class="min-w-0">
                            <h2 class="font-semibold text-zinc-950">{{ $profil->nama_universitas }}</h2>
                            <p class="mt-1 text-sm text-zinc-600">{{ $profil->alamat_universitas }}</p>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-md bg-zinc-50 p-3">
                            <p class="text-zinc-500">Anggota</p>
                            <p class="mt-1 text-lg font-semibold">{{ $profil->anggota_count }}</p>
                        </div>
                        <div class="rounded-md bg-zinc-50 p-3">
                            <p class="text-zinc-500">Pengurus</p>
                            <p class="mt-1 text-lg font-semibold">{{ $profil->pengurus_count }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('profil-ormada.show', $profil) }}" class="inline-flex items-center justify-center rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
                            Detail
                        </a>
                    </div>
                </article>
            @empty
                <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-8 text-sm text-zinc-600 md:col-span-2 xl:col-span-3">
                    Belum ada profil ormada. <a href="{{ route('profil-ormada.create') }}" class="text-orange-600 hover:text-orange-800">Buat profil ormada</a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">{{ $profilOrmadas->links() }}</div>
    </div>
</div>
</x-layouts.pengurus>