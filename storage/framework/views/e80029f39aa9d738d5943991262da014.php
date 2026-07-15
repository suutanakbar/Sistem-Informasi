<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? config('app.name', 'Ormada')); ?></title>
    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?>
</head>
<body class="bg-zinc-50 text-zinc-950">
    <div class="min-h-screen">
        <header class="border-b border-zinc-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="<?php echo e(route('dashboard')); ?>" class="text-lg font-semibold">SI Ormada</a>
                <nav class="flex items-center gap-2 text-sm">
                    <a href="<?php echo e(route('dashboard')); ?>" class="rounded-md px-3 py-2 hover:bg-zinc-100">Dashboard</a>
                    <a href="<?php echo e(route('profil-ormada.index')); ?>" class="rounded-md px-3 py-2 hover:bg-zinc-100">Profil Ormada</a>
                    <a href="<?php echo e(route('proposal.index')); ?>" class="rounded-md px-3 py-2 hover:bg-zinc-100">Proposal</a>
                    <a href="<?php echo e(route('aspirasi.index')); ?>" class="rounded-md px-3 py-2 hover:bg-zinc-100">Aspirasi</a>
                    <a href="<?php echo e(route('postingan.index')); ?>" class="rounded-md px-3 py-2 hover:bg-zinc-100">Postingan</a>
                    <a href="<?php echo e(route('agenda.index')); ?>" class="rounded-md px-3 py-2 hover:bg-zinc-100">Agenda</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="rounded-md px-3 py-2 text-left hover:bg-zinc-100">Keluar</button>
                    </form>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <?php if(session('status')): ?>
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <p class="font-semibold">Ada input yang perlu dicek.</p>
                    <ul class="mt-2 list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo e($slot); ?>

        </main>
    </div>
</body>
</html>
<?php /**PATH C:\project\magang\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>