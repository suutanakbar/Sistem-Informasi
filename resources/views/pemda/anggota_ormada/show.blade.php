<x-layouts.pemda title="Detail Anggota Ormada" headerTitle="Detail Anggota Ormada">
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('profil-ormada.show', $anggotaOrmada->profilOrmada) }}" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Profil Ormada</a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Anggota</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail lengkap data anggota ormada.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->nama_lengkap }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">NIM</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->nim }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Program Studi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->program_studi }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Fakultas</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->fakultas ?? '-' }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Angkatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->angkatan ?? '-' }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">CV</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($anggotaOrmada->cv_path)
                                <a href="{{ asset('storage/' . $anggotaOrmada->cv_path) }}" target="_blank" class="text-emerald-600 hover:text-emerald-900">Lihat CV</a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->email ?? '-' }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->alamat ?? '-' }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tempat_lahir ?? '-' }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tanggal_lahir ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lahir)->format('d/m/Y') : '-' }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Agama</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->agama ?? '-' }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Golongan Darah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->golongan_darah ?? '-' }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Status Aktif</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @php
                            $statusColors = [
                                'fungsionaris' => 'bg-purple-100 text-purple-800',
                                'mahasiswa' => 'bg-blue-100 text-blue-800',
                            ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$anggotaOrmada->status_aktif] ?? 'bg-blue-100 text-blue-800' }}">
                                {{ $anggotaOrmada->status_aktif_label }}
                            </span>
                        </dd>
                    </div>
                    @if($anggotaOrmada->is_pengurus === 'YA')
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->jabatan ?? '-' }}</dd>
                    </div>
                    @endif
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">No HP</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->no_hp ?? '-' }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Masuk Kuliah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tanggal_masuk_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_masuk_kuliah)->format('d/m/Y') : '-' }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Lulus Kuliah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tanggal_lulus_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lulus_kuliah)->format('d/m/Y') : '-' }}</dd>
                    </div>
                    @if($anggotaOrmada->tanggal_mulai_jabatan)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Mulai Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tanggal_mulai_jabatan->format('d/m/Y') }}</dd>
                    </div>
                    @endif
                    @if($anggotaOrmada->tanggal_akhir_jabatan)
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Akhir Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tanggal_akhir_jabatan->format('d/m/Y') }}</dd>
                    </div>
                    @endif
                    @if($anggotaOrmada->tanggal_demisioner)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Demisioner</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->tanggal_demisioner->format('d/m/Y') }}</dd>
                    </div>
                    @endif
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Ormada</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            <a href="{{ route('profil-ormada.show', $anggotaOrmada->profilOrmada) }}" class="text-emerald-600 hover:text-emerald-900">
                                {{ $anggotaOrmada->profilOrmada->nama_universitas }}
                            </a>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
</x-layouts.pemda>