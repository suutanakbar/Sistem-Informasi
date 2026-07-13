<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Daftar Ormada','headerTitle' => 'Daftar Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Ormada','headerTitle' => 'Daftar Ormada']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Ormada</h1>
            <p class="mt-1 text-sm text-gray-600">Daftar ormada yang terdaftar di wilayah Anda.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $profilOrmadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="rounded-lg border border-zinc-200 bg-white p-5">
                    <div class="flex items-start gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-md bg-zinc-100 text-sm font-semibold text-zinc-600">
                            <?php if($profil->logo): ?>
                                <img src="<?php echo e(asset('storage/'.$profil->logo)); ?>" alt="Logo <?php echo e($profil->nama_universitas); ?>" class="h-14 w-14 rounded-md object-cover">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr($profil->nama_universitas, 0, 2))); ?>

                            <?php endif; ?>
                        </div>
                        <div class="min-w-0">
                            <h2 class="font-semibold text-zinc-950"><?php echo e($profil->nama_universitas); ?></h2>
                            <p class="mt-1 text-sm text-zinc-600"><?php echo e($profil->alamat_universitas); ?></p>
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                        <div class="rounded-md bg-zinc-50 p-3">
                            <p class="text-zinc-500">Anggota</p>
                            <p class="mt-1 text-lg font-semibold"><?php echo e($profil->anggota_count); ?></p>
                        </div>
                        <div class="rounded-md bg-zinc-50 p-3">
                            <p class="text-zinc-500">Pengurus</p>
                            <p class="mt-1 text-lg font-semibold"><?php echo e($profil->pengurus_count); ?></p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="<?php echo e(route('profil-ormada.show', $profil)); ?>" class="inline-flex items-center justify-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                            Detail
                        </a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-8 text-sm text-zinc-600 md:col-span-2 xl:col-span-3">
                    Belum ada profil ormada.
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-6"><?php echo e($profilOrmadas->links()); ?></div>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $attributes = $__attributesOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $component = $__componentOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__componentOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pemda/profil_ormada/index.blade.php ENDPATH**/ ?>