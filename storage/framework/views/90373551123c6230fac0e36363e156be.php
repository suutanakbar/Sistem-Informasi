<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Detail Profil Ormada','headerTitle' => 'Detail Profil Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Profil Ormada','headerTitle' => 'Detail Profil Ormada']); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => ''.e($profilOrmada->nama_universitas).'','description' => ''.e($profilOrmada->alamat_universitas).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($profilOrmada->nama_universitas).'','description' => ''.e($profilOrmada->alamat_universitas).'']); ?>
        <?php if(auth()->user()->isAdmin() || auth()->id() === $profilOrmada->admin_id): ?>
            <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('profil-ormada.edit', $profilOrmada)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profil-ormada.edit', $profilOrmada)).'']); ?>Edit Profil <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $attributes = $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $component = $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    <!-- Profil Section -->
    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <section class="rounded-lg border border-zinc-200 bg-white p-6">
            <div class="flex flex-col gap-5 sm:flex-row">
                <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-lg bg-zinc-100 text-xl font-semibold text-zinc-600">
                    <?php if($profilOrmada->logo): ?>
                        <img src="<?php echo e(asset('storage/'.$profilOrmada->logo)); ?>" alt="Logo <?php echo e($profilOrmada->nama_universitas); ?>" class="h-24 w-24 rounded-lg object-cover">
                    <?php else: ?>
                        <?php echo e(strtoupper(substr($profilOrmada->nama_universitas, 0, 2))); ?>

                    <?php endif; ?>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500">Deskripsi</p>
                    <p class="mt-2 leading-7 text-zinc-700"><?php echo e($profilOrmada->deskripsi ?: 'Belum ada deskripsi.'); ?></p>
                </div>
            </div>
        </section>

        <aside class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Total mahasiswa universitas</p>
                <p class="mt-1 text-2xl font-semibold"><?php echo e(number_format($profilOrmada->total_mahasiswa_univ)); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Anggota terdata</p>
                <p class="mt-1 text-2xl font-semibold"><?php echo e($profilOrmada->anggota_count); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Pengurus aktif</p>
                <p class="mt-1 text-2xl font-semibold"><?php echo e($profilOrmada->pengurus_count); ?></p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-4">
                <p class="text-sm text-zinc-500">Mahasiswa</p>
                <p class="mt-1 text-2xl font-semibold"><?php echo e($profilOrmada->anggota_count - $profilOrmada->pengurus_count); ?></p>
            </div>
        </aside>
    </div>

    <!-- Anggota Section -->
    <section class="mt-6 rounded-lg border border-zinc-200 bg-white">
        <div class="border-b border-zinc-200 px-5 py-4 flex justify-between items-center">
            <h2 class="font-semibold text-lg">Daftar Anggota</h2>
            <?php if(auth()->user()->isAdmin() || auth()->user()->isPengurusOrmada()): ?>
            <a href="<?php echo e(route('anggota-ormada.create')); ?>" class="text-sm bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700">
                + Tambah Anggota
            </a>
            <?php endif; ?>
        </div>

        <!-- Search and Filter -->
        <div class="px-5 py-3 bg-gray-50 border-b border-zinc-200">
            <form method="GET" action="<?php echo e(route('profil-ormada.show', $profilOrmada)); ?>" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                    <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" placeholder="Nama, NIM, atau Program Studi..."
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="status_aktif" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status_aktif" id="status_aktif" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="fungsionaris" <?php echo e(request('status_aktif') === 'fungsionaris' ? 'selected' : ''); ?>>Fungsionaris</option>
                        <option value="mahasiswa" <?php echo e(request('status_aktif') === 'mahasiswa' ? 'selected' : ''); ?>>Mahasiswa</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Anggota Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 text-sm">
                <thead class="bg-zinc-50 text-left text-zinc-600">
                    <tr>
                        <th class="px-5 py-3">Nama</th>
                        <th class="px-5 py-3">Program Studi</th>
                        <th class="px-5 py-3">Angkatan</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    <?php $__empty_1 = true; $__currentLoopData = $anggotaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-5 py-3 font-medium"><?php echo e($anggota->nama_lengkap); ?></td>
                            <td class="px-5 py-3"><?php echo e($anggota->program_studi); ?></td>
                            <td class="px-5 py-3"><?php echo e($anggota->angkatan ?? '-'); ?></td>
                            <td class="px-5 py-3 text-right text-sm font-medium">
                                <?php if(auth()->guard()->check()): ?>
                                    <a href="<?php echo e(route('anggota-ormada.show', $anggota)); ?>" class="text-indigo-600 hover:text-indigo-900">
                                        Detail
                                    </a>
                                    <?php if(auth()->user()->isAdmin() || auth()->user()->isPengurusOrmada()): ?>
                                    <span class="mx-2">|</span>
                                    <a href="<?php echo e(route('anggota-ormada.edit', $anggota)); ?>" class="text-green-600 hover:text-green-900">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('anggota-ormada.destroy', $anggota)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                            Hapus
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-5 py-6 text-center text-zinc-500">
                                Belum ada anggota.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($anggotaList->hasPages()): ?>
        <div class="mt-4 px-4 py-3">
            <?php echo e($anggotaList->links()); ?>

        </div>
        <?php endif; ?>
    </section>
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
<?php /**PATH C:\project\magang\resources\views/profil_ormada/show.blade.php ENDPATH**/ ?>