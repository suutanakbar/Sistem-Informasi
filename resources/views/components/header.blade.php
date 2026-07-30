<header class="bg-white relative z-10">

    {{-- TOP BAR --}}
    <div class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex items-center justify-between h-7">

                {{-- Left --}}
                <div class="flex items-center gap-3 text-[10px] uppercase tracking-widest text-gray-400">
                    <span>{{ now()->format('l, d F Y') }}</span>
                    <span class="w-px h-3 bg-gray-300"></span>
                    <span>Temanggung</span>
                </div>

                {{-- Center --}}
                <div class="hidden lg:block">
                    <span class="text-[10px] uppercase tracking-[3px] font-medium text-gray-400">
                        Sistem Informasi Organisasi Mahasiswa Daerah
                    </span>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-[10px] uppercase tracking-widest font-semibold hover:text-blue-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] uppercase tracking-widest font-semibold hover:text-blue-700 transition">
                            Login
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>

    {{-- MAIN HEADER --}}
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-3">
            <div class="grid grid-cols-3 items-center">

                {{-- Search --}}
                <div class="flex items-center">
                    <label class="group flex items-center gap-2 border-b border-gray-300 pb-1 w-full max-w-[140px] focus-within:border-gray-900 transition">
                        <svg class="w-3.5 h-3.5 text-gray-400 group-focus-within:text-gray-900 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.2-5.2M10.8 18a7.2 7.2 0 100-14.4 7.2 7.2 0 000 14.4z"/>
                        </svg>
                        <input
                            type="text"
                            placeholder="Search"
                            class="w-full text-[10px] uppercase tracking-widest text-gray-500 placeholder-gray-400 bg-transparent border-0 focus:ring-0 p-0"
                        >
                    </label>
                </div>

                {{-- Logo --}}
                <div class="text-center">
                    <a href="{{ route('public.home') }}">
                        <h1 class="text-xl lg:text-2xl font-black tracking-[4px] lg:tracking-[7px]" style="font-family:'Playfair Display',serif;">
                            SI ORMADA
                        </h1>
                        <div class="mt-0.5 uppercase tracking-[2px] text-[10px] text-gray-500">
                            Temanggung
                        </div>
                    </a>
                </div>

                {{-- Social --}}
                <div class="flex items-center justify-end gap-4">
                    <a href="#" aria-label="Facebook" class="text-gray-500 hover:text-gray-900 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12a10 10 0 10-11.5 9.9v-7H7.9V12h2.6V9.8c0-2.6 1.5-4 3.9-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0022 12z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="text-gray-500 hover:text-gray-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" stroke="none"/>
                        </svg>
                    </a>
                    <a href="mailto:info@ormadatemanggung.go.id" aria-label="Email" class="text-gray-500 hover:text-gray-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- NAVIGATION --}}
    <nav class="border-t border-gray-200">
        <div class="mx-auto max-w-7xl">
            <ul class="flex justify-center gap-8 text-[10px] py-2">
                <li>
                    <a href="{{ route('public.home') }}" class="uppercase tracking-widest font-semibold text-gray-700 hover:text-gray-900 transition">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.aspirasi') }}" class="uppercase tracking-widest font-semibold text-gray-700 hover:text-gray-900 transition">
                        Aspirasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.agenda') }}" class="uppercase tracking-widest font-semibold text-gray-700 hover:text-gray-900 transition">
                        Agenda
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.postingan') }}" class="uppercase tracking-widest font-semibold text-gray-700 hover:text-gray-900 transition">
                        Berita
                    </a>
                </li>
                <li>
                    <a href="{{ route('public.ormada') }}" class="uppercase tracking-widest font-semibold text-gray-700 hover:text-gray-900 transition">
                        Profil Ormada
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="border-b border-gray-900"></div>

</header>