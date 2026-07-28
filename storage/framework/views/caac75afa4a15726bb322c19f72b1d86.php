<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => ''.e($agenda->nama_agenda).'','headerTitle' => 'Detail Agenda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($agenda->nama_agenda).'','headerTitle' => 'Detail Agenda']); ?>
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Agenda</h1>
            <div class="flex gap-2">
                <a href="<?php echo e(route('agenda.edit', $agenda)); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Edit Agenda
                </a>
                <a href="<?php echo e(route('agenda.index')); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <?php if($agenda->gambar_poster): ?>
                <img src="<?php echo e(asset('storage/' . $agenda->gambar_poster)); ?>" alt="<?php echo e($agenda->nama_agenda); ?>" class="w-full h-96 object-cover rounded-lg mb-6">
                <?php endif; ?>

                <div class="flex items-center gap-2 mb-4">
                    <span class="px-3 py-1 text-sm font-medium bg-purple-100 text-purple-800 rounded-full">
                        <?php echo e(ucfirst(str_replace('_', ' ', $agenda->kategori))); ?>

                    </span>
                    <?php if($agenda->is_published): ?>
                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                        Published
                    </span>
                    <?php else: ?>
                    <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">
                        Draft
                    </span>
                    <?php endif; ?>
                    <?php if($agenda->kuota_volunteer): ?>
                    <span class="px-3 py-1 text-sm font-medium bg-orange-100 text-orange-800 rounded-full">
                        Volunteer (<?php echo e($volunteerDiterima); ?>/<?php echo e($agenda->kuota_volunteer); ?>)
                    </span>
                    <?php endif; ?>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-4"><?php echo e($agenda->nama_agenda); ?></h2>

                <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-200">
                    <span>Oleh: <?php echo e($agenda->admin->nama); ?></span>
                    <span>•</span>
                    <span><?php echo e($agenda->dibuat_pada->format('d F Y H:i')); ?></span>
                    <?php if($agenda->tanggal_publish): ?>
                    <span>•</span>
                    <span>Dipublikasi: <?php echo e($agenda->tanggal_publish->format('d F Y H:i')); ?></span>
                    <?php endif; ?>
                </div>

                <div class="prose max-w-none text-gray-700 whitespace-pre-line mb-6">
                    <?php echo e($agenda->deskripsi_agenda); ?>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="font-medium">Waktu Mulai</p>
                            <p><?php echo e($agenda->waktu_mulai->format('d F Y H:i')); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium">Waktu Selesai</p>
                            <p><?php echo e($agenda->waktu_selesai->format('d F Y H:i')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <p class="font-medium">Tempat</p>
                        <p><?php echo e($agenda->tempat); ?></p>
                    </div>
                </div>

                <?php if($agenda->kuota_volunteer): ?>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Pendaftaran Volunteer</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-blue-700">Kuota</p>
                            <p class="font-semibold"><?php echo e($agenda->kuota_volunteer); ?> orang</p>
                        </div>
                        <div>
                            <p class="text-blue-700">Terdaftar</p>
                            <p class="font-semibold"><?php echo e($volunteerDiterima); ?> orang</p>
                        </div>
                        <div>
                            <p class="text-blue-700">Deadline</p>
                            <p class="font-semibold"><?php echo e($agenda->deadline_pendaftaran->format('d F Y H:i')); ?></p>
                        </div>
                        <div>
                            <p class="text-blue-700">Sisa Kuota</p>
                            <p class="font-semibold"><?php echo e($agenda->kuota_volunteer - $volunteerDiterima); ?> orang</p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(!$agenda->is_published): ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-sm text-yellow-800 mb-3">Agenda ini masih dalam status draft.</p>
            <form method="POST" action="<?php echo e(route('agenda.publish', $agenda)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Publikasikan Agenda
                </button>
            </form>
        </div>
        <?php endif; ?>

        <?php if($agenda->kuota_volunteer): ?>
        <section class="mt-6 rounded-lg border border-zinc-200 bg-white">
            <div class="border-b border-zinc-200 px-5 py-4">
                <h2 class="font-semibold text-lg">Daftar Volunteer</h2>
            </div>

            <!-- Search and Filter -->
            <div class="px-5 py-3 bg-gray-50 border-b border-zinc-200">
                <form method="GET" action="<?php echo e(route('agenda.show', $agenda)); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label for="search_volunteer" class="block text-sm font-medium text-gray-700">Cari Volunteer</label>
                        <input type="text" name="search_volunteer" id="search_volunteer" value="<?php echo e(request('search_volunteer')); ?>" placeholder="Nama, Email, atau No. Telepon..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="status_volunteer" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status_volunteer" id="status_volunteer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="menunggu" <?php echo e(request('status_volunteer') === 'menunggu' ? 'selected' : ''); ?>>Menunggu</option>
                            <option value="diterima" <?php echo e(request('status_volunteer') === 'diterima' ? 'selected' : ''); ?>>Diterima</option>
                            <option value="ditolak" <?php echo e(request('status_volunteer') === 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Volunteer Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 text-sm">
                    <thead class="bg-zinc-50 text-left text-zinc-600">
                        <tr>
                            <th class="px-5 py-3">Nama</th>
                            <th class="px-5 py-3">Email</th>
                            <th class="px-5 py-3">No. Telepon</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-5 py-3 font-medium"><?php echo e($volunteer->nama); ?></td>
                                <td class="px-5 py-3"><?php echo e($volunteer->email); ?></td>
                                <td class="px-5 py-3"><?php echo e($volunteer->no_telepon); ?></td>
                                <td class="px-5 py-3">
                                    <?php if($volunteer->status === 'menunggu'): ?>
                                        <span class="inline-flex rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">Menunggu</span>
                                    <?php elseif($volunteer->status === 'diterima'): ?>
                                        <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Diterima</span>
                                    <?php else: ?>
                                        <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-3 text-right text-sm font-medium">
                                    <?php if($volunteer->status === 'menunggu'): ?>
                                        <form action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Terima volunteer ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="status" value="diterima">
                                            <button type="submit" class="text-green-600 hover:text-green-900">Terima</button>
                                        </form>
                                        <form action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" method="POST" class="inline-block ml-2" onsubmit="return confirm('Tolak volunteer ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-zinc-400">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-5 py-6 text-center text-zinc-500">
                                    Belum ada pendaftar volunteer.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($volunteers->hasPages()): ?>
            <div class="mt-4 px-4 py-3">
                <?php echo e($volunteers->links()); ?>

            </div>
            <?php endif; ?>
        </section>
        <?php endif; ?>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php /**PATH C:\project\magang\resources\views/admin/agenda/show.blade.php ENDPATH**/ ?>