<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Ormada') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-zinc-50 text-zinc-950">
    <div class="min-h-screen">
        <header class="border-b border-zinc-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold">SI Ormada</a>
                <nav class="flex items-center gap-2 text-sm">
                    <a href="{{ route('dashboard') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Dashboard</a>
                    <a href="{{ route('profil-ormada.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Profil Ormada</a>
                    <a href="{{ route('proposal.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Proposal</a>
                    <a href="{{ route('aspirasi.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Aspirasi</a>
                    <a href="{{ route('postingan.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Postingan</a>
                    <a href="{{ route('agenda.index') }}" class="rounded-md px-3 py-2 hover:bg-zinc-100">Agenda</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-md px-3 py-2 text-left hover:bg-zinc-100">Keluar</button>
                    </form>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
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
</body>
</html>
