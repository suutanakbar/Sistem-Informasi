<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => ''.e($postingan->judul).'','headerTitle' => 'Detail Postingan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($postingan->judul).'','headerTitle' => 'Detail Postingan']); ?>
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Postingan</h1>
            <div class="flex gap-2">
                <a href="<?php echo e(route('postingan.edit', $postingan)); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Edit Postingan
                </a>
                <a href="<?php echo e(route('postingan.index')); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <?php if($postingan->foto): ?>
                <img src="<?php echo e(asset('storage/' . $postingan->foto)); ?>" alt="<?php echo e($postingan->judul); ?>" class="w-full h-96 object-cover rounded-lg mb-6">
                <?php endif; ?>

                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                        <?php echo e(ucfirst($postingan->jenis_konten)); ?>

                    </span>
                    <?php if($postingan->is_published): ?>
                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                        Published
                    </span>
                    <?php else: ?>
                    <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                        Draft
                    </span>
                    <?php endif; ?>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-4"><?php echo e($postingan->judul); ?></h2>

                <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-200">
                    <span>Oleh: <?php echo e($postingan->admin->nama); ?></span>
                    <span>•</span>
                    <span><?php echo e($postingan->dibuat_pada->format('d F Y H:i')); ?></span>
                    <?php if($postingan->tanggal_publish): ?>
                    <span>•</span>
                    <span>Dipublikasi: <?php echo e($postingan->tanggal_publish->format('d F Y H:i')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    <?php echo e($postingan->isi_konten); ?>

                </div>
            </div>
        </div>

        <?php if(!$postingan->is_published): ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-sm text-yellow-800 mb-3">Postingan ini masih dalam status draft.</p>
            <form method="POST" action="<?php echo e(route('postingan.publish', $postingan)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Publikasikan Postingan
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/admin/postingan/show.blade.php ENDPATH**/ ?>