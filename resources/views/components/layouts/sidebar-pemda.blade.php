<nav class="space-y-1">
    <a href="{{ route('dashboard') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('dashboard') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        Dashboard
    </a>

    <div class="border-t border-emerald-700 pt-2 mt-2">
        <p class="px-3 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Manajemen Kegiatan</p>
    </div>

    <a href="{{ route('agenda.index') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('agenda.*') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        Buat Agenda
    </a>

    <a href="{{ route('volunteer.index') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('volunteer.*') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        Kelola Volunteer
    </a>

    <a href="{{ route('postingan.index') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('postingan.*') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v1"></path>
        </svg>
        Buat Postingan/Berita
    </a>

    <div class="border-t border-emerald-700 pt-2 mt-2">
        <p class="px-3 text-xs font-semibold text-emerald-300 uppercase tracking-wider">Monitoring</p>
    </div>

    <a href="{{ route('profil-ormada.index') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('profil-ormada.*') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        Daftar Ormada
    </a>

    <a href="{{ route('proposal.index') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('proposal.*') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Proposal
    </a>

    <a href="{{ route('aspirasi.index') }}" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700 {{ request()->routeIs('aspirasi.*') ? 'bg-emerald-700' : '' }}">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
        Aspirasi
    </a>
</nav>