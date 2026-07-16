<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Detail Anggota Ormada','headerTitle' => 'Detail Anggota Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Anggota Ormada','headerTitle' => 'Detail Anggota Ormada']); ?>
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <a href="<?php echo e(route('profil-ormada.show', $anggotaOrmada->profilOrmada)); ?>" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Profil Ormada</a>
                <a href="<?php echo e(route('anggota-ormada.edit', $anggotaOrmada)); ?>" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 text-sm">
                    Edit Anggota
                </a>
            </div>

            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid gap-5">
                        <div class="border border-zinc-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-zinc-900 mb-4">Biodata</h3>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Nama Lengkap</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->nama_lengkap); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">NIM</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->nim); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Tempat Lahir</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->tempat_lahir ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Tanggal Lahir</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->tanggal_lahir ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lahir)->format('d/m/Y') : '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Agama</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->agama ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Golongan Darah</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->golongan_darah ?? '-'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="border border-zinc-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-zinc-900 mb-4">Akademik</h3>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Program Studi</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->program_studi); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Fakultas</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->fakultas ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Angkatan</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->angkatan ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Status Aktif</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->status_aktif_label); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Tanggal Masuk Kuliah</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->tanggal_masuk_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_masuk_kuliah)->format('d/m/Y') : '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Tanggal Lulus Kuliah</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->tanggal_lulus_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lulus_kuliah)->format('d/m/Y') : '-'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="border border-zinc-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-zinc-900 mb-4">Kontak</h3>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Nomor HP</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->no_hp ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Email</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->email ?? '-'); ?></p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-zinc-500">Alamat</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->alamat ?? '-'); ?></p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-zinc-500">CV</p>
                                    <p class="mt-1 text-sm text-zinc-900">
                                        <?php if($anggotaOrmada->cv_path): ?>
                                            <a href="<?php echo e(asset('storage/' . $anggotaOrmada->cv_path)); ?>" target="_blank" class="text-orange-600 hover:text-orange-900">Lihat CV</a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <?php if($anggotaOrmada->is_pengurus === 'YA'): ?>
                        <div class="border border-zinc-200 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-zinc-900 mb-4">Pengurus</h3>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Jabatan</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->jabatan ?? '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Tanggal Mulai Jabatan</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->tanggal_mulai_jabatan ? $anggotaOrmada->tanggal_mulai_jabatan->format('d/m/Y') : '-'); ?></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-500">Tanggal Akhir Jabatan</p>
                                    <p class="mt-1 text-sm text-zinc-900"><?php echo e($anggotaOrmada->tanggal_akhir_jabatan ? $anggotaOrmada->tanggal_akhir_jabatan->format('d/m/Y') : '-'); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $attributes = $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $component = $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pengurus/anggota_ormada/show.blade.php ENDPATH**/ ?>