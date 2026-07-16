<nav class="space-y-1">
    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('dashboard') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        Dashboard
    </a>

    <a href="<?php echo e(route('profil-ormada.index')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('profil-ormada.*') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        Profil Ormada
    </a>

    <a href="<?php echo e(route('agenda.index')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('agenda.*') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        Agenda
    </a>

    <a href="<?php echo e(route('postingan.index')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('postingan.*') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9a2 2 0 00-2 2v1"></path>
        </svg>
        Postingan
    </a>

    <a href="<?php echo e(route('proposal.index')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('proposal.*') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Proposal
    </a>

    <a href="<?php echo e(route('aspirasi.index')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('aspirasi.*') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
        Aspirasi
    </a>

    <div class="border-t border-slate-700 pt-2 mt-2">
        <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">Manajemen</p>
    </div>

    <a href="<?php echo e(route('admin.index')); ?>" class="flex items-center rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-slate-700 <?php echo e(request()->routeIs('admin.*') ? 'bg-slate-700' : ''); ?>">
        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        Manajemen Admin
    </a>
</nav><?php /**PATH C:\project\magang\resources\views/components/layouts/sidebar-admin.blade.php ENDPATH**/ ?>