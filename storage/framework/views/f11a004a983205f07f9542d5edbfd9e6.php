<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Postingan Saya','headerTitle' => 'Postingan Saya']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Postingan Saya','headerTitle' => 'Postingan Saya']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Postingan Saya</h1>
            <a href="<?php echo e(route('postingan.create')); ?>" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                Buat Postingan
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $postingans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                <?php if($postingan->foto): ?>
                <img src="<?php echo e(asset('storage/' . $postingan->foto)); ?>" alt="<?php echo e($postingan->judul); ?>" class="w-full h-48 object-cover">
                <?php endif; ?>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                            <?php echo e(ucfirst($postingan->jenis_konten)); ?>

                        </span>
                        <?php if($postingan->is_published): ?>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Published
                        </span>
                        <?php else: ?>
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            Draft
                        </span>
                        <?php endif; ?>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2"><?php echo e($postingan->judul); ?></h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                        <?php echo e(Str::limit($postingan->isi_konten, 150)); ?>

                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span><?php echo e($postingan->dibuat_pada->format('d M Y')); ?></span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="<?php echo e(route('postingan.show', $postingan)); ?>" class="text-orange-600 hover:text-orange-800 text-sm">
                            Detail
                        </a>
                        <a href="<?php echo e(route('postingan.edit', $postingan)); ?>" class="text-blue-600 hover:text-blue-800 text-sm ml-3">
                            Edit
                        </a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $postingan)): ?>
                        <form method="POST" action="<?php echo e(route('postingan.destroy', $postingan)); ?>" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm ml-3">
                                Hapus
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Belum ada postingan.</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-6">
            <?php echo e($postingans->links()); ?>

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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pengurus/postingan/index.blade.php ENDPATH**/ ?>