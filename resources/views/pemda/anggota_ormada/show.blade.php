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
                        <dt class="text-sm font-medium text-gray-500">Status Aktif</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @php
                            $statusColors = [
                                'fungsionaris' => 'bg-purple-100 text-purple-800',
                                'mahasiswa' => 'bg-blue-100 text-blue-800',
                                'alumni' => 'bg-green-100 text-green-800',
                            ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$anggotaOrmada->status_aktif] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $anggotaOrmada->status_aktif_label }}
                            </span>
                        </dd>
                    </div>
                    @if($anggotaOrmada->is_pengurus === 'YA' && $anggotaOrmada->jabatan)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $anggotaOrmada->jabatan }}</dd>
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
                    @if($anggotaOrmada->is_pengurus === 'YA' && $anggotaOrmada->tanggal_mulai_jabatan)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Mulai Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ \Carbon\Carbon::parse($anggotaOrmada->tanggal_mulai_jabatan)->format('d/m/Y') }}</dd>
                    </div>
                    @endif
                    @if($anggotaOrmada->is_pengurus === 'YA' && $anggotaOrmada->tanggal_akhir_jabatan)
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Akhir Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ \Carbon\Carbon::parse($anggotaOrmada->tanggal_akhir_jabatan)->format('d/m/Y') }}</dd>
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