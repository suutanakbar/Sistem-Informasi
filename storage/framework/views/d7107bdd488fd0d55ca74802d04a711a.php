
<?php $__env->startSection('content'); ?>

<?php
    $headline = $postingans->first();
    $sideNews = $postingans->skip(1)->take(2);
    $gridNews = $postingans->skip(3)->take(4);
    $headlineAgenda = $agendas->first();
    $respondedAspirasi = $aspirasis->firstWhere('tanggapan_pemda', '!=', null) ?? $aspirasis->first();
?>





<section class="mt-4">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-b border-gray-300 pb-6">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                
                <div class="xl:col-span-2">
                    <?php if($headline): ?>
                        <a href="<?php echo e(route('public.postingan.show', $headline)); ?>" class="group block">
                            <div class="uppercase tracking-[3px] text-[10px] text-gray-500 font-bold">
                                <?php echo e(ucfirst($headline->jenis_konten ?? $headline->jenis)); ?>

                            </div>
                            <h1 class="mt-2 text-2xl xl:text-3xl font-black leading-tight group-hover:text-blue-700 transition"
                                style="font-family:'Playfair Display',serif;">
                                <?php echo e($headline->judul); ?>

                            </h1>
                            <?php if($headline->foto): ?>
                                <div class="mt-4 w-full bg-gray-100">
                                    <img src="<?php echo e(storage_url($headline->foto)); ?>" alt="<?php echo e($headline->judul); ?>"
                                         class="w-full h-64 object-cover">
                                </div>
                            <?php endif; ?>
                            <p class="mt-3 text-gray-600 text-sm leading-6">
                                <?php echo e(Str::limit(strip_tags($headline->isi_konten), 220)); ?>

                            </p>
                            <div class="mt-2 text-[10px] uppercase tracking-widest text-gray-400">
                                <?php echo e(($headline->tanggal_publish ?? $headline->dibuat_pada)->format('d M Y')); ?>

                            </div>
                        </a>
                    <?php else: ?>
                        <p class="text-sm text-gray-500">Belum ada berita.</p>
                    <?php endif; ?>
                </div>

                
                <div class="flex flex-col gap-4">

                    <?php if($headlineAgenda): ?>
                        <a href="<?php echo e(route('public.agenda.show', $headlineAgenda)); ?>" class="group block border border-gray-200 rounded-sm overflow-hidden">
                            <?php if($headlineAgenda->gambar_poster): ?>
                                <img src="<?php echo e(storage_url($headlineAgenda->gambar_poster)); ?>"
                                     class="w-full h-24 object-cover">
                            <?php endif; ?>
                            <div class="p-3">
                                <div class="uppercase tracking-[2px] text-[9px] text-gray-500 font-bold">
                                    Agenda Terdekat
                                </div>
                                <h3 class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                                    style="font-family:'Playfair Display',serif;">
                                    <?php echo e($headlineAgenda->nama_agenda); ?>

                                </h3>
                                <div class="mt-1 text-[10px] text-gray-500 uppercase tracking-widest">
                                    <?php echo e($headlineAgenda->waktu_mulai->format('d M Y')); ?> &middot; <?php echo e($headlineAgenda->tempat); ?>

                                </div>
                            </div>
                        </a>
                    <?php endif; ?>

                    <?php if($respondedAspirasi): ?>
                        <a href="<?php echo e(route('public.aspirasi.show', $respondedAspirasi)); ?>" class="group block border border-gray-200 rounded-sm p-3 bg-gray-50">
                            <div class="uppercase tracking-[2px] text-[9px] text-gray-500 font-bold">
                                <?php echo e($respondedAspirasi->tanggapan_pemda ? 'Aspirasi Ditanggapi' : 'Aspirasi Menunggu'); ?>

                            </div>
                            <h4 class="mt-1 text-xs font-black leading-tight group-hover:text-blue-700 transition"
                                style="font-family:'Playfair Display',serif;">
                                <?php echo e($respondedAspirasi->topik_aspirasi); ?>

                            </h4>
                            <div class="mt-1 text-[10px] text-gray-500">
                                <?php echo e($respondedAspirasi->profilOrmada->nama_universitas ?? '-'); ?>

                            </div>
                        </a>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>





