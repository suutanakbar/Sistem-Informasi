<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Dashboard Pengurus','headerTitle' => 'Dashboard Pengurus Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Pengurus','headerTitle' => 'Dashboard Pengurus Ormada']); ?>
    <div class="space-y-6">
        <!-- Welcome Message -->
        <div class="rounded-lg border border-orange-200 bg-orange-50 p-6">
            <h2 class="text-lg font-semibold text-orange-900">Selamat Datang, <?php echo e(auth()->user()->nama); ?>!</h2>
            <p class="mt-2 text-sm text-orange-700">
                <?php if(auth()->user()->profilOrmada): ?>
                    Anda login sebagai Pengurus Ormada <strong><?php echo e(auth()->user()->profilOrmada->nama_ormada); ?></strong>.
                <?php else: ?>
                    Anda login sebagai Pengurus Ormada. Silakan lengkapi profil ormada Anda.
                <?php endif; ?>
            </p>
        </div>

        <?php if(!auth()->user()->profilOrmada): ?>
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                <p class="text-sm text-yellow-800">Anda belum memiliki profil ormada. 
                    <a href="<?php echo e(route('profil-ormada.create')); ?>" class="font-medium underline">Klik di sini untuk membuat profil</a>.
                </p>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Anggota</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($totalAnggota ?? 0)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total Pengurus</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($totalPengurus ?? 0)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Mahasiswa</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($totalMahasiswa ?? 0)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Proposal Saya</p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($totalProposal ?? 0)); ?></p>
            </div>
        </div>

        <!-- Agenda from Pemda -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Agenda dari Pemerintah Daerah</h2>
                <a href="<?php echo e(route('agenda.index')); ?>" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Agenda kegiatan yang dibuat oleh Pemerintah Daerah. Anda dapat melihat detail dan mendaftar volunteer.</p>
        </section>

        <!-- Event Calendar -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <h2 class="font-semibold">Kalender Agenda</h2>
            <p class="mt-2 text-sm text-zinc-500">Agenda kegiatan yang akan datang dari Pemerintah Daerah.</p>
            <div id="calendar" class="mt-4 min-h-[500px]"></div>
        </section>

        <!-- My Postingan -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Postingan/Berita Saya</h2>
                <a href="<?php echo e(route('postingan.index')); ?>" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Kelola postingan dan berita untuk ormada Anda.</p>
            <div class="mt-4">
                <a href="<?php echo e(route('postingan.create')); ?>" class="rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
                    Buat Postingan Baru
                </a>
            </div>
        </section>

        <!-- My Proposal -->
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold">Proposal Saya</h2>
                <a href="<?php echo e(route('proposal.index')); ?>" class="text-sm text-orange-600 hover:text-orange-700">Lihat Semua</a>
            </div>
            <p class="mt-2 text-sm text-zinc-500">Kelola proposal yang telah Anda ajukan.</p>
            <div class="mt-4">
                <a href="<?php echo e(route('proposal.create')); ?>" class="rounded-md bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
                    Buat Proposal Baru
                </a>
            </div>
        </section>
    </div>
    <?php $__env->startPush('scripts'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                eventSources: [
                    {
                        url: '<?php echo e(route("agenda.calendar")); ?>',
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                ],
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
<?php if (isset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $attributes = $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $component = $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?>
<?php /**PATH C:\project\magang\resources\views/dashboard/pengurus.blade.php ENDPATH**/ ?>