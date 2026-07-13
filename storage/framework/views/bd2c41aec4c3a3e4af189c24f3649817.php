<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Daftar Aspirasi','headerTitle' => 'Aspirasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Aspirasi','headerTitle' => 'Aspirasi']); ?>
    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Aspirasi</h1>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="p-4">
                <form method="GET" action="<?php echo e(route('aspirasi.index')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Status</option>
                            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php echo e(request('status') === $status ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topik Aspirasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ormada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $aspirasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aspirasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo e($aspirasi->topik_aspirasi); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo e($aspirasi->profilOrmada->nama_universitas); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                            $statusColors = [
                            'belum_ditanggapi' => 'bg-yellow-100 text-yellow-800',
                            'sedang_diproses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            ];
                            ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($statusColors[$aspirasi->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e(ucfirst(str_replace('_', ' ', $aspirasi->status))); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e($aspirasi->dibuat_pada->format('d M Y')); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="<?php echo e(route('aspirasi.show', $aspirasi)); ?>" class="text-emerald-600 hover:text-emerald-900">Detail</a>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $aspirasi)): ?>
                            <form method="POST" action="<?php echo e(route('aspirasi.destroy', $aspirasi)); ?>" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
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
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada aspirasi.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($aspirasis->links()); ?>

        </div>
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pemda/aspirasi/index.blade.php ENDPATH**/ ?>