<section class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-b border-gray-300 pb-6">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-black uppercase tracking-wide" style="font-family:'Playfair Display',serif;">
                    Terbaru
                </h2>
                <div class="flex gap-3 text-[10px] uppercase tracking-widest text-gray-500">
                    <a href="<?php echo e(route('public.postingan')); ?>" class="text-gray-900 font-bold">Semua</a>
                    <a href="<?php echo e(route('public.postingan', ['jenis' => 'berita'])); ?>" class="hover:text-blue-700 transition">Berita</a>
                    <a href="<?php echo e(route('public.agenda')); ?>" class="hover:text-blue-700 transition">Agenda</a>
                    <a href="<?php echo e(route('public.postingan', ['jenis' => 'prestasi'])); ?>" class="hover:text-blue-700 transition">Prestasi</a>
                </div>
            </div>

            <?php if($sideNews->isNotEmpty() || $gridNews->isNotEmpty()): ?>
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

                    <?php if($sideNews->isNotEmpty()): ?>
                        <?php $__currentLoopData = $sideNews->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('public.postingan.show', $item)); ?>" class="group xl:col-span-2 block border border-gray-200 rounded-sm overflow-hidden">
                                <?php if($item->foto): ?>
                                    <img src="<?php echo e(storage_url($item->foto)); ?>" alt="<?php echo e($item->judul); ?>"
                                         class="w-full h-40 object-cover">
                                <?php endif; ?>
                                <div class="p-3">
                                    <div class="uppercase tracking-[2px] text-[9px] text-gray-500 font-bold">
                                        <?php echo e(ucfirst($item->jenis_konten ?? $item->jenis)); ?>

                                    </div>
                                    <h3 class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                                        style="font-family:'Playfair Display',serif;">
                                        <?php echo e($item->judul); ?>

                                    </h3>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <div class="flex flex-col gap-3">
                        <?php $__currentLoopData = $sideNews->skip(1)->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('public.postingan.show', $item)); ?>" class="group flex gap-2 items-start">
                                <?php if($item->foto): ?>
                                    <img src="<?php echo e(storage_url($item->foto)); ?>" alt="<?php echo e($item->judul); ?>"
                                         class="w-14 h-14 object-cover rounded-sm flex-shrink-0">
                                <?php endif; ?>
                                <div class="text-xs font-bold leading-tight group-hover:text-blue-700 transition"
                                     style="font-family:'Playfair Display',serif;">
                                    <?php echo e($item->judul); ?>

                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            <?php else: ?>
                <p class="text-sm text-gray-500">Belum ada konten terbaru.</p>
            <?php endif; ?>

        </div>
    </div>
</section>





<section class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-b border-gray-300 pb-6">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                
                <div class="flex flex-col gap-4">
                    <div class="uppercase tracking-widest text-[11px] font-bold text-gray-500 border-b border-gray-200 pb-2">
                        Profil Ormada
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $profilOrmadas->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('public.ormada.show', $profil)); ?>" class="group flex gap-3 items-center">
                            <?php if($profil->logo): ?>
                                <img src="<?php echo e(profil_logo_url($profil->logo)); ?>" alt="<?php echo e($profil->nama_universitas); ?>"
                                     class="w-12 h-12 object-cover rounded-sm flex-shrink-0 border border-gray-200">
                            <?php else: ?>
                                <div class="w-12 h-12 bg-gray-100 rounded-sm flex items-center justify-center flex-shrink-0 border border-gray-200">
                                    <span class="text-xs font-black"><?php echo e(strtoupper(substr($profil->nama_universitas, 0, 2))); ?></span>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h3 class="text-xs font-black leading-tight group-hover:text-blue-700 transition"
                                    style="font-family:'Playfair Display',serif;">
                                    <?php echo e($profil->nama_universitas); ?>

                                </h3>
                                <p class="mt-0.5 text-[10px] text-gray-500">
                                    <?php echo e(number_format($profil->anggota_count)); ?> anggota
                                </p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-xs text-gray-500">Belum ada profil ormada.</p>
                    <?php endif; ?>
                </div>

                
                <div class="xl:col-span-2">
                    <?php $secondAgenda = $agendas->skip(1)->first(); ?>
                    <?php if($secondAgenda): ?>
                        <a href="<?php echo e(route('public.agenda.show', $secondAgenda)); ?>" class="group block">
                            <?php if($secondAgenda->gambar_poster): ?>
                                <img src="<?php echo e(storage_url($secondAgenda->gambar_poster)); ?>"
                                     class="w-full h-56 object-cover rounded-sm">
                            <?php endif; ?>
                            <div class="uppercase tracking-[3px] text-[10px] text-gray-500 font-bold mt-3">
                                <?php echo e(strtoupper($secondAgenda->kategori)); ?>

                            </div>
                            <h2 class="mt-1 text-xl font-black leading-tight group-hover:text-blue-700 transition"
                                style="font-family:'Playfair Display',serif;">
                                <?php echo e($secondAgenda->nama_agenda); ?>

                            </h2>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</section>





