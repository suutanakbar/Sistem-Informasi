<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? config('app.name', 'Ormada')); ?></title>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?>
</head>
<body class="bg-zinc-50 text-zinc-950 theme-pemda">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 border-r border-zinc-200 bg-emerald-800 text-white">
            <div class="p-4">
                <a href="<?php echo e(route('dashboard')); ?>" class="text-xl font-bold">SI Ormada</a>
                <p class="mt-1 text-xs text-emerald-100">Pemerintah Daerah</p>
            </div>
            
            <nav class="mt-4 px-2">
                <?php echo $__env->make('components.layouts.sidebar-pemda', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col">
            <!-- Header -->
            <header class="border-b border-zinc-200 bg-white">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-lg font-semibold"><?php echo e($headerTitle ?? 'Dashboard'); ?></h1>
                    <div class="flex items-center gap-4">
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-medium text-emerald-800">Pemda</span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm"><?php echo e(auth()->user()->nama); ?></span>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="rounded-md px-3 py-2 text-sm hover:bg-zinc-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-6">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\project\magang\resources\views/components/layouts/pemda.blade.php ENDPATH**/ ?>