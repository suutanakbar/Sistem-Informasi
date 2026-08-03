
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

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 pb-16">
                <?php $__currentLoopData = $profilOrmadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="group bg-white border border-gray-200 rounded-sm hover:shadow-md transition-shadow">
                    <a href="<?php echo e(route('public.ormada.show', $profil)); ?>" class="block">
                        <?php if($profil->logo): ?>
                        <div class="w-full p-4 bg-gray-100 flex items-center justify-center">
                            <img src="<?php echo e(asset('storage/' . $profil->logo)); ?>" alt="<?php echo e($profil->nama_universitas); ?>" class="w-full h-auto object-contain object-center transition duration-500 group-hover:scale-105">
                        </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <!-- Badges -->
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 text-[10px] font-medium bg-blue-100 text-blue-800 rounded-full uppercase tracking-widest">
                                    Ormada
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-base font-black leading-tight mb-2 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                                <?php echo e($profil->nama_universitas); ?>

                            </h3>

                            <!-- Summary -->
                            <p class="text-gray-600 leading-5 text-xs mb-3 line-clamp-3">
                                <?php echo e(\Illuminate\Support\Str::limit(strip_tags($profil->deskripsi), 150)); ?>

                            </p>

                            <!-- Stats -->
                            <div class="flex items-center gap-4 text-[10px] text-gray-500 mb-2">
                                <span>👥 <?php echo e(number_format($profil->anggota_count)); ?> Anggota</span>
                                <span>⭐ <?php echo e(number_format($profil->pengurus_count)); ?> Pengurus</span>
                            </div>

                            <!-- Footer -->
                            <div class="mt-3 pt-2 border-t border-gray-200">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-blue-700 group-hover:text-blue-800 transition">
                                    Lihat Profil →
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-8">
                <?php echo e($profilOrmadas->links()); ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/ormada.blade.php ENDPATH**/ ?>