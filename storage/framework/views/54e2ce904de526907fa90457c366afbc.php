<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Agenda Saya','headerTitle' => 'Agenda Saya']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Agenda Saya','headerTitle' => 'Agenda Saya']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Agenda Saya</h1>
            <p class="text-sm text-gray-600 mt-1">Lihat dan kelola agenda yang Anda buat</p>
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
                        <span><?php echo e($agenda->dibuat_pada->format('d M Y')); ?></span>
                    </div>
                    <div class="mt-3 flex gap-2">
                        <a href="<?php echo e(route('agenda.show', $agenda)); ?>" class="text-orange-600 hover:text-orange-800 text-sm">
                            Lihat Detail →
                        </a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $agenda)): ?>
                        <form method="POST" action="<?php echo e(route('agenda.destroy', $agenda)); ?>" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                Hapus
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
<?php if (isset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $attributes = $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $component = $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pengurus/agenda/index.blade.php ENDPATH**/ ?>