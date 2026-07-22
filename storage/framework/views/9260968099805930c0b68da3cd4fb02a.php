
<?php $__env->startSection('content'); ?>
<section class="mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between border-b-2 border-black pb-3 mb-6">
            <div class="flex-1 border-t border-black"></div>
            <h2 class="px-6 text-3xl font-black uppercase tracking-wide text-center"
                style="font-family:'Playfair Display',serif;">
                Pengumuman
            </h2>
            <div class="flex-1 border-t border-black"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $pengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="group bg-white border border-gray-300">
                <a href="<?php echo e(route('public.pengumuman.show', $item)); ?>" class="block">
                    <?php if($item->foto): ?>
                    <div class="overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-48 object-cover transition duration-500 group-hover:scale-105">
                    </div>
                    <?php endif; ?>
                    <div class="p-5">
                        <div class="uppercase tracking-[3px] text-[10px] font-bold text-gray-500 mb-2">
                            <?php echo e($item->tanggal_publish->format('d M Y')); ?>

                        </div>
                        <h3 class="text-xl font-black leading-tight mb-2 group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">
                            <?php echo e($item->judul); ?>

                        </h3>
                        <p class="text-gray-600 leading-6 text-sm line-clamp-3">
                            <?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->isi), 160)); ?>

                        </p>
                        <div class="mt-3 text-xs font-bold uppercase tracking-widest text-blue-700">
                            Baca Selengkapnya →
                        </div>
                    </div>
                </a>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="md:col-span-2 xl:col-span-3 text-center text-gray-500 py-10">
                Belum ada pengumuman.
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-8">
            <?php echo e($pengumumans->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/pengumuman.blade.php ENDPATH**/ ?>