<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Detail Aspirasi','headerTitle' => 'Detail Aspirasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Detail Aspirasi','headerTitle' => 'Detail Aspirasi']); ?>
    <div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Detail Aspirasi</h1>
            <div class="flex gap-2">
                <a href="<?php echo e(route('aspirasi.index')); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Aspirasi</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Topik Aspirasi</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($aspirasi->topik_aspirasi); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Ormada Pengaju</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($aspirasi->profilOrmada->nama_universitas); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <?php
                                    $statusColors = [
                                    'belum_ditanggapi' => 'bg-yellow-100 text-yellow-800',
                                    'sedang_diproses' => 'bg-blue-100 text-blue-800',
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'ditolak' => 'bg-red-100 text-red-800',
                                    ];
                                    ?>
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full <?php echo e($statusColors[$aspirasi->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $aspirasi->status))); ?>

                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tanggal Diajukan</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo e($aspirasi->dibuat_pada->format('d F Y H:i')); ?></dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tanggapan Pemda</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <form method="POST" action="<?php echo e(route('aspirasi.update-tanggapan', $aspirasi)); ?>" class="space-y-3">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <div>
                                    <label for="tanggapan_pemda" class="block text-sm font-medium text-gray-700">Tanggapan</label>
                                    <textarea name="tanggapan_pemda" id="tanggapan_pemda" rows="4" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><?php echo e(old('tanggapan_pemda', $aspirasi->tanggapan_pemda)); ?></textarea>
                                    <?php $__errorArgs = ['tanggapan_pemda'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="belum_ditanggapi" <?php echo e($aspirasi->status === 'belum_ditanggapi' ? 'selected' : ''); ?>>Belum Ditanggapi</option>
                                        <option value="sedang_diproses" <?php echo e($aspirasi->status === 'sedang_diproses' ? 'selected' : ''); ?>>Sedang Diproses</option>
                                        <option value="selesai" <?php echo e($aspirasi->status === 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                        <option value="ditolak" <?php echo e($aspirasi->status === 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
                                    Simpan Tanggapan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Detail Aspirasi</h3>
                    <div class="prose max-w-none text-sm text-gray-700">
                        <?php echo nl2br(e($aspirasi->detail_aspirasi)); ?>

                    </div>
                </div>

                <?php if($aspirasi->file): ?>
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">File Pendukung</h3>
                    <a href="<?php echo e(asset('storage/' . $aspirasi->file)); ?>" target="_blank"
                        class="inline-flex items-center text-emerald-600 hover:text-emerald-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download File
                    </a>
                </div>
                <?php endif; ?>
            </div>
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pemda/aspirasi/show.blade.php ENDPATH**/ ?>