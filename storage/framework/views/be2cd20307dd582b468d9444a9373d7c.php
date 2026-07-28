<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Proposal Saya','headerTitle' => 'Proposal Saya']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Proposal Saya','headerTitle' => 'Proposal Saya']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Proposal Saya</h1>
            <a href="<?php echo e(route('proposal.create')); ?>" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700">
                Buat Proposal
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Kegiatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dinas Tujuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Bantuan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo e($proposal->judul_kegiatan); ?></div>
                            <div class="text-sm text-gray-500">Anggaran: Rp <?php echo e(number_format($proposal->anggaran_dibutuhkan, 0, ',', '.')); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($proposal->dinasTujuan->nama); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e(ucfirst($proposal->jenis_bantuan)); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                            $statusColors = [
                            'diajukan' => 'bg-yellow-100 text-yellow-800',
                            'diproses_pemda' => 'bg-blue-100 text-blue-800',
                            'dana_cair' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            ];
                            ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($statusColors[$proposal->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e(ucfirst($proposal->status)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e($proposal->dibuat_pada->format('d M Y')); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="<?php echo e(route('proposal.show', $proposal)); ?>" class="text-orange-600 hover:text-orange-900">Detail</a>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $proposal)): ?>
                            <form method="POST" action="<?php echo e(route('proposal.destroy', $proposal)); ?>" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proposal ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-3">
                                    Hapus
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada proposal.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($proposals->links()); ?>

        </div>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $attributes = $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e)): ?>
<?php $component = $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e; ?>
<?php unset($__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pengurus/proposal/index.blade.php ENDPATH**/ ?>