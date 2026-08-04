
<?php $__env->startSection('title', 'Profil Ormada - SI Ormada Temanggung'); ?>
<?php $__env->startSection('content'); ?>
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4">

            <div class="border-t border-b border-gray-300 py-8 mb-12">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-2">EDISI 005 / 2026</div>
                        <h1 class="text-4xl lg:text-5xl font-black uppercase" style="font-family:'Playfair Display',serif;">Profil Ormada</h1>
                    </div>
                    <p class="hidden lg:block text-sm text-gray-600 max-w-sm text-right">
                        Daftar organisasi mahasiswa yang terdaftar dalam sistem SI Ormada.
                    </p>
                </div>
            </div>

            <div class="border-b border-gray-300">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 divide-x divide-y divide-gray-200">
                    <?php $__currentLoopData = $profilOrmadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="group">
                        <a href="<?php echo e(route('public.ormada.show', $profil)); ?>" class="block p-6">

                            <!-- Meta atas -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold uppercase tracking-[2px] text-gray-500">
                                    <?php echo e($profil->created_at?->translatedFormat('d. F Y') ?? '—'); ?>

                                </span>
                                <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider border border-gray-300 text-gray-700">
                                    Ormada
                                </span>
                            </div>

                            <!-- Logo -->
                            <?php if($profil->logo || $profil->hover_image): ?>
                            <div class="w-full aspect-[4/3] mb-4 bg-gray-100 overflow-hidden relative">
                                <?php if($profil->logo): ?>
                                <img src="<?php echo e(asset('storage/' . $profil->logo)); ?>" alt="<?php echo e($profil->nama_universitas); ?>" class="w-full h-full object-contain transition-all duration-500 group-hover:opacity-0">
                                <?php endif; ?>
                                <?php if($profil->hover_image): ?>
                                <img src="<?php echo e(asset('storage/' . $profil->hover_image)); ?>" alt="<?php echo e($profil->nama_universitas); ?> - Universitas" class="absolute inset-0 w-full h-full object-contain p-4 opacity-0 transition-all duration-500 group-hover:opacity-100">
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <!-- Title -->
                            <h3 class="text-lg font-black uppercase leading-tight tracking-tight mb-2 group-hover:text-blue-700 transition">
                                <?php echo e($profil->nama_universitas); ?>

                            </h3>

                            <!-- Summary -->
                            <p class="text-xs text-gray-600 leading-5 mb-4 line-clamp-3">
                                <?php echo e(\Illuminate\Support\Str::limit(strip_tags($profil->deskripsi), 150)); ?>

                            </p>

                            <!-- Stats -->
                            <div class="flex items-center gap-5 text-[10px] uppercase tracking-wider text-gray-500 pt-4 border-t border-gray-200">
                                <span><span class="font-bold text-gray-800">Anggota</span> <?php echo e(number_format($profil->anggota_count)); ?></span>
                                <span><span class="font-bold text-gray-800">Pengurus</span> <?php echo e(number_format($profil->pengurus_count)); ?></span>
                            </div>

                        </a>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="mt-8">
                <?php echo e($profilOrmadas->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/ormada.blade.php ENDPATH**/ ?>