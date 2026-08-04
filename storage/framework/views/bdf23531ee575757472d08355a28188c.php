<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Dashboard Admin','headerTitle' => 'Dashboard Admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Admin','headerTitle' => 'Dashboard Admin']); ?>
    <?php $__env->startPush('styles'); ?>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
    <?php $__env->stopPush(); ?>
    <div class="space-y-4">
    <!-- Welcome Message -->
    <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
        <h2 class="text-base font-semibold text-blue-900">Selamat Datang, <?php echo e(auth()->user()->nama); ?>!</h2>
        <p class="mt-1 text-xs text-blue-700">Anda login sebagai Admin dengan akses penuh ke semua fitur sistem.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <?php $__currentLoopData = [
            'Ormada' => $totalOrmada,
            'Anggota' => $totalAnggota,
            'Pengurus' => $totalPengurus,
            'Mahasiswa' => $totalMahasiswa,
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rounded-lg border border-zinc-200 bg-white p-3">
                <p class="text-xs text-zinc-500"><?php echo e($label); ?></p>
                <p class="mt-1 text-xl font-semibold"><?php echo e(number_format($value)); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Quick Actions -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <h2 class="text-sm font-semibold text-gray-900">Aksi Cepat</h2>
        <div class="mt-3 flex flex-wrap gap-2">
            <a href="<?php echo e(route('profil-ormada.create')); ?>" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Tambah Ormada
            </a>
            <a href="<?php echo e(route('anggota-ormada.create')); ?>" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Tambah Anggota
            </a>
            <a href="<?php echo e(route('agenda.create')); ?>" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Buat Agenda
            </a>
            <a href="<?php echo e(route('postingan.create')); ?>" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Buat Postingan
            </a>
            <a href="<?php echo e(route('proposal.create')); ?>" class="rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                Buat Proposal
            </a>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-sm font-semibold text-gray-900">Berita Terbaru</h2>
                <p class="mt-0.5 text-xs text-zinc-500">Postingan dan berita terkini.</p>
            </div>
            <a href="<?php echo e(route('postingan.index')); ?>" class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                Lihat Semua
            </a>
        </div>
        <div class="grid gap-4 md:grid-cols-2">
            <?php $__empty_1 = true; $__currentLoopData = $beritaTerbaru->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postingan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if (isset($component)) { $__componentOriginal71dcb006fef4235d1b253d113bf6ce81 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71dcb006fef4235d1b253d113bf6ce81 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.berita-agenda-card','data' => ['postingan' => $postingan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('berita-agenda-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['postingan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($postingan)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal71dcb006fef4235d1b253d113bf6ce81)): ?>
<?php $attributes = $__attributesOriginal71dcb006fef4235d1b253d113bf6ce81; ?>
<?php unset($__attributesOriginal71dcb006fef4235d1b253d113bf6ce81); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71dcb006fef4235d1b253d113bf6ce81)): ?>
<?php $component = $__componentOriginal71dcb006fef4235d1b253d113bf6ce81; ?>
<?php unset($__componentOriginal71dcb006fef4235d1b253d113bf6ce81); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-8">
                    <p class="text-xs text-gray-500">Belum ada berita.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Event Calendar -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <h2 class="text-sm font-semibold text-gray-900">Kalender Agenda</h2>
        <p class="mt-1 text-xs text-zinc-500">Agenda kegiatan yang akan datang.</p>
        <div id="calendar" class="mt-3 min-h-[400px]"></div>
    </section>

    <!-- Management Links -->
    <section class="rounded-lg border border-zinc-200 bg-white p-4">
        <h2 class="text-sm font-semibold text-gray-900">Manajemen Data</h2>
        <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <a href="<?php echo e(route('profil-ormada.index')); ?>" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Profil Ormada</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola data profil semua ormada</p>
            </a>
            <a href="<?php echo e(route('anggota-ormada.index')); ?>" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Anggota Ormada</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola data anggota ormada</p>
            </a>
            <a href="<?php echo e(route('agenda.index')); ?>" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Agenda</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola agenda kegiatan</p>
            </a>
            <a href="<?php echo e(route('postingan.index')); ?>" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Postingan</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola postingan dan berita</p>
            </a>
            <a href="<?php echo e(route('proposal.index')); ?>" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Proposal</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola proposal kegiatan</p>
            </a>
            <a href="<?php echo e(route('aspirasi.index')); ?>" class="rounded-lg border border-zinc-200 p-3 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                <h3 class="text-sm font-medium">Aspirasi</h3>
                <p class="mt-1 text-xs text-zinc-500">Kelola aspirasi mahasiswa</p>
            </a>
        </div>
    </section>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH C:\project\magang\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>