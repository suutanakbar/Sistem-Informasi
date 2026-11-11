<footer class="mt-12 border-t-2 border-black bg-white">
    <div class="max-w-7xl mx-auto px-4 py-6">

        <div class="grid grid-cols-1 md:grid-cols-[1.1fr_2fr] gap-8 md:divide-x md:divide-gray-200 border-b border-gray-200 pb-6">

            
            <div class="text-center md:text-left">
                <h2 class="text-xl lg:text-2xl font-black tracking-[4px]" style="font-family:'Playfair Display',serif;">
                    SI ORMADA
                </h2>
                <p class="mt-0.5 uppercase tracking-[3px] text-[10px] text-gray-500">
                    Temanggung
                </p>
                <p class="text-gray-500 leading-5 text-xs mt-3 max-w-sm mx-auto md:mx-0">
                    Sistem Informasi Organisasi Mahasiswa Daerah Kabupaten
                    Temanggung yang menyediakan informasi berita, agenda,
                    profil organisasi mahasiswa, serta layanan aspirasi
                    sebagai media komunikasi antara mahasiswa dan pemerintah
                    daerah.
                </p>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:pl-8">

                <div class="text-center sm:text-left">
                    <div class="uppercase tracking-widest text-[11px] font-semibold text-gray-900 mb-2">
                        Navigasi
                    </div>
                    <div class="flex flex-col gap-1.5 text-xs text-gray-500">
                        <a href="<?php echo e(route('public.home')); ?>" class="hover:text-blue-700 transition">Beranda</a>
                        <a href="<?php echo e(route('public.aspirasi')); ?>" class="hover:text-blue-700 transition">Aspirasi</a>
                        <a href="<?php echo e(route('public.agenda')); ?>" class="hover:text-blue-700 transition">Agenda</a>
                        <a href="<?php echo e(route('public.postingan')); ?>" class="hover:text-blue-700 transition">Berita</a>
                        <a href="<?php echo e(route('public.ormada')); ?>" class="hover:text-blue-700 transition">Profil Ormada</a>
                    </div>
                </div>

                <div class="text-center sm:text-left">
                    <div class="uppercase tracking-widest text-[11px] font-semibold text-gray-900 mb-2">
                        Layanan
                    </div>
                    <div class="flex flex-col gap-1.5 text-xs text-gray-500">
                        <a href="<?php echo e(route('public.agenda')); ?>" class="hover:text-blue-700 transition">Daftar volunteer</a>
                        <a href="<?php echo e(route('public.aspirasi')); ?>" class="hover:text-blue-700 transition">Aspirasi masyarakat</a>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="hover:text-blue-700 transition">Ajukan proposal</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="hover:text-blue-700 transition">Ajukan proposal</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="text-center sm:text-left">
                    <div class="uppercase tracking-widest text-[11px] font-semibold text-gray-900 mb-2">
                        Kontak
                    </div>
                    <div class="flex flex-col gap-1.5 text-xs text-gray-500">
                        <span>Temanggung, Jawa Tengah</span>
                        <a href="mailto:info@ormadatemanggung.go.id" class="hover:text-blue-700 transition">info@ormadatemanggung.go.id</a>
                    </div>
                </div>

            </div>

        </div>

        
        <div class="flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-gray-500 mt-4">
            <div>
                © <?php echo e(date('Y')); ?> SI Ormada Temanggung
            </div>
            <div class="flex items-center gap-4">
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
                <a href="#" class="text-[10px] uppercase tracking-widest hover:text-gray-900 transition">Pemkab Temanggung</a>
            </div>
        </div>

    </div>
</footer><?php /**PATH C:\Users\User\OneDrive\Documents\GitHub\magang\resources\views/components/footer.blade.php ENDPATH**/ ?>