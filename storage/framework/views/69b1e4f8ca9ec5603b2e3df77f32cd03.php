<?php
    $headerTitle = 'Kelola Volunteer';
?>
<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Kelola Volunteer','headerTitle' => ''.e($headerTitle).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Volunteer','headerTitle' => ''.e($headerTitle).'']); ?>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Daftar Volunteer</h2>
                <p class="mt-1 text-sm text-zinc-500">Kelola pendaftaran volunteer untuk agenda kegiatan.</p>
            </div>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white overflow-hidden">
            <table class="min-w-full divide-y divide-zinc-200">
                <thead class="bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">No. Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Agenda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Ormada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    <?php $__empty_1 = true; $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-zinc-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900">
                                <?php echo e($volunteer->nama); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                <?php echo e($volunteer->email); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                <?php echo e($volunteer->no_telepon); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                <?php echo e($volunteer->agenda->nama_agenda ?? 'N/A'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                <?php echo e($volunteer->agenda->admin->nama ?? 'Umum'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($volunteer->status === 'menunggu'): ?>
                                    <span class="inline-flex rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">Menunggu</span>
                                <?php elseif($volunteer->status === 'diterima'): ?>
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Diterima</span>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-zinc-500">Belum ada pendaftar volunteer.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $attributes = $__attributesOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $component = $__componentOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__componentOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php /**PATH C:\project\magang\resources\views/volunteer/index.blade.php ENDPATH**/ ?>