<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'SI Ormada') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
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
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4">
                    <!-- Logo & Title -->
                    <a href="{{ route('public.home') }}" class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-12 h-12" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="45" fill="#0055A4"/>
                                <path d="M25 55 Q35 45 50 50 Q65 55 75 45" stroke="white" stroke-width="3" fill="none"/>
                                <path d="M20 60 Q35 50 50 55 Q65 60 80 50" stroke="white" stroke-width="2" fill="none"/>
                                <path d="M30 65 Q40 58 50 62 Q60 66 70 58" stroke="#00A651" stroke-width="2" fill="none"/>
                                <path d="M35 70 Q45 63 50 67 Q55 71 65 63" stroke="#00A651" stroke-width="2" fill="none"/>
                            </svg>
                            <div class="hidden sm:block">
                                <h1 class="text-lg font-bold text-gray-900 leading-tight">SISTEM INFORMASI ORMADA</h1>
                                <p class="text-xs text-gray-600 leading-tight">Temanggung Lintas Kampus</p>
                            </div>
                        </div>
                    </a>

                    <!-- Navigation -->
                    <nav class="hidden lg:flex items-center gap-8">
                        <a href="{{ route('public.home') }}" class="text-sm font-medium text-gray-700 hover:text-blue-700 transition">Beranda</a>
                        <a href="{{ route('public.aspirasi') }}" class="text-sm font-medium text-gray-700 hover:text-blue-700 transition">Aspirasi</a>
                        <a href="{{ route('public.postingan') }}" class="text-sm font-medium text-gray-700 hover:text-blue-700 transition">Berita</a>
                        <a href="{{ route('public.agenda') }}" class="text-sm font-medium text-gray-700 hover:text-blue-700 transition">Agenda</a>
                    </nav>

                    <!-- Contact Button -->
                    <div class="flex items-center gap-3">
                        <a href="mailto:info@ormada-temanggung.id" class="hidden md:inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contact Center
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-800 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-800 transition">Login</a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-btn" class="lg:hidden text-gray-700 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile menu -->
                <div id="mobile-menu" class="hidden lg:hidden pb-4 border-t border-gray-200">
                    <a href="{{ route('public.home') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Beranda</a>
                    <a href="{{ route('public.aspirasi') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Aspirasi</a>
                    <a href="{{ route('public.postingan') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Berita</a>
                    <a href="{{ route('public.agenda') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Agenda</a>
                    <a href="mailto:info@ormada-temanggung.id" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Contact Center</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 text-sm font-medium text-gray-700 hover:text-blue-700">Login</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
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
                            <li><a href="{{ route('public.home') }}" class="text-sm text-gray-400 hover:text-white transition">Beranda</a></li>
                            <li><a href="{{ route('public.aspirasi') }}" class="text-sm text-gray-400 hover:text-white transition">Aspirasi</a></li>
                            <li><a href="{{ route('public.postingan') }}" class="text-sm text-gray-400 hover:text-white transition">Berita & Pengumuman</a></li>
                            <li><a href="{{ route('public.agenda') }}" class="text-sm text-gray-400 hover:text-white transition">Agenda Kegiatan</a></li>
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
                    <p class="text-sm text-center text-gray-400">© {{ date('Y') }} SI Ormada Temanggung. Hak Cipta Dilindungi.</p>
                </div>
            </div>

            @stack('scripts')
    </div>
</body>
</html>
