
<?php $__env->startSection('content'); ?>

<?php
    $headline = $postingans->first();
?>


<!-- ====================================== -->
<!-- HERO NEWSPAPER -->
<!-- ====================================== -->

<section class="mt-4">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-4">

            
            
            

            <section class="xl:col-span-6">

                <div class="border border-gray-300">

                    <div class="border-b border-gray-300 py-2">

                        <h2 class="text-center text-xl font-black uppercase"
                            style="font-family:'Playfair Display',serif;">

                            Kalender Agenda

                        </h2>

                    </div>

                    <div id="calendar-public" style="height:360px;"></div>

                </div>

            </section>


            
            
            

            <?php if($aspirasis->isNotEmpty()): ?>

            <section class="xl:col-span-6">

                <h3 class="text-base font-black uppercase tracking-widest border-b border-gray-300 pb-2 mb-4"
                    style="font-family:'Playfair Display',serif;">

                    Aspirasi

                </h3>

                <div class="space-y-4">

                    <?php $__currentLoopData = $aspirasis->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <a href="<?php echo e(route('public.aspirasi.show',$aspirasi)); ?>"
                       class="block group pb-3 mb-3 border-b border-gray-200 last:border-b-0 last:pb-0 last:mb-0">

                        <div class="uppercase tracking-[3px] text-[10px] text-gray-500 font-bold">

                            <?php echo e($aspirasi->tanggapan_pemda ? 'DITANGGAPI' : 'MENUNGGU'); ?>


                        </div>

                        <h4 class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                            <?php echo e($aspirasi->topik_aspirasi); ?>


                        </h4>

                        <div class="mt-1 text-xs text-gray-500">

                            <?php echo e($aspirasi->profilOrmada->nama_universitas ?? '-'); ?>


                        </div>

                        <p class="mt-1 text-[11px] leading-5 text-gray-600 line-clamp-3">

                            <?php echo e(Str::limit(strip_tags($aspirasi->detail_aspirasi),90)); ?>


                        </p>

                        <div class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">

                            Lihat Selengkapnya →

                        </div>

                    </a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </aside>

            <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- ====================================== -->
<!-- Aspirasi -->
<!-- ====================================== -->

<section id="tmgnews" class="mt-5">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">

        <!-- Header -->
        <div class="border-b border-gray-300 pb-2 mb-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black uppercase tracking-wide"
                    style="font-family:'Playfair Display',serif;">
                    Aspirasi
                </h2>
                <a href="<?php echo e(route('public.postingan')); ?>"
                   class="text-[11px] font-semibold uppercase tracking-widest hover:text-blue-700 transition">
                    View All →
                </a>
            </div>
        </div>


        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <?php $__currentLoopData = $postingans->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <article class="group bg-white border border-gray-200 rounded-sm">

                <a href="<?php echo e(route('public.postingan.show',$postingan)); ?>">

                    <!-- Image -->
                    <?php if($postingan->foto): ?>
                    <div class="overflow-hidden">

                        <img
                            src="<?php echo e(storage_url($postingan->foto)); ?>"
                            alt="<?php echo e($postingan->judul); ?>"
                            class="w-full h-28 object-cover transition duration-500 group-hover:scale-105">

                    </div>
                    <?php endif; ?>


                    <!-- Content -->
                    <div class="p-3">

                        <!-- Category -->
                        <div class="uppercase tracking-[2px] text-[10px] font-bold text-gray-500 mb-2">

                            <?php echo e(strtoupper($postingan->jenis)); ?>


                        </div>


                        <!-- Title -->
                        <h3
                            class="text-base font-black leading-tight mb-1 group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                            <?php echo e($postingan->judul); ?>


                        </h3>


                        <!-- Summary -->
                        <p class="text-gray-600 leading-5 text-[11px] mb-2 line-clamp-2">

                            <?php echo e(Str::limit(strip_tags($postingan->isi_konten),120)); ?>


                        </p>


                        <!-- Footer -->
                        <div class="pt-2 border-t border-gray-200 flex items-center justify-between">

                            <span class="uppercase text-[10px] tracking-wider text-gray-500">

                                <?php echo e($postingan->tanggal_publish->format('d M Y')); ?>


                            </span>

                            <span
                                class="text-[11px] font-bold group-hover:translate-x-1 transition">

                                →

                            </span>

                        </div>

                    </div>

                </a>

            </article>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        </div>
    </div>
</section>

<!-- ====================================== -->
<!-- PROFIL ORMADA -->
<!-- ====================================== -->