<section class="mt-6 mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">

            <?php if($gridNews->isNotEmpty()): ?>
                <?php $__currentLoopData = $gridNews->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.postingan.show', $item)); ?>" class="group block">
                        <?php if($item->foto): ?>
                            <img src="<?php echo e(storage_url($item->foto)); ?>" alt="<?php echo e($item->judul); ?>"
                                 class="w-full h-16 object-cover rounded-sm">
                        <?php endif; ?>
                        <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">
                            <?php echo e(ucfirst($item->jenis_konten ?? $item->jenis)); ?>

                        </div>
                        <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                             style="font-family:'Playfair Display',serif;">
                            <?php echo e(Str::limit($item->judul, 30)); ?>

                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($headlineAgenda): ?>
                <a href="<?php echo e(route('public.agenda.show', $headlineAgenda)); ?>" class="group block">
                    <?php if($headlineAgenda->gambar_poster): ?>
                        <img src="<?php echo e(storage_url($headlineAgenda->gambar_poster)); ?>"
                             class="w-full h-16 object-cover rounded-sm">
                    <?php endif; ?>
                    <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">Agenda</div>
                    <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                         style="font-family:'Playfair Display',serif;">
                        <?php echo e(Str::limit($headlineAgenda->nama_agenda, 30)); ?>

                    </div>
                </a>
            <?php endif; ?>

            <?php if($respondedAspirasi): ?>
                <a href="<?php echo e(route('public.aspirasi.show', $respondedAspirasi)); ?>" class="group block">
                    <div class="w-full h-16 bg-gray-100 rounded-sm flex items-center justify-center">
                        <span class="text-[9px] text-gray-400 uppercase tracking-widest">Aspirasi</span>
                    </div>
                    <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">Aspirasi</div>
                    <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                         style="font-family:'Playfair Display',serif;">
                        <?php echo e(Str::limit($respondedAspirasi->topik_aspirasi, 30)); ?>

                    </div>
                </a>
            <?php endif; ?>

            <?php $thirdProfil = $profilOrmadas->skip(2)->first(); ?>
            <?php if($thirdProfil): ?>
                <a href="<?php echo e(route('public.ormada.show', $thirdProfil)); ?>" class="group block">
                    <?php if($thirdProfil->logo): ?>
                        <img src="<?php echo e(profil_logo_url($thirdProfil->logo)); ?>"
                             class="w-full h-16 object-cover rounded-sm">
                    <?php else: ?>
                        <div class="w-full h-16 bg-gray-100 rounded-sm flex items-center justify-center">
                            <span class="text-sm font-black"><?php echo e(strtoupper(substr($thirdProfil->nama_universitas, 0, 2))); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">Ormada</div>
                    <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                         style="font-family:'Playfair Display',serif;">
                        <?php echo e(Str::limit($thirdProfil->nama_universitas, 30)); ?>

                    </div>
                </a>
            <?php endif; ?>

            <?php if($gridNews->count() > 1): ?>
                <?php $__currentLoopData = $gridNews->skip(1)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.postingan.show', $item)); ?>" class="group block">
                        <?php if($item->foto): ?>
                            <img src="<?php echo e(storage_url($item->foto)); ?>" alt="<?php echo e($item->judul); ?>"
                                 class="w-full h-16 object-cover rounded-sm">
                        <?php endif; ?>
                        <div class="mt-1 uppercase tracking-widest text-[9px] text-gray-500 font-bold">
                            <?php echo e(ucfirst($item->jenis_konten ?? $item->jenis)); ?>

                        </div>
                        <div class="text-[11px] font-bold leading-tight group-hover:text-blue-700 transition"
                             style="font-family:'Playfair Display',serif;">
                            <?php echo e(Str::limit($item->judul, 30)); ?>

                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/dashboard.blade.php ENDPATH**/ ?>