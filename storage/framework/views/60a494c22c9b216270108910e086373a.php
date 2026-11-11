<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - <?php echo e(config('app.name', 'Ormada')); ?></title>
    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?>
</head>
<body class="bg-zinc-50 text-zinc-950">
    <main class="flex min-h-screen items-center justify-center px-4 py-10">
        <section class="w-full max-w-md rounded-lg border border-zinc-200 bg-white p-6">
            <div class="mb-6">
                <p class="text-sm font-medium text-zinc-500">Sistem Informasi Ormada</p>
                <h1 class="mt-2 text-2xl font-semibold">Login Admin</h1>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Masuk menggunakan akun admin, pengurus ormada, atau Pemda.</p>
            </div>

            <?php if(session('status')): ?>
                <div class="mb-4 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700">Email</span>
                    <input
                        type="email"
                        name="email"
                        value="<?php echo e(old('email')); ?>"
                        required
                        autofocus
                        autocomplete="email"
                        class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2"
                    >
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-zinc-700">Kata sandi</span>
                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2"
                    >
                </label>

                <label class="flex items-center gap-2 text-sm text-zinc-700">
                    <input type="checkbox" name="remember" value="1" class="rounded border-zinc-300">
                    Ingat saya
                </label>

                <button class="w-full rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">
                    Masuk
                </button>
            </form>
        </section>
    </main>
</body>
</html>
<?php /**PATH C:\Users\User\OneDrive\Documents\GitHub\magang\resources\views/auth/login.blade.php ENDPATH**/ ?>