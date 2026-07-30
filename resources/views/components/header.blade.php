<header class="bg-white sticky top-0 z-50">
<!-- ========================= -->
<!-- TOP BAR -->
<!-- ========================= -->

<div class="border-b border-gray-300 bg-white">

    <div class="mx-auto max-w-7xl px-4">

        <div class="flex items-center justify-between h-8">

            <!-- Left -->

            <div class="flex items-center gap-3 text-[11px] uppercase tracking-widest text-gray-500">

                <span>{{ now()->format('l, d F Y') }}</span>

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

                @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="text-xs uppercase tracking-widest font-semibold hover:text-blue-700 transition">

                    Dashboard

                </a>

                @else

                <a
                    href="{{ route('login') }}"
                    class="text-xs uppercase tracking-widest font-semibold hover:text-blue-700 transition">

                    Login

                </a>

                @endauth

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

                <a href="{{ route('public.home') }}">

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
                <a href="{{ route('public.home') }}"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Beranda

                </a>
            </li>

            <li>
                <a href="{{ route('public.aspirasi') }}"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Aspirasi

                </a>
            </li>

            <li>
                <a href="{{ route('public.agenda') }}"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Agenda

                </a>
            </li>

            <li>
                <a href="{{ route('public.postingan') }}"
                    class="block px-2 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Berita

                </a>
            </li>

            <li>
                <a href="{{ route('public.ormada') }}"
                    class="block px-4 py-1.5 uppercase tracking-widest font-bold hover:bg-black hover:text-white transition">

                    Profil Ormada

                </a>
            </li>

        </ul>

    </div>

</nav>
</header>