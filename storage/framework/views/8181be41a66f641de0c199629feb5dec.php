<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Manajemen Admin','headerTitle' => 'Manajemen Admin']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Manajemen Admin','headerTitle' => 'Manajemen Admin']); ?>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Daftar Admin</h2>
                <p class="mt-1 text-sm text-zinc-500">Kelola akun admin, pemda, dan pengurus ormada.</p>
            </div>
            <a href="<?php echo e(route('admin.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Tambah Admin
            </a>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white overflow-hidden">
            <table class="min-w-full divide-y divide-zinc-200">
                <thead class="bg-zinc-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Peran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase">Terakhir Masuk</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-zinc-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-800"><?php echo e(substr($admin->nama, 0, 2)); ?></span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-zinc-900"><?php echo e($admin->nama); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500"><?php echo e($admin->email); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($admin->peran === 'admin'): ?>
                                    <span class="inline-flex rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">Admin</span>
                                <?php elseif($admin->peran === 'pemda'): ?>
                                    <span class="inline-flex rounded-full bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-800">Pemda</span>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full bg-orange-100 px-2 py-1 text-xs font-semibold text-orange-800">Pengurus Ormada</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500">
                                <?php echo e($admin->terakhir_masuk ? $admin->terakhir_masuk->format('d/m/Y H:i') : 'Belum pernah'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?php echo e(route('admin.edit', $admin)); ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <?php if($admin->id !== auth()->id()): ?>
                                    <form action="<?php echo e(route('admin.destroy', $admin)); ?>" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-zinc-500">Belum ada data admin.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/admin/index.blade.php ENDPATH**/ ?>