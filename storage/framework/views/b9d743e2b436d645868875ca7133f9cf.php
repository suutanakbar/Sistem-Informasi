<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Dashboard Pemda','headerTitle' => 'Dashboard Pemerintah Daerah']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Pemda','headerTitle' => 'Dashboard Pemerintah Daerah']); ?>
    <?php $__env->startPush('styles'); ?>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
    <?php $__env->stopPush(); ?>
    <div class="space-y-6">
        <!-- Welcome Message -->
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-6">
            <h2 class="text-lg font-semibold text-emerald-900">Selamat Datang, <?php echo e(auth()->user()->nama); ?>!</h2>
            <p class="mt-2 text-sm text-emerald-700">Anda login sebagai Pemerintah Daerah. Kelola agenda dan volunteer untuk kegiatan.</p>
        </div>

        <!-- Quick Actions -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <h2 class="font-semibold">Aksi Cepat</h2>
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="<?php echo e(route('agenda.create')); ?>" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Buat Agenda Baru
                </a>
                <a href="<?php echo e(route('postingan.create')); ?>" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Buat Postingan/Berita
                </a>
            </div>
        </section>

        <!-- Statistics -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Ormada</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($totalOrmada ?? 0)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Anggota Aktif</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($totalAnggota ?? 0)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Agenda Mendatang</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($agendaMendatang ?? 0)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Proposal Menunggu</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($proposalMenunggu ?? 0)); ?></p>
            </div>
        </div>

        <!-- Volunteer Management -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Kelola Volunteer</h2>
                <a href="<?php echo e(route('volunteer.index')); ?>" class="text-sm text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Buka dan kelola pendaftaran volunteer untuk agenda kegiatan.</p>
            <div class="mt-4">
                <a href="<?php echo e(route('volunteer.index')); ?>" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                    Kelola Volunteer
                </a>
            </div>
        </section>

        <!-- Event Calendar -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <h2 class="font-semibold">Kalender Agenda</h2>
            <p class="mt-2 text-sm text-zinc-500">Agenda kegiatan yang akan datang.</p>
            <div id="calendar" class="mt-4 min-h-[500px]"></div>
        </section>

        <!-- Recent Agenda -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Agenda Terbaru</h2>
                <a href="<?php echo e(route('agenda.index')); ?>" class="text-sm text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Agenda yang akan datang dan sedang berlangsung.</p>
        </section>

        <!-- Recent Postingan -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Postingan/Berita Terbaru</h2>
                <a href="<?php echo e(route('postingan.index')); ?>" class="text-sm text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Berita dan postingan yang sudah dibuat.</p>
        </section>
    </div>
    <?php $__env->startPush('scripts'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '<?php echo e(route("agenda.calendar")); ?>',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }
            });
            calendar.render();
        }
    });
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $attributes = $__attributesOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $component = $__componentOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__componentOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php /**PATH C:\project\magang\resources\views/dashboard/pemda.blade.php ENDPATH**/ ?>