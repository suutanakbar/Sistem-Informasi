<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Daftar Postingan','headerTitle' => 'Postingan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Postingan','headerTitle' => 'Postingan']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Postingan</h1>
            <a href="<?php echo e(route('postingan.create')); ?>" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                Buat Postingan
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="p-4">
                <form method="GET" action="<?php echo e(route('postingan.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="jenis_konten" class="block text-sm font-medium text-gray-700">Jenis Konten</label>
                        <select name="jenis_konten" id="jenis_konten" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Jenis</option>
                            <?php $__currentLoopData = $jenisOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($jenis); ?>" <?php echo e(request('jenis_konten') === $jenis ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst($jenis)); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
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
                        <span><?php echo e($postingan->admin->nama); ?></span>
                        <span><?php echo e($postingan->dibuat_pada->format('d M Y')); ?></span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="<?php echo e(route('postingan.show', $postingan)); ?>" class="text-emerald-600 hover:text-emerald-800 text-sm">
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
                        <?php if(!$postingan->is_published): ?>
                        <form method="POST" action="<?php echo e(route('postingan.publish', $postingan)); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="text-green-600 hover:text-green-800 text-sm ml-3">
                                Publish
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
<?php if (isset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $attributes = $__attributesOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $component = $__componentOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__componentOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pemda/postingan/index.blade.php ENDPATH**/ ?>