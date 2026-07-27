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
        body { font-family: 'Inter', sans-serif; }
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
        .font-newspaper { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white sticky top-0 z-50">
<!-- ========================= -->
<!-- TOP BAR -->
<!-- ========================= -->

<div class="border-b border-gray-300 bg-white">

    <div class="mx-auto max-w-7xl px-4">

        <div class="flex items-center justify-between h-8">

            <!-- Left -->

            <div class="flex items-center gap-3 text-[11px] uppercase tracking-widest text-gray-500">

                <span><?php echo e(now()->format('l, d F Y')); ?></span>

                <span class="w-px h-3 bg-gray-300"></span>

                <span>Temanggung</span>

            </div>

            <!-- Center -->

            <div class="hidden lg:block">

                <span class="text-[11px] uppercase tracking-[3px] font-semibold text-gray-500">

                    Sistem Informasi Organisasi Mahasiswa Daerah

                </span>

            </div>

            <!-- Right -->

            <div class="flex items-center gap-3">

                <?php if(auth()->guard()->check()): ?>

                <a
                    href="<?php echo e(route('dashboard')); ?>"
                    class="text-xs uppercase tracking-widest font-semibold hover:text-blue-700 transition">

                    Dashboard

                </a>

                <?php else: ?>

                <a
                    href="<?php echo e(route('login')); ?>"
                    class="text-xs uppercase tracking-widest font-semibold hover:text-blue-700 transition">

                    Login

                </a>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div> 
<!-- ====================================== -->
<!-- MAIN HEADER -->
<!-- ====================================== -->

<div class="bg-white border-b border-gray-300">

    <div class="mx-auto max-w-7xl px-4 py-2">

        <div class="grid grid-cols-3 items-center">

            <!-- Search -->

            <div class="flex items-center">

                <button
                    class="flex items-center gap-2 uppercase tracking-widest text-[10px] font-semibold hover:text-blue-700 transition">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-5.2-5.2M10.8 18a7.2 7.2 0 100-14.4 7.2 7.2 0 000 14.4z"/>

                    </svg>

                    Search

                </button>

            </div>


            <!-- Logo -->

            <div class="text-center">

                <a href="<?php echo e(route('public.home')); ?>">

                    <h1
                        class="text-xl lg:text-2xl font-black"
                        style="font-family:'Playfair Display',serif;">

                        SI ORMADA

                    </h1>

                    <div
                        class="mt-0.5 uppercase tracking-[1px] text-[10px] text-gray-500">

                        TEMANGGUNG

                    </div>

                </a>

            </div>


            <!-- Social -->

            <div class="flex justify-end gap-2">

                <a href="#"
                    class="uppercase text-[10px] tracking-widest font-semibold hover:text-blue-700">

                    Facebook

                </a>

                <a href="#"
                    class="uppercase text-[10px] tracking-widest font-semibold hover:text-blue-700">

                    Instagram

                </a>

                <a href="#"
                    class="uppercase text-[10px] tracking-widest font-semibold hover:text-blue-700">

                    Email

                </a>

            </div>

        </div>

    </div>

</div>


<!-- ====================================== -->
<!-- NAVIGATION -->
<!-- ====================================== -->

<nav class="border-b-2 border-black border-t border-gray-300 bg-white">

    <div class="mx-auto max-w-7xl">

        <ul class="flex justify-center text-[10px]">

            <li>
                <a href="<?php echo e(route('public.home')); ?>"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Beranda

                </a>
            </li>

            <li>
                <a href="<?php echo e(route('public.aspirasi')); ?>"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Aspirasi

                </a>
            </li>

            <li>
                <a href="<?php echo e(route('public.agenda')); ?>"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Agenda

                </a>
            </li>

            <li>
                <a href="<?php echo e(route('public.postingan')); ?>"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Berita

                </a>
            </li>

            <li>
                <a href="<?php echo e(route('public.ormada')); ?>"
                    class="block px-4 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Profil Ormada

                </a>
            </li>

        </ul>

    </div>

</nav>
        </header>

        <main class="flex-1">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

<!-- ====================================== -->
<!-- FOOTER -->
<!-- ====================================== -->

<footer class="mt-12 border-t-2 border-black bg-white">

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Logo -->

        <div class="text-center">

            <h2
                class="text-xl lg:text-2xl font-black"
                style="font-family:'Playfair Display',serif;">

                SI ORMADA

            </h2>

            <p
                class="mt-0.5 uppercase tracking-[3px] text-[10px] text-gray-500">

                TEMANGGUNG

            </p>

        </div>


        <!-- Description -->

        <div class="max-w-3xl mx-auto text-center mt-4">

            <p class="text-gray-600 leading-5 text-xs">

                Sistem Informasi Organisasi Mahasiswa Daerah Kabupaten
                Temanggung yang menyediakan informasi berita, agenda,
                profil organisasi mahasiswa, serta layanan aspirasi
                sebagai media komunikasi antara mahasiswa dan pemerintah
                daerah.

            </p>

        </div>


        <!-- Menu -->

        <div
            class="flex flex-wrap justify-center gap-4 mt-6 uppercase tracking-widest text-xs font-semibold">

            <a href="<?php echo e(route('public.home')); ?>"
               class="hover:text-blue-700 transition">

                Beranda

            </a>

            <a href="<?php echo e(route('public.aspirasi')); ?>"
               class="hover:text-blue-700 transition">

                Aspirasi

            </a>

            <a href="<?php echo e(route('public.agenda')); ?>"
               class="hover:text-blue-700 transition">

                Agenda

            </a>

            <a href="<?php echo e(route('public.postingan')); ?>"
               class="hover:text-blue-700 transition">

                Berita

            </a>

            <a href="<?php echo e(route('public.ormada')); ?>"
               class="hover:text-blue-700 transition">

                Profil Ormada

            </a>

        </div>


        <!-- Divider -->

        <div class="border-t border-gray-300 my-6"></div>


        <!-- Bottom -->

        <div
            class="flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-gray-500">

            <div>

                © <?php echo e(date('Y')); ?> SI Ormada Temanggung

            </div>

            <div class="flex gap-4 uppercase tracking-widest text-[10px]">

                <a href="#">Instagram</a>

                <a href="#">Email</a>

                <a href="#">Pemkab Temanggung</a>

            </div>

        </div>

    </div>

</footer>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\project\magang\resources\views/layouts/public.blade.php ENDPATH**/ ?>