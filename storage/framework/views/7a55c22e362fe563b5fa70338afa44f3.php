<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? config('app.name', 'SI Ormada')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            padding: 16px 0;
            text-align: center;
            border-bottom: 1px solid #e6e6e6;
            background: #ffffff;
        }
        .logo-text {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.05;
            margin: 0;
            text-transform: uppercase;
        }
        .tagline {
            font-size: 12px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 6px;
            color: #6b7280;
        }
        .nav-bar {
            border-bottom: 1px solid #e6e6e6;
            padding: 8px 0;
        }

        /* Responsive scaling for larger screens */
        @media (min-width: 768px) {
            .main-header { padding: 20px 0; }
            .logo-text { font-size: 40px; }
            .tagline { font-size: 12px; }
        }
        @media (min-width: 1024px) {
            .main-header { padding: 22px 0; }
            .logo-text { font-size: 52px; }
            .tagline { font-size: 13px; }
        }
        .nav-item {
            position: relative;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 14px;
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
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white sticky top-0 z-50">
            <div class="top-bar">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button class="text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                            <button class="text-gray-700 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </button>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">Today: <?php echo e(date('F j, Y')); ?></span>
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('dashboard')); ?>" class="px-4 py-2 border border-gray-900 text-gray-900 text-sm font-semibold hover:bg-gray-900 hover:text-white transition">DASHBOARD</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 border border-gray-900 text-gray-900 text-sm font-semibold hover:bg-gray-900 hover:text-white transition">LOGIN</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-header">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div class="hidden md:block">
                            <button class="text-gray-900 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </div>
                        <div class="flex-1 text-center">
                            <a href="<?php echo e(route('public.home')); ?>" class="inline-block">
                                <h1 class="logo-text">SI ORMADA</h1>
                                <p class="tagline">Sistem Informasi Ormada Temanggung</p>
                            </a>
                        </div>
                        <div class="hidden md:flex items-center gap-3">
                            <a href="#" class="w-10 h-10 rounded-full border border-gray-900 flex items-center justify-center hover:bg-gray-900 hover:text-white transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <a href="mailto:info@ormada-temanggung.id" class="w-10 h-10 rounded-full border border-gray-900 flex items-center justify-center hover:bg-gray-900 hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-bar">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <nav class="hidden lg:flex items-center justify-center gap-1">
                        <a href="<?php echo e(route('public.home')); ?>" class="nav-item">Beranda</a>
                        <a href="<?php echo e(route('public.agenda')); ?>" class="nav-item">Agenda <span class="dropdown-indicator">+</span></a>
                        <a href="<?php echo e(route('public.postingan')); ?>" class="nav-item">Berita <span class="dropdown-indicator">+</span></a>
                        <a href="<?php echo e(route('public.aspirasi')); ?>" class="nav-item">Aspirasi <span class="dropdown-indicator">+</span></a>
                        <a href="<?php echo e(route('public.ormada')); ?>" class="nav-item">Profil Ormada <span class="dropdown-indicator">+</span></a>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-white rounded-lg p-2">
                                <svg class="w-6 h-6 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361v11.2a1 1 0 01-1.646.962L9.3 16.573z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">SI Ormada</h3>
                                <p class="text-xs text-gray-400">Temanggung</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-400 max-w-md">Sistem Informasi Ormada dan Sinergi Pemda Temanggung. Platform terpadu untuk informasi organisasi mahasiswa daerah.</p>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Menu</h4>
                        <ul class="space-y-2">
                            <li><a href="<?php echo e(route('public.home')); ?>" class="text-sm text-gray-400 hover:text-white transition">Beranda</a></li>
                            <li><a href="<?php echo e(route('public.aspirasi')); ?>" class="text-sm text-gray-400 hover:text-white transition">Aspirasi</a></li>
                            <li><a href="<?php echo e(route('public.postingan')); ?>" class="text-sm text-gray-400 hover:text-white transition">Berita & Pengumuman</a></li>
                            <li><a href="<?php echo e(route('public.agenda')); ?>" class="text-sm text-gray-400 hover:text-white transition">Agenda Kegiatan</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Kontak</h4>
                        <ul class="space-y-2">
                            <li class="flex items-start gap-2 text-sm text-gray-400">
                                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Temanggung, Jawa Tengah</span>
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-400">
                                <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>info@ormada-temanggung.id</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 py-6">
                    <p class="text-sm text-center text-gray-400">© <?php echo e(date('Y')); ?> SI Ormada Temanggung. Hak Cipta Dilindungi.</p>
                </div>
            </div>

            <?php echo $__env->yieldPushContent('scripts'); ?>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/id.min.js"></script>
    </div>
</body>
</html>
<?php /**PATH C:\project\magang\resources\views/layouts/public.blade.php ENDPATH**/ ?>