<section id="profil" class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">

        <!-- Header -->
        <div class="border-b border-gray-300 pb-2 mb-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black uppercase"
                    style="font-family:'Playfair Display',serif;">

                    Profil Ormada

                </h2>
                <a href="<?php echo e(route('public.ormada')); ?>"
                   class="text-[11px] uppercase tracking-widest font-semibold hover:text-blue-700">

                    View All →

                </a>
            </div>
        </div>


        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

            <?php $__currentLoopData = $profilOrmadas->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <article class="group border border-gray-200 rounded-sm overflow-hidden">

                    <!-- Logo -->

                    <div class="overflow-hidden border-b border-gray-200">

                        <?php if($profil->logo): ?>

                            <img
                                src="<?php echo e(profil_logo_url($profil->logo)); ?>"
                                class="w-full h-36 object-cover transition duration-500 group-hover:scale-105">

                        <?php else: ?>

                            <div class="w-full h-36 bg-gray-100 flex items-center justify-center">

                                <span class="text-3xl font-black">

                                    <?php echo e(strtoupper(substr($profil->nama_universitas,0,2))); ?>


                                </span>

                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- Content -->

                    <div class="p-4">

                        <div class="uppercase text-[11px] tracking-[3px] font-bold text-gray-500">

                            ORGANISASI MAHASISWA

                        </div>

                        <h3
                            class="mt-2 text-base font-black leading-tight group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                            <?php echo e($profil->nama_universitas); ?>


                        </h3>

                        <p class="mt-1 text-[11px] text-gray-600 leading-5">

                            Memiliki
                            <strong><?php echo e(number_format($profil->anggota_count)); ?></strong>
                            anggota dan
                            <strong><?php echo e(number_format($profil->pengurus_count)); ?></strong>
                            pengurus aktif.

                        </p>

                        <a href="<?php echo e(route('public.ormada.show',$profil)); ?>"
                           class="inline-block mt-2 uppercase tracking-widest text-[11px] font-bold hover:text-blue-700">

                            Lihat Profil →

                        </a>

                    </div>

                </article>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>

        </div>
    </div>
</section>

<!-- ====================================== -->
<!-- AGENDA -->
<!-- ====================================== -->

<section id="agenda" class="mt-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border border-gray-300">

        <div class="border-b border-gray-300 pb-2 mb-3">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-black uppercase tracking-wide"
                    style="font-family:'Playfair Display',serif;">

                    Agenda

                </h2>
                <a href="<?php echo e(route('public.agenda')); ?>"
                   class="text-[11px] font-semibold uppercase tracking-widest hover:text-blue-700">

                    View All →

                </a>
            </div>
        </div>

        <?php
            $headlineAgenda = $agendas->first();
        ?>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-4">

            
            
            

            <div class="xl:col-span-8">

                <?php if($headlineAgenda): ?>

                <article class="border border-gray-200 rounded-sm overflow-hidden">

                    <?php if($headlineAgenda->gambar_poster): ?>

                        <img
                            src="<?php echo e(storage_url($headlineAgenda->gambar_poster)); ?>"
                            class="w-full h-48 object-cover">

                    <?php endif; ?>

                    <div class="p-4">

                        <div
                            class="uppercase tracking-[4px] text-xs font-bold text-gray-500">

                            <?php echo e(strtoupper($headlineAgenda->kategori)); ?>


                        </div>

                        <h2
                            class="mt-2 text-lg leading-tight font-black"
                            style="font-family:'Playfair Display',serif;">

                            <?php echo e($headlineAgenda->nama_agenda); ?>


                        </h2>

                        <p
                            class="mt-2 text-gray-600 text-xs leading-5">

                            <?php echo e(Str::limit(strip_tags($headlineAgenda->deskripsi_agenda),250)); ?>


                        </p>

                        <div
                            class="mt-3 flex gap-3 text-[11px] text-gray-500 uppercase tracking-widest">

                            <span>

                                📅
                                <?php echo e($headlineAgenda->waktu_mulai->format('d M Y')); ?>


                            </span>

                            <span>

                                📍
                                <?php echo e($headlineAgenda->tempat); ?>


                            </span>

                        </div>

                        <a
                            href="<?php echo e(route('public.agenda.show',$headlineAgenda)); ?>"
                            class="inline-block mt-3 text-[11px] font-bold uppercase tracking-widest hover:text-blue-700">

                            Detail Agenda →

                        </a>

                    </div>

                </article>

                <?php endif; ?>

            </div>

            
            
            

            <div class="xl:col-span-4 space-y-3">

                <?php $__currentLoopData = $agendas->skip(1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <article class="group border-b border-gray-300 pb-3">

                    <?php if($agenda->gambar_poster): ?>

                        <img
                            src="<?php echo e(storage_url($agenda->gambar_poster)); ?>"
                            class="w-full h-20 object-cover mb-2">

                    <?php endif; ?>

                    <div
                        class="uppercase tracking-[3px] text-[10px] font-bold text-gray-500">

                        <?php echo e(strtoupper($agenda->kategori)); ?>


                    </div>

                        <h3
                            class="mt-1 text-sm font-black leading-tight group-hover:text-blue-700 transition"
                            style="font-family:'Playfair Display',serif;">

                        <?php echo e($agenda->nama_agenda); ?>


                    </h3>

                        <p
                            class="mt-1 text-[11px] text-gray-600 leading-5 line-clamp-2">

                        <?php echo e(Str::limit(strip_tags($agenda->deskripsi_agenda),100)); ?>


                    </p>

                        <div
                            class="mt-1 text-[10px] uppercase tracking-widest text-gray-400">

                        <?php echo e($agenda->waktu_mulai->format('d M Y')); ?>


                    </div>

                </article>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

        </div>
    </div>
</section>

<footer class="mt-5 border-t pt-4 pb-4">
    <div class="text-center">
        <h2 class="text-2xl font-black">
            SI ORMADA TEMANGGUNG
        </h2>
        <p class="mt-2 text-gray-500 text-sm">
            Sistem Informasi Organisasi Mahasiswa Daerah Temanggung Lintas Kampus
        </p>
        <p class="mt-6 text-xs text-gray-400">
            © <?php echo e(date('Y')); ?> SI Ormada Temanggung
        </p>
    </div>
</footer>

</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    window.publicCalendarEvents = <?php echo json_encode($calendarEvents ?? [], 15, 512) ?>;
</script>

<!-- TEST -->

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/dashboard.blade.php ENDPATH**/ ?>