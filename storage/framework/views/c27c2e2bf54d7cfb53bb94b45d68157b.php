
<?php $__env->startSection('title', $aspirasi->topik_aspirasi . ' - SI Ormada Temanggung'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-white border-t border-gray-300 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <a href="<?php echo e(route('public.aspirasi')); ?>" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700 mb-6 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Aspirasi
            </a>
            <div class="max-w-4xl">
                <div class="mb-3">
                    <?php if($aspirasi->tanggapan_pemda): ?>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-green-700">Sudah Ditanggapi</span>
                    <?php else: ?>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-yellow-700">Menunggu Tanggapan</span>
                    <?php endif; ?>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight pb-4 mb-4 border-b border-gray-300" style="font-family:'Playfair Display',serif;"><?php echo e($aspirasi->topik_aspirasi); ?></h2>
                <div class="flex flex-wrap items-center gap-3 text-[10px] text-gray-500 uppercase tracking-widest">
                    <span>Oleh: <?php echo e($aspirasi->profilOrmada->nama_universitas ?? 'Unknown'); ?></span>
                    <span class="font-bold">•</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?php echo e($aspirasi->dibuat_pada->format('d M Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Aspirasi Detail -->
    <section class="bg-gray-50 py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200">
                <div class="p-6 sm:p-8">
                    <!-- Description -->
                    <div class="text-gray-700 whitespace-pre-line mb-8 text-base leading-relaxed">
                        <?php echo e($aspirasi->detail_aspirasi); ?>

                    </div>

                    <!-- Response from Pemda -->
                    <?php if($aspirasi->tanggapan_pemda): ?>
                    <div class="border border-gray-200 border-l-4 border-l-gray-900 p-6 mb-8">
                        <h3 class="text-[10px] font-bold uppercase tracking-wider text-gray-900 mb-2">Tanggapan Pemda</h3>
                        <p class="text-sm text-gray-700 whitespace-pre-line"><?php echo e($aspirasi->tanggapan_pemda); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Author Info -->
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <?php if($aspirasi->profilOrmada->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $aspirasi->profilOrmada->logo)); ?>" alt="<?php echo e($aspirasi->profilOrmada->nama_universitas); ?>" class="h-12 w-12 object-cover border border-gray-200">
                        <?php else: ?>
                        <div class="flex h-12 w-12 items-center justify-center bg-gray-900 text-sm font-bold text-white">
                            <?php echo e(strtoupper(substr($aspirasi->profilOrmada->nama_universitas ?? 'UN', 0, 2))); ?>

                        </div>
                        <?php endif; ?>
                        <div>
                            <p class="text-sm font-bold text-gray-900">Diajukan oleh</p>
                            <p class="text-sm text-gray-600"><?php echo e($aspirasi->profilOrmada->nama_universitas ?? 'Unknown'); ?></p>
                            <p class="text-xs text-gray-400"><?php echo e($aspirasi->dibuat_pada->format('d F Y H:i')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/aspirasi-show.blade.php ENDPATH**/ ?>