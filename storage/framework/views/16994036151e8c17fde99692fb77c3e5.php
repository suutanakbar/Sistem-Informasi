<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Detail Proposal','headerTitle' => 'Detail Proposal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Proposal','headerTitle' => 'Detail Proposal']); ?>
    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Proposal</h1>
                        <p class="mt-1 text-sm text-gray-600">Informasi lengkap proposal kegiatan</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="<?php echo e(route('proposal.edit', $proposal)); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-800 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Proposal
                        </a>
                        <a href="<?php echo e(route('proposal.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Proposal Information Card -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Proposal</h3>
                            <p class="text-sm text-gray-500">Data detail proposal kegiatan</p>
                        </div>
                    </div>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Judul Kegiatan</dt>
                            <dd class="mt-1 text-base font-semibold text-gray-900"><?php echo e($proposal->judul_kegiatan); ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Pengaju</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($proposal->pengaju->nama); ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Dinas Tujuan</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($proposal->dinasTujuan->nama); ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Jenis Bantuan</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <?php echo e(ucfirst($proposal->jenis_bantuan)); ?>

                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Anggaran Dibutuhkan</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">Rp <?php echo e(number_format($proposal->anggaran_dibutuhkan, 0, ',', '.')); ?></dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Tanggal Diajukan</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($proposal->dibuat_pada->format('d F Y H:i')); ?></dd>
                        </div>
                    </dl>
                </div>

                <!-- Status Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Status</h3>
                                <p class="text-sm text-gray-500">Status proposal saat ini</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <?php
                            $statusColors = [
                            'diajukan' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'diproses_pemda' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'dana_cair' => 'bg-green-100 text-green-800 border-green-200',
                            'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                            ];
                            ?>
                            <span class="inline-flex items-center justify-center w-full px-4 py-3 rounded-lg text-sm font-bold border <?php echo e($statusColors[$proposal->status] ?? 'bg-gray-100 text-gray-800 border-gray-200'); ?>">
                                <?php echo e(ucfirst($proposal->status)); ?>

                            </span>
                        </div>
                    </div>

                    <?php if(auth()->user()->isPemda() || auth()->user()->isAdmin()): ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Update Status</h3>
                                <p class="text-sm text-gray-500">Ubah status proposal</p>
                            </div>
                        </div>

                        <form method="POST" action="<?php echo e(route('proposal.update-status', $proposal)); ?>" class="space-y-4">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Baru</label>
                                <select name="status" id="status" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="diajukan" <?php echo e($proposal->status === 'diajukan' ? 'selected' : ''); ?>>Diajukan</option>
                                    <option value="diproses_pemda" <?php echo e($proposal->status === 'diproses_pemda' ? 'selected' : ''); ?>>Diproses Pemda</option>
                                    <option value="dana_cair" <?php echo e($proposal->status === 'dana_cair' ? 'selected' : ''); ?>>Dana Cair</option>
                                    <option value="ditolak" <?php echo e($proposal->status === 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                                </select>
                            </div>
                            <div>
                                <label for="catatan_pemda" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                                <textarea name="catatan_pemda" id="catatan_pemda" rows="3"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"><?php echo e(old('catatan_pemda', $proposal->catatan_pemda)); ?></textarea>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Update Status
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Description Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Deskripsi Kegiatan</h3>
                        <p class="text-sm text-gray-500">Detail deskripsi proposal</p>
                    </div>
                </div>
                <div class="prose max-w-none text-sm text-gray-700 bg-gray-50 rounded-lg p-4">
                    <?php echo nl2br(e($proposal->deskripsi_kegiatan)); ?>

                </div>
            </div>

            <!-- Catatan Pemda Section -->
            <?php if($proposal->catatan_pemda): ?>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Catatan Pemda</h3>
                        <p class="text-sm text-gray-500">Catatan dan feedback dari pemerintah daerah</p>
                    </div>
                </div>
                <div class="bg-blue-50 border-l-4 border-blue-400 rounded-lg p-4">
                    <div class="text-sm text-gray-700">
                        <?php echo nl2br(e($proposal->catatan_pemda)); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- File Proposal Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">File Proposal</h3>
                        <p class="text-sm text-gray-500">Download dokumen proposal</p>
                    </div>
                </div>
                <a href="<?php echo e(asset('storage/' . $proposal->file_proposal)); ?>" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download Proposal
                </a>
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
<?php /**PATH C:\project\magang\resources\views/admin/proposal/show.blade.php ENDPATH**/ ?>