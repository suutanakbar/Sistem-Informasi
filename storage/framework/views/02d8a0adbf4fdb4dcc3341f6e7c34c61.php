<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Detail Proposal','headerTitle' => 'Detail Proposal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Proposal','headerTitle' => 'Detail Proposal']); ?>
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Proposal</h1>
            <div class="flex gap-2">
                <a href="<?php echo e(route('proposal.index')); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Proposal</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Judul Kegiatan</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($proposal->judul_kegiatan); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dinas Tujuan</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($proposal->dinasTujuan->nama); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jenis Bantuan</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e(ucfirst($proposal->jenis_bantuan)); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Anggaran Dibutuhkan</dt>
                                <dd class="mt-1 text-sm text-gray-900">Rp <?php echo e(number_format($proposal->anggaran_dibutuhkan, 0, ',', '.')); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tanggal Diajukan</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($proposal->dibuat_pada->format('d F Y H:i')); ?></dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Proposal</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <?php
                            $statusColors = [
                            'diajukan' => 'bg-yellow-100 text-yellow-800',
                            'diproses_pemda' => 'bg-blue-100 text-blue-800',
                            'dana_cair' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800',
                            ];
                            ?>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full <?php echo e($statusColors[$proposal->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e(ucfirst($proposal->status)); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Deskripsi Kegiatan</h3>
                    <div class="prose max-w-none text-sm text-gray-700">
                        <?php echo nl2br(e($proposal->deskripsi_kegiatan)); ?>

                    </div>
                </div>

                <?php if($proposal->catatan_pemda): ?>
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Catatan Pemda</h3>
                    <div class="bg-orange-50 border-l-4 border-orange-400 p-4">
                        <div class="text-sm text-gray-700">
                            <?php echo nl2br(e($proposal->catatan_pemda)); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">File Proposal</h3>
                    <a href="<?php echo e(asset('storage/' . $proposal->file_proposal)); ?>" target="_blank"
                        class="inline-flex items-center text-orange-600 hover:text-orange-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Proposal
                    </a>
                </div>
            </div>
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pengurus/proposal/show.blade.php ENDPATH**/ ?>