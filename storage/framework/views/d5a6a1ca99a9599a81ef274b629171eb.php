<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Detail Anggota Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Anggota Ormada']); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => ''.e($anggotaOrmada->nama_lengkap).'','description' => ''.e($anggotaOrmada->profilOrmada->nama_universitas).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($anggotaOrmada->nama_lengkap).'','description' => ''.e($anggotaOrmada->profilOrmada->nama_universitas).'']); ?>
        <?php if(auth()->user()->isAdmin() || auth()->user()->isPengurusOrmada()): ?>
            <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('anggota-ormada.edit', $anggotaOrmada)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('anggota-ormada.edit', $anggotaOrmada)).'']); ?>Edit Anggota <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $attributes = $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $component = $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

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
                            <p class="mt-1 text-sm text-zinc-900"><?php if($anggotaOrmada->cv_path): ?>
                                <a href="<?php echo e(asset('storage/' . $anggotaOrmada->cv_path)); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat CV</a>
                                <?php else: ?>
                                -
                                <?php endif; ?></p>
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

    <div class="mt-6">
        <a href="<?php echo e(route('profil-ormada.show', $anggotaOrmada->profilOrmada)); ?>" class="text-indigo-600 hover:text-indigo-900">
            &larr; Kembali ke Profil Ormada
        </a>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/anggota_ormada/show.blade.php ENDPATH**/ ?>