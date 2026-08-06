
<?php $__env->startSection('title', $postingan->judul . ' - SI Ormada Temanggung'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-white border-t border-b border-gray-300 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="<?php echo e(route('public.postingan')); ?>" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700 mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Berita & Pengumuman
            </a>
            <div class="max-w-4xl">
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                        <?php echo e(ucfirst($postingan->jenis_konten)); ?>

                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight mb-3" style="font-family:'Playfair Display',serif;"><?php echo e($postingan->judul); ?></h2>
                <div class="flex flex-wrap items-center gap-3 text-[10px] text-gray-500 uppercase tracking-widest">
                    <span>Oleh: <?php echo e($postingan->admin->nama); ?></span>
                    <span class="font-bold">•</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?php echo e($postingan->tanggal_publish->format('d M Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Postingan Detail -->
    <section class="bg-white py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="border border-gray-200 rounded-sm overflow-hidden hover:shadow-md transition-shadow">
                <?php if($postingan->foto): ?>
                <div class="w-full p-4 bg-gray-100 flex items-center justify-center">
                    <img src="<?php echo e(storage_url($postingan->foto)); ?>" alt="<?php echo e($postingan->judul); ?>" class="w-full h-auto object-contain object-center">
                </div>
                <?php endif; ?>
                <div class="p-4 sm:p-6">
                    <!-- Badges -->
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                            <?php echo e(ucfirst($postingan->jenis_konten ?? $postingan->jenis)); ?>

                        </span>
                        <?php if($postingan->is_published): ?>
                        <span class="px-2 py-1 text-[10px] font-medium bg-green-100 text-green-800 rounded-full">Published</span>
                        <?php else: ?>
                        <span class="px-2 py-1 text-[10px] font-medium bg-yellow-100 text-yellow-800 rounded-full">Draft</span>
                        <?php endif; ?>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl font-black leading-tight mb-4" style="font-family:'Playfair Display',serif;">
                        <?php echo e($postingan->judul); ?>

                    </h2>

                    <!-- Date & Author -->
                    <div class="flex flex-wrap items-center gap-3 text-[10px] text-gray-500 mb-4 uppercase tracking-widest">
                        <div class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <?php echo e($postingan->tanggal_publish->format('d M Y')); ?>

                        </div>
                        <span class="font-bold uppercase tracking-wider">• <?php echo e($postingan->admin->nama); ?></span>
                    </div>

                    <!-- Full Content -->
                    <div class="text-gray-700 whitespace-pre-line leading-relaxed text-sm sm:text-base">
                        <?php echo e($postingan->isi_konten); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/postingan-show.blade.php ENDPATH**/ ?>