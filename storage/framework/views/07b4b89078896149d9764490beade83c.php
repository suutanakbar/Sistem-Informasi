
<?php $__env->startSection('title', 'Aspirasi Ormada - SI Ormada Temanggung'); ?>
<?php $__env->startSection('content'); ?>
    <section>
        <div class="max-w-7xl mx-auto px-4">
            <div class="border-t border-b border-gray-300 py-3 mb-6">
                <h2 class="px-4 text-3xl font-black uppercase tracking-wide text-center"
                    style="font-family:'Playfair Display',serif;">
                    Aspirasi
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <?php $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="bg-white border border-gray-300 p-6">
                    <div class="uppercase tracking-[3px] text-[11px] font-bold text-gray-500 mb-3">
                        <?php echo e($aspirasi->dibuat_pada->format('d M Y')); ?>

                    </div>
                    <h3 class="text-xl font-black leading-tight mb-3"
                        style="font-family:'Playfair Display',serif;">
                        <a href="<?php echo e(route('public.aspirasi.show', $aspirasi)); ?>" class="hover:text-blue-700 transition">
                            <?php echo e($aspirasi->topik_aspirasi); ?>

                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 leading-6 mb-4">
                        <?php echo e(\Illuminate\Support\Str::limit(strip_tags($aspirasi->detail_aspirasi), 160)); ?>

                    </p>
                    <a href="<?php echo e(route('public.aspirasi.show', $aspirasi)); ?>" class="inline-block text-[11px] font-bold uppercase tracking-widest text-blue-700 hover:text-blue-800 transition">
                        Baca Selengkapnya →
                    </a>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/aspirasi.blade.php ENDPATH**/ ?>