<?php $__env->startSection('content'); ?>

<?php
    $headline = $postingans->first();
?>


<!-- ========================= -->
<!-- THREE COLUMN: PENGUMUMAN | CALENDAR | ASPIRASI -->
<!-- ========================= -->

<section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Pengumuman -->
    <?php if($postingans->isNotEmpty()): ?>
    <div class="lg:col-span-1">
        <div class="border border-gray-200 bg-white p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-black text-xl border-b pb-2">
                    Pengumuman
                </h3>
                <a href="<?php echo e(route('public.postingan')); ?>" class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                    Lihat Semua
                </a>
            </div>
            <div class="space-y-4">
                <?php $__currentLoopData = $postingans->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.postingan.show', $postingan)); ?>" class="block group">
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-start gap-3">
                            <?php if($postingan->foto): ?>
                            <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden bg-gray-100">
                                <img src="<?php echo e(storage_url($postingan->foto)); ?>" alt="<?php echo e($postingan->judul); ?>" class="w-full h-full object-cover">
                            </div>
                            <?php endif; ?>
                            <div class="flex-1 min-w-0">
                                <span class="inline-block text-xs font-medium px-2 py-1 rounded-full bg-blue-50 text-blue-700 mb-2">
                                    <?php echo e(ucfirst($postingan->jenis)); ?>

                                </span>
                                <h4 class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition line-clamp-2">
                                    <?php echo e($postingan->judul); ?>

                                </h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo e($postingan->tanggal_publish->format('d M Y')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Center Column: Calendar -->
    <div class="lg:col-span-1">
        <div class="border border-gray-200 bg-white p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-black text-xl border-b pb-2">
                    Kalender Agenda
                </h3>
                <a href="<?php echo e(route('public.agenda')); ?>" class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                    Lihat Semua
                </a>
            </div>
            <div id="calendar-public" class="min-h-[500px]"></div>
        </div>
    </div>

    <!-- Right Column: Aspirasi -->
    <?php if($aspirasis->isNotEmpty()): ?>
    <div class="lg:col-span-1">
        <div class="border border-gray-200 bg-white p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-black text-xl border-b pb-2">
                    Aspirasi
                </h3>
                <a href="<?php echo e(route('public.aspirasi')); ?>" class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                    Lihat Semua
                </a>
            </div>
            <div class="space-y-4">
                <?php $__currentLoopData = $aspirasis->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('public.aspirasi.show', $aspirasi)); ?>" class="block group">
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition line-clamp-2">
                                    <?php echo e($aspirasi->topik_aspirasi); ?>

                                </h4>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo e($aspirasi->profilOrmada->nama_universitas ?? 'Unknown'); ?>

                                </p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-xs px-2 py-1 rounded-full <?php echo e($aspirasi->tanggapan_pemda ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'); ?>">
                                        <?php echo e($aspirasi->tanggapan_pemda ? 'Sudah Ditanggapi' : 'Menunggu'); ?>

                                    </span>
                                    <span class="text-xs text-gray-400"><?php echo e($aspirasi->dibuat_pada->diffForHumans()); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>

<!-- ========================= -->
<!-- BERITA TERBARU -->
<!-- ========================= -->

<section id="berita" class="mt-20">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-4xl font-black tracking-tight">
                Berita Terbaru
            </h2>
            <p class="text-gray-500 mt-2">
                Informasi terbaru dari organisasi mahasiswa daerah.
            </p>
        </div>
        <a href="<?php echo e(route('public.postingan')); ?>" class="border border-black px-5 py-2 hover:bg-black hover:text-white transition">
            Semua Berita
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
        <?php $__currentLoopData = $postingans->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="group bg-white border border-gray-200 hover:shadow-xl transition duration-300 overflow-hidden">
            <?php if($postingan->foto): ?>
                <div class="overflow-hidden">
                    <img src="<?php echo e(storage_url($postingan->foto)); ?>" class="w-full h-60 object-cover group-hover:scale-105 duration-300">
                </div>
            <?php endif; ?>

            <div class="p-5">
                <div class="flex items-center justify-between">
                    <span class="uppercase text-[11px] tracking-widest font-bold text-blue-700">
                        <?php echo e(strtoupper($postingan->jenis)); ?>

                    </span>
                    <span class="text-xs text-gray-400">
                        <?php echo e($postingan->tanggal_publish->format('d M Y')); ?>

                    </span>
                </div>

                <h3 class="mt-4 font-black text-xl leading-tight group-hover:text-blue-700 transition">
                    <a href="<?php echo e(route('public.postingan.show',$postingan)); ?>">
                        <?php echo e($postingan->judul); ?>

                    </a>
                </h3>

                <p class="text-gray-600 mt-4 leading-7">
                    <?php echo e(Str::limit(strip_tags($postingan->isi_konten),120)); ?>

                </p>

                <a href="<?php echo e(route('public.postingan.show',$postingan)); ?>" class="inline-block mt-6 font-semibold hover:text-blue-700">
                    Baca Selengkapnya →
                </a>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ====================================== -->
<!-- PROFIL ORMADA -->
<!-- ====================================== -->

<section id="profil" class="mt-24">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-4xl font-black">
                Profil Ormada
            </h2>
            <p class="text-gray-500 mt-2">
                Organisasi mahasiswa daerah dari berbagai perguruan tinggi.
            </p>
        </div>
        <a href="#" class="border border-black px-5 py-2 hover:bg-black hover:text-white transition">
            Semua Ormada
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
        <?php $__currentLoopData = $profilOrmadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="border border-gray-200 bg-white p-6 hover:shadow-xl transition">
            <div class="flex justify-center">
                <?php if($profil->logo): ?>
                    <img src="<?php echo e(profil_logo_url($profil->logo)); ?>" class="w-24 h-24 object-cover rounded-full">
                <?php else: ?>
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-2xl font-bold">
                        <?php echo e(strtoupper(substr($profil->nama_universitas,0,2))); ?>

                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-6">
                <h3 class="font-black text-xl">
                    <?php echo e($profil->nama_universitas); ?>

                </h3>
                <p class="text-gray-500 mt-2">
                    <?php echo e(number_format($profil->anggota_count)); ?> Anggota
                </p>
                <p class="text-gray-500">
                    <?php echo e(number_format($profil->pengurus_count)); ?> Pengurus
                </p>
                <a href="<?php echo e(route('public.ormada.show',$profil)); ?>" class="inline-block mt-6 text-blue-700 font-semibold">
                    Lihat Profil →
                </a>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ====================================== -->
<!-- AGENDA -->
<!-- ====================================== -->

<section id="agenda" class="mt-24">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-4xl font-black">
                Agenda Kegiatan
            </h2>
            <p class="text-gray-500 mt-2">
                Jadwal kegiatan terdekat.
            </p>
        </div>
        <a href="<?php echo e(route('public.agenda')); ?>" class="border border-black px-5 py-2 hover:bg-black hover:text-white transition">
            Semua Agenda
        </a>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
        <?php $__currentLoopData = $agendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="border border-gray-200 overflow-hidden hover:shadow-xl transition bg-white">
            <?php if($agenda->gambar_poster): ?>
                <img src="<?php echo e(storage_url($agenda->gambar_poster)); ?>" class="w-full h-60 object-cover">
            <?php endif; ?>

            <div class="p-6">
                <div class="uppercase text-xs tracking-widest font-bold text-blue-700">
                    <?php echo e(strtoupper($agenda->kategori)); ?>

                </div>
                <h3 class="font-black text-2xl mt-3">
                    <?php echo e($agenda->nama_agenda); ?>

                </h3>
                <p class="text-gray-500 mt-3">
                    <?php echo e(Str::limit($agenda->deskripsi_agenda,120)); ?>

                </p>
                <div class="mt-6 space-y-2 text-sm">
                    <div>
                        📅 <?php echo e($agenda->waktu_mulai->format('d M Y')); ?>

                    </div>
                    <div>
                        📍 <?php echo e($agenda->tempat); ?>

                    </div>
                </div>
                <a href="<?php echo e(route('public.agenda.show',$agenda)); ?>" class="inline-block mt-6 font-semibold text-blue-700">
                    Detail →
                </a>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ====================================== -->
<!-- ASPIRASI -->
<!-- ====================================== -->

<section id="aspirasi" class="mt-24">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-4xl font-black">
                Aspirasi Mahasiswa
            </h2>
            <p class="text-gray-500 mt-2">
                Aspirasi terbaru dari mahasiswa daerah.
            </p>
        </div>
        <a href="<?php echo e(route('public.aspirasi')); ?>" class="border border-black px-5 py-2 hover:bg-black hover:text-white transition">
            Semua Aspirasi
        </a>
    </div>

    <div class="space-y-5">
        <?php $__currentLoopData = $aspirasis->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="border-b pb-5">
            <div class="flex justify-between items-center">
                <div>
                    <a href="<?php echo e(route('public.aspirasi.show',$aspirasi)); ?>">
                        <h3 class="font-black text-xl hover:text-blue-700">
                            <?php echo e($aspirasi->topik_aspirasi); ?>

                        </h3>
                    </a>
                    <p class="text-gray-500 mt-2">
                        <?php echo e($aspirasi->profilOrmada->nama_universitas); ?>

                    </p>
                </div>
                <span class="text-sm text-gray-400">
                    <?php echo e($aspirasi->dibuat_pada->diffForHumans()); ?>

                </span>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ====================================== -->
<!-- PENGUMUMAN -->
<!-- ====================================== -->

<section class="mt-24">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-4xl font-black">
                Pengumuman
            </h2>
            <p class="text-gray-500 mt-2">
                Informasi penting terbaru.
            </p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
        <?php $__currentLoopData = $postingans->where('jenis','pengumuman')->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="border border-gray-200 bg-white">
            <?php if($post->foto): ?>
                <img src="<?php echo e(storage_url($post->foto)); ?>" class="w-full h-56 object-cover">
            <?php endif; ?>

            <div class="p-5">
                <h3 class="font-black text-xl">
                    <?php echo e($post->judul); ?>

                </h3>
                <p class="text-gray-600 mt-3">
                    <?php echo e(Str::limit(strip_tags($post->isi_konten),120)); ?>

                </p>
                <a href="<?php echo e(route('public.postingan.show',$post)); ?>" class="inline-block mt-5 text-blue-700 font-semibold">
                    Selengkapnya →
                </a>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<footer class="mt-24 border-t pt-12 pb-10">
    <div class="text-center">
        <h2 class="text-3xl font-black">
            SI ORMADA TEMANGGUNG
        </h2>
        <p class="mt-3 text-gray-500">
            Sistem Informasi Organisasi Mahasiswa Daerah Temanggung Lintas Kampus
        </p>
        <p class="mt-8 text-sm text-gray-400">
            © <?php echo e(date('Y')); ?> SI Ormada Temanggung
        </p>
    </div>
</footer>

</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const storageBase = "<?php echo e(asset('storage')); ?>";

function resolveImageUrl(path) {
    if (!path) return null;
    return /^(https?:)?\/\//.test(path) ? path : `${storageBase}/${path.replace(/^\/+/, '')}`;
}

// Calendar Initialization
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar-public');
    if (calendarEl && typeof FullCalendar !== 'undefined') {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'id',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listMonth'
            },
            events: <?php echo json_encode($calendarEvents, 15, 512) ?>,
            eventClick: function(info) {
                if (info.event.extendedProps.detail_url) {
                    window.location.href = info.event.extendedProps.detail_url;
                }
            },
            eventDisplay: 'block',
            displayEventTime: true,
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: false
            }
        });
        calendar.render();
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/dashboard.blade.php ENDPATH**/ ?>