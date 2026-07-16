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

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Anggota</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail lengkap data anggota ormada.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->nama_lengkap); ?></dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">NIM</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->nim); ?></dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Program Studi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->program_studi); ?></dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Status Aktif</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            <?php
                            $statusColors = [
                                'fungsionaris' => 'bg-purple-100 text-purple-800',
                                'mahasiswa' => 'bg-blue-100 text-blue-800',
                                'alumni' => 'bg-green-100 text-green-800',
                            ];
                            ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($statusColors[$anggotaOrmada->status_aktif] ?? 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e($anggotaOrmada->status_aktif_label); ?>

                            </span>
                        </dd>
                    </div>
                    <?php if($anggotaOrmada->is_pengurus === 'YA'): ?>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->jabatan ?? '-'); ?></dd>
                    </div>
                    <?php endif; ?>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">No HP</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->no_hp ?? '-'); ?></dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Masuk Kuliah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->tanggal_masuk_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_masuk_kuliah)->format('d/m/Y') : '-'); ?></dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Lulus Kuliah</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->tanggal_lulus_kuliah ? \Carbon\Carbon::parse($anggotaOrmada->tanggal_lulus_kuliah)->format('d/m/Y') : '-'); ?></dd>
                    </div>
                    <?php if($anggotaOrmada->tanggal_mulai_jabatan): ?>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Mulai Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->tanggal_mulai_jabatan->format('d/m/Y')); ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if($anggotaOrmada->tanggal_akhir_jabatan): ?>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Akhir Jabatan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->tanggal_akhir_jabatan->format('d/m/Y')); ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if($anggotaOrmada->tanggal_demisioner): ?>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Demisioner</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2"><?php echo e($anggotaOrmada->tanggal_demisioner->format('d/m/Y')); ?></dd>
                    </div>
                    <?php endif; ?>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Ormada</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            <a href="<?php echo e(route('profil-ormada.show', $anggotaOrmada->profilOrmada)); ?>" class="text-orange-600 hover:text-orange-900">
                                <?php echo e($anggotaOrmada->profilOrmada->nama_universitas); ?>

                            </a>
                        </dd>
                    </div>
                </dl>
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