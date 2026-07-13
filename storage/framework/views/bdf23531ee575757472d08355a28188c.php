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
    <div class="space-y-6">
    <!-- Welcome Message -->
    <div class="rounded-lg border border-blue-200 bg-blue-50 p-6">
        <h2 class="text-lg font-semibold text-blue-900">Selamat Datang, <?php echo e(auth()->user()->nama); ?>!</h2>
        <p class="mt-2 text-sm text-blue-700">Anda login sebagai Admin dengan akses penuh ke semua fitur sistem.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        <?php $__currentLoopData = [
            'Ormada' => $totalOrmada,
            'Anggota' => $totalAnggota,
            'Pengurus' => $totalPengurus,
            'Alumni' => $totalAlumni,
            'Demisioner' => $totalDemisioner,
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500"><?php echo e($label); ?></p>
                <p class="mt-2 text-2xl font-semibold"><?php echo e(number_format($value)); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Quick Actions -->
    <section class="rounded-lg border border-zinc-200 bg-white p-6">
        <h2 class="font-semibold">Aksi Cepat</h2>
        <div class="mt-4 flex flex-wrap gap-2">
            <a href="<?php echo e(route('profil-ormada.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Ormada
            </a>
            <a href="<?php echo e(route('anggota-ormada.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Anggota
            </a>
            <a href="<?php echo e(route('agenda.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Buat Agenda
            </a>
            <a href="<?php echo e(route('postingan.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Buat Postingan
            </a>
            <a href="<?php echo e(route('proposal.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Buat Proposal
            </a>
        </div>
    </section>

    <!-- Management Links -->
    <section class="rounded-lg border border-zinc-200 bg-white p-6">
        <h2 class="font-semibold">Manajemen Data</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="<?php echo e(route('profil-ormada.index')); ?>" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Profil Ormada</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola data profil semua ormada</p>
            </a>
            <a href="<?php echo e(route('anggota-ormada.index')); ?>" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Anggota Ormada</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola data anggota ormada</p>
            </a>
            <a href="<?php echo e(route('agenda.index')); ?>" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Agenda</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola agenda kegiatan</p>
            </a>
            <a href="<?php echo e(route('postingan.index')); ?>" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Postingan</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola postingan dan berita</p>
            </a>
            <a href="<?php echo e(route('proposal.index')); ?>" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Proposal</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola proposal kegiatan</p>
            </a>
            <a href="<?php echo e(route('aspirasi.index')); ?>" class="rounded-lg border border-zinc-200 p-4 hover:border-blue-300 hover:bg-blue-50">
                <h3 class="font-medium">Aspirasi</h3>
                <p class="mt-1 text-sm text-zinc-500">Kelola aspirasi mahasiswa</p>
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