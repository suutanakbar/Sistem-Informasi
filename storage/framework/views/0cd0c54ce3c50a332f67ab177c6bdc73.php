
<?php $__env->startSection('title', $agenda->nama_agenda . ' - SI Ormada Temanggung'); ?>
<?php $__env->startSection('content'); ?>
            <!-- Page Header -->
            <section class="hero-gradient text-white py-12 sm:py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <a href="<?php echo e(route('public.agenda')); ?>" class="inline-flex items-center text-sm text-blue-100 hover:text-white mb-4 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Agenda Kegiatan
                    </a>
                    <div class="max-w-4xl">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-3 py-1 text-xs font-semibold bg-white/20 text-white rounded-full border border-white/30">
                                <?php echo e(ucfirst(str_replace('_', ' ', $agenda->kategori))); ?>

                            </span>
                            <?php if($agenda->kuota_volunteer): ?>
                            <span class="px-3 py-1 text-xs font-semibold bg-orange-400 text-white rounded-full border border-orange-300">
                                Volunteer
                            </span>
                            <?php endif; ?>
                        </div>
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4"><?php echo e($agenda->nama_agenda); ?></h2>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-blue-100">
                            <span>Oleh: <?php echo e($agenda->admin->nama); ?></span>
                            <span>•</span>
                            <span><?php echo e($agenda->dibuat_pada->format('d F Y H:i')); ?></span>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Agenda Detail -->
            <section class="bg-gray-50 py-12 sm:py-16">
                <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                        <?php if($agenda->gambar_poster): ?>
                        <img src="<?php echo e(storage_url($agenda->gambar_poster)); ?>" alt="<?php echo e($agenda->nama_agenda); ?>" class="w-full h-96 object-cover">
                        <?php endif; ?>
                        
                        <div class="p-6 sm:p-8">
                            <!-- Description -->
                            <div class="prose max-w-none text-gray-700 whitespace-pre-line mb-8 text-base leading-relaxed">
                                <?php echo e($agenda->deskripsi_agenda); ?>

                            </div>

                            <!-- Info Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pb-8 border-b border-gray-200">
                                <div class="flex items-start gap-3">
                                    <div class="bg-blue-50 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Waktu Mulai</p>
                                        <p class="text-sm text-gray-600 mt-1"><?php echo e($agenda->waktu_mulai->format('d F Y H:i')); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="bg-blue-50 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Waktu Selesai</p>
                                        <p class="text-sm text-gray-600 mt-1"><?php echo e($agenda->waktu_selesai->format('d F Y H:i')); ?></p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 md:col-span-2">
                                    <div class="bg-blue-50 rounded-lg p-3">
                                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Tempat</p>
                                        <p class="text-sm text-gray-600 mt-1"><?php echo e($agenda->tempat); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Volunteer Registration -->
                            <?php if($agenda->kuota_volunteer): ?>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6 mb-6">
                                <h3 class="text-xl font-bold text-blue-900 mb-4">Pendaftaran Volunteer</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div class="bg-white rounded-lg p-4 border border-blue-200">
                                        <p class="text-xs text-blue-700 font-medium mb-1">Kuota</p>
                                        <p class="text-2xl font-bold text-blue-900"><?php echo e($agenda->kuota_volunteer); ?></p>
                                        <p class="text-xs text-gray-500">orang</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-blue-200">
                                        <p class="text-xs text-blue-700 font-medium mb-1">Terdaftar</p>
                                        <p class="text-2xl font-bold text-blue-900"><?php echo e($volunteerDiterima); ?></p>
                                        <p class="text-xs text-gray-500">orang</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-blue-200">
                                        <p class="text-xs text-blue-700 font-medium mb-1">Sisa Kuota</p>
                                        <p class="text-2xl font-bold text-blue-900"><?php echo e($agenda->kuota_volunteer - $volunteerDiterima); ?></p>
                                        <p class="text-xs text-gray-500">orang</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-blue-200">
                                        <p class="text-xs text-blue-700 font-medium mb-1">Deadline</p>
                                        <p class="text-sm font-bold text-blue-900"><?php echo e($agenda->deadline_pendaftaran->format('d M Y')); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($agenda->deadline_pendaftaran->format('H:i')); ?></p>
                                    </div>
                                </div>

                                <?php if($agenda->deadline_pendaftaran >= now() && $volunteerDiterima < $agenda->kuota_volunteer): ?>
                                <div class="bg-white border border-gray-200 rounded-lg p-6">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-4">Daftar Sebagai Volunteer</h4>
                                    
                                    <?php if(session('success')): ?>
                                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                                        <?php echo e(session('success')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <?php if(session('error')): ?>
                                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <form method="POST" action="<?php echo e(route('agenda.daftar-volunteer', $agenda)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="space-y-4">
                                            <div>
                                                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                                <input type="text" name="nama" id="nama" required
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    placeholder="Masukkan nama lengkap Anda">
                                            </div>

                                            <div>
                                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                                <input type="email" name="email" id="email" required
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    placeholder="contoh@email.com">
                                            </div>

                                            <div>
                                                <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                                                <input type="text" name="no_hp" id="no_hp" required
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    placeholder="Masukkan nomor HP Anda">
                                            </div>

                                            <div>
                                                <label for="alasan" class="block text-sm font-semibold text-gray-700 mb-2">Alasan Bergabung (Opsional)</label>
                                                <textarea name="alasan" id="alasan" rows="4"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                    placeholder="Ceritakan mengapa Anda ingin menjadi volunteer..."></textarea>
                                            </div>

                                            <button type="submit" 
                                                class="w-full bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                                                Daftar Volunteer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <?php elseif($agenda->deadline_pendaftaran < now()): ?>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <p class="text-yellow-800 font-medium">Pendaftaran volunteer sudah ditutup.</p>
                                </div>
                                <?php elseif($volunteerDiterima >= $agenda->kuota_volunteer): ?>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <p class="text-yellow-800 font-medium">Kuota volunteer sudah penuh.</p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/agenda-show.blade.php ENDPATH**/ ?>