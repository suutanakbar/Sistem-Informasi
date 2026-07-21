<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Ormada') }}</title>
    @stack('styles')
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-zinc-50 text-zinc-950 theme-admin">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 border-r border-zinc-200 bg-slate-800 text-white">
            <div class="p-4">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold">SI Ormada</a>
                <p class="mt-1 text-xs text-slate-300">Admin Panel</p>
            </div>
            
            <nav class="mt-4 px-2">
                @include('components.layouts.sidebar-admin')
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col">
            <!-- Header -->
            <header class="border-b border-zinc-200 bg-white">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-lg font-semibold">{{ $headerTitle ?? 'Dashboard' }}</h1>
                    <div class="flex items-center gap-4">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">Admin</span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm">{{ auth()->user()->nama }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="rounded-md px-3 py-2 text-sm hover:bg-zinc-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-6">
                @if (session('status'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-semibold">Ada input yang perlu dicek.</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>