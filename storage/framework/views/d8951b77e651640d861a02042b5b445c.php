<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Profil Ormada','headerTitle' => 'Profil Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Ormada','headerTitle' => 'Profil Ormada']); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Profil Ormada','description' => 'Daftar ormada yang terdaftar. Pemda dan admin dapat melihat ringkasan seluruh ormada.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Ormada','description' => 'Daftar ormada yang terdaftar. Pemda dan admin dapat melihat ringkasan seluruh ormada.']); ?>
        <?php if(auth()->user()->isAdmin()): ?>
            <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('profil-ormada.create')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profil-ormada.create')).'']); ?>Tambah Profil <?php echo $__env->renderComponent(); ?>
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

                <div class="mt-4 flex items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('profil-ormada.show', $profil)).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profil-ormada.show', $profil)).'','variant' => 'secondary']); ?>Detail <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $attributes = $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $component = $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('profil-ormada.edit', $profil)).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profil-ormada.edit', $profil)).'','variant' => 'secondary']); ?>Edit <?php echo $__env->renderComponent(); ?>
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
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-8 text-sm text-zinc-600 md:col-span-2 xl:col-span-3">
                Belum ada profil ormada.
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-6"><?php echo e($profilOrmadas->links()); ?></div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH C:\project\magang\resources\views/profil_ormada/index.blade.php ENDPATH**/ ?>