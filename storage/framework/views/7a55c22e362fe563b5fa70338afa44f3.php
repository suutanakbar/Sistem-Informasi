<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? config('app.name', 'SI Ormada')); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;600;700;900&display=swap" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">

    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0055A4 0%, #003D7A 100%);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 85, 164, 0.15);
        }

        .content-card {
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .top-bar {
            border-bottom: 1px solid #e5e7eb;
            padding: 8px 0;
            font-size: 14px;
        }

        /* Header: smaller, cleaner, responsive */
        .main-header {
            padding: 8px 0;
            text-align: center;
            border-bottom: 1px solid #e6e6e6;
            background: #ffffff;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin: 0;
            text-transform: uppercase;
        }

        .tagline {
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 4px;
            color: #6b7280;
        }

        .nav-bar {
            border-bottom: 1px solid #e6e6e6;
            padding: 4px 0;
        }

        /* Responsive scaling for larger screens */
        @media (min-width: 768px) {
            .main-header { padding: 12px 0; }
            .logo-text { font-size: 28px; }
            .tagline { font-size: 11px; }
        }

        @media (min-width: 1024px) {
            .main-header { padding: 14px 0; }
            .logo-text { font-size: 32px; }
            .tagline { font-size: 12px; }
        }

        .nav-item {
            position: relative;
            padding: 4px 10px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-item:hover {
            color: #0055A4;
        }

        .dropdown-indicator {
            font-size: 10px;
            margin-left: 4px;
        }

        .font-newspaper {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <?php echo $__env->make('components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <main class="flex-1">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\project\magang\resources\views/layouts/public.blade.php ENDPATH**/ ?>