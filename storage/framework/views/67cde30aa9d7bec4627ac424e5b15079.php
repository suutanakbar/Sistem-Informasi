<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Daftar Agenda','headerTitle' => 'Agenda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Agenda','headerTitle' => 'Agenda']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Agenda</h1>
            <a href="<?php echo e(route('agenda.create')); ?>" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                Buat Agenda
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="p-4">
                <form method="GET" action="<?php echo e(route('agenda.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" id="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Kategori</option>
                            <?php $__currentLoopData = $kategoriOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori); ?>" <?php echo e(request('kategori') === $kategori ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst(str_replace('_', ' ', $kategori))); ?>

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
            <?php $__empty_1 = true; $__currentLoopData = $agendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                <?php if($agenda->gambar_poster): ?>
                <img src="<?php echo e(asset('storage/' . $agenda->gambar_poster)); ?>" alt="<?php echo e($agenda->nama_agenda); ?>" class="w-full h-48 object-cover">
                <?php endif; ?>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            <?php echo e(ucfirst(str_replace('_', ' ', $agenda->kategori))); ?>

                        </span>
                        <?php if($agenda->is_published): ?>
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                            Published
                        </span>
                        <?php else: ?>
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                            Draft
                        </span>
                        <?php endif; ?>
                        <?php if($agenda->kuota_volunteer): ?>
                        <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                            Volunteer
                        </span>
                        <?php endif; ?>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2"><?php echo e($agenda->nama_agenda); ?></h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-3">
                        <?php echo e(Str::limit($agenda->deskripsi_agenda, 150)); ?>

                    </p>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span><?php echo e($agenda->waktu_mulai->format('d M Y H:i')); ?></span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span><?php echo e($agenda->tempat); ?></span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span><?php echo e($agenda->admin->nama); ?></span>
                        <span><?php echo e($agenda->dibuat_pada->format('d M Y')); ?></span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="<?php echo e(route('agenda.show', $agenda)); ?>" class="text-emerald-600 hover:text-emerald-800 text-sm">
                            Detail
                        </a>
                        <a href="<?php echo e(route('agenda.edit', $agenda)); ?>" class="text-blue-600 hover:text-blue-800 text-sm ml-3">
                            Edit
                        </a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $agenda)): ?>
                        <form method="POST" action="<?php echo e(route('agenda.destroy', $agenda)); ?>" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm ml-3">
                                Hapus
                            </button>
                        </form>
                        <?php endif; ?>
                        <?php if(!$agenda->is_published): ?>
                        <form method="POST" action="<?php echo e(route('agenda.publish', $agenda)); ?>" class="inline">
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
                <p class="text-gray-500">Belum ada agenda.</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-6">
            <?php echo e($agendas->links()); ?>

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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pemda/agenda/index.blade.php ENDPATH**/ ?>