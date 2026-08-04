<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Kelola Volunteer - SI Ormada Temanggung']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Volunteer - SI Ormada Temanggung']); ?>
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-gray-900">Kelola Volunteer</h1>
                <p class="mt-1 text-sm text-gray-600">Kelola pendaftaran volunteer untuk semua agenda kegiatan</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Total</p>
                    <p class="mt-1 text-xl font-bold text-gray-900"><?php echo e($volunteers->total()); ?></p>
                </div>
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Menunggu</p>
                    <p class="mt-1 text-xl font-bold text-yellow-900"><?php echo e($volunteers->where('status', 'pending')->count()); ?></p>
                </div>
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Diterima</p>
                    <p class="mt-1 text-xl font-bold text-green-900"><?php echo e($volunteers->where('status', 'diterima')->count()); ?></p>
                </div>
                <div class="bg-white border border-gray-200 rounded-sm p-3">
                    <p class="text-xs font-medium text-gray-600 uppercase">Ditolak</p>
                    <p class="mt-1 text-xl font-bold text-red-900"><?php echo e($volunteers->where('status', 'ditolak')->count()); ?></p>
                </div>
            </div>

            <!-- Volunteers Table -->
            <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-base font-semibold text-gray-900">Daftar Semua Volunteer</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Nama</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Email</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No. Telepon</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Agenda</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Ormada</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Alasan</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo e($volunteer->nama); ?>

                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($volunteer->email); ?>

                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($volunteer->no_hp); ?>

                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($volunteer->agenda->nama_agenda ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($volunteer->agenda->admin->nama ?? 'Umum'); ?>

                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <?php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'diterima' => 'bg-green-100 text-green-800 border border-green-200',
                                        'ditolak' => 'bg-red-100 text-red-800 border border-red-200',
                                    ];
                                    ?>
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($statusColors[$volunteer->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200'); ?>">
                                        <?php echo e(ucfirst($volunteer->status)); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                    <?php if($volunteer->status === 'ditolak'): ?>
                                        <?php echo e($volunteer->catatan_penolakan ?? '-'); ?>

                                    <?php else: ?>
                                        <?php echo e($volunteer->alasan ?? '-'); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <?php if($volunteer->status === 'pending'): ?>
                                <form method="POST" action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" class="inline" onsubmit="return confirm('Terima volunteer ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold mr-1">
                                        Terima
                                    </button>
                                </form>
                                <form method="POST" action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" class="inline" onsubmit="return confirm('Tolak volunteer ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                        Tolak
                                    </button>
                                </form>
                                <?php elseif($volunteer->status === 'diterima'): ?>
                                <form method="POST" action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" class="inline" onsubmit="return confirm('Tolak volunteer ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold mr-1">
                                        Tolak
                                    </button>
                                </form>
                                <form method="POST" action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" class="inline" onsubmit="return confirm('Batalkan penerimaan volunteer ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 font-semibold">
                                        Batalkan
                                    </button>
                                </form>
                                <?php elseif($volunteer->status === 'ditolak'): ?>
                                <form method="POST" action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" class="inline" onsubmit="return confirm('Terima volunteer ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="text-green-600 hover:text-green-900 font-semibold mr-1">
                                        Terima
                                    </button>
                                </form>
                                <form method="POST" action="<?php echo e(route('volunteer.update-status', $volunteer)); ?>" class="inline" onsubmit="return confirm('Batalkan penolakan volunteer ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 font-semibold">
                                        Batalkan
                                    </button>
                                </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Belum ada pendaftar volunteer.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($volunteers->hasPages()): ?>
                <div class="mt-4 px-4 py-3 border-t border-gray-200 bg-gray-50">
                    <?php echo e($volunteers->links()); ?>

                </div>
                <?php endif; ?>
            </div>
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
<?php /**PATH C:\project\magang\resources\views/volunteer/index-admin.blade.php ENDPATH**/ ?>