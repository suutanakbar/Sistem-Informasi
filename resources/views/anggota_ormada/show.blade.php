<x-layouts.app title="Detail Anggota Ormada">
    <x-page-header title="{{ $anggotaOrmada->nama_lengkap }}" description="{{ $anggotaOrmada->profilOrmada->nama_universitas }}">
        @if(auth()->user()->isAdmin() || auth()->user()->isPengurusOrmada())
            <x-button-link href="{{ route('anggota-ormada.edit', $anggotaOrmada) }}">Edit Anggota</x-button-link>
        @endif
    </x-page-header>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="grid gap-5">
                <div class="border border-zinc-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-zinc-900 mb-4">Biodata</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Nama Lengkap</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">NIM</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->nim }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">NIK</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->nik ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Tempat Lahir</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->tempat_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Tanggal Lahir</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->tanggal_lahir ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lahir)->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Agama</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->agama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Golongan Darah</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->golongan_darah ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="border border-zinc-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-zinc-900 mb-4">Akademik</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Program Studi</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->program_studi }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Fakultas</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->fakultas ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Angkatan</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->angkatan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Status Aktif</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->status_aktif_label }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Tanggal Masuk Kuliah</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->tanggal_masuk_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_masuk_kuliah)->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Tanggal Lulus Kuliah</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->tanggal_lulus_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lulus_kuliah)->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="border border-zinc-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-zinc-900 mb-4">Kontak</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Nomor HP</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->no_hp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Email</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->email ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-medium text-zinc-500">Alamat</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->alamat ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm font-medium text-zinc-500">CV</p>
                            <p class="mt-1 text-sm text-zinc-900">@if($anggotaOrmada->cv_path)
                                <a href="{{ asset('storage/' . $anggotaOrmada->cv_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat CV</a>
                                @else
                                -
                                @endif</p>
                        </div>
                    </div>
                </div>

                @if($anggotaOrmada->is_pengurus === 'YA')
                <div class="border border-zinc-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-zinc-900 mb-4">Pengurus</h3>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Jabatan</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->jabatan ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Tanggal Mulai Jabatan</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->tanggal_mulai_jabatan ? $anggotaOrmada->tanggal_mulai_jabatan->format('d/m/Y') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-500">Tanggal Akhir Jabatan</p>
                            <p class="mt-1 text-sm text-zinc-900">{{ $anggotaOrmada->tanggal_akhir_jabatan ? $anggotaOrmada->tanggal_akhir_jabatan->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('profil-ormada.show', $anggotaOrmada->profilOrmada) }}" class="text-indigo-600 hover:text-indigo-900">
            &larr; Kembali ke Profil Ormada
        </a>
    </div>
</x-layouts.app>