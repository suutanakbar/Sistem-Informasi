<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Buat Proposal','headerTitle' => 'Buat Proposal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Buat Proposal','headerTitle' => 'Buat Proposal']); ?>
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Buat Proposal Baru</h1>
            <p class="mt-1 text-sm text-gray-600">Ajukan proposal bantuan kepada dinas terkait.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="<?php echo e(route('proposal.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="space-y-6">
                        <div>
                            <label for="dinas_tujuan_id" class="block text-sm font-medium text-gray-700">Dinas Tujuan</label>
                            <select name="dinas_tujuan_id" id="dinas_tujuan_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['dinas_tujuan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Pilih Dinas Tujuan</option>
                                <?php $__currentLoopData = $dinasTujuanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dinas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dinas->id); ?>" <?php echo e(old('dinas_tujuan_id') == $dinas->id ? 'selected' : ''); ?>>
                                    <?php echo e($dinas->nama); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['dinas_tujuan_id'];
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
                            <label for="judul_kegiatan" class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                            <input type="text" name="judul_kegiatan" id="judul_kegiatan" value="<?php echo e(old('judul_kegiatan')); ?>" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['judul_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['judul_kegiatan'];
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
                            <label for="jenis_bantuan" class="block text-sm font-medium text-gray-700">Jenis Bantuan</label>
                            <select name="jenis_bantuan" id="jenis_bantuan" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['jenis_bantuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Pilih Jenis Bantuan</option>
                                <option value="dana" <?php echo e(old('jenis_bantuan') == 'dana' ? 'selected' : ''); ?>>Dana</option>
                                <option value="izin" <?php echo e(old('jenis_bantuan') == 'izin' ? 'selected' : ''); ?>>Izin</option>
                                <option value="tempat" <?php echo e(old('jenis_bantuan') == 'tempat' ? 'selected' : ''); ?>>Tempat</option>
                                <option value="fasilitas" <?php echo e(old('jenis_bantuan') == 'fasilitas' ? 'selected' : ''); ?>>Fasilitas</option>
                            </select>
                            <?php $__errorArgs = ['jenis_bantuan'];
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
                            <label for="deskripsi_kegiatan" class="block text-sm font-medium text-gray-700">Deskripsi Kegiatan</label>
                            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" rows="5" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['deskripsi_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('deskripsi_kegiatan')); ?></textarea>
                            <?php $__errorArgs = ['deskripsi_kegiatan'];
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
                            <label for="anggaran_dibutuhkan" class="block text-sm font-medium text-gray-700">Anggaran Dibutuhkan (Rp)</label>
                            <input type="number" name="anggaran_dibutuhkan" id="anggaran_dibutuhkan" value="<?php echo e(old('anggaran_dibutuhkan', 0)); ?>" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['anggaran_dibutuhkan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['anggaran_dibutuhkan'];
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
                            <label for="file_proposal" class="block text-sm font-medium text-gray-700">File Proposal</label>
                            <input type="file" name="file_proposal" id="file_proposal" required
                                class="mt-1 block w-full text-sm text-gray-500 <?php $__errorArgs = ['file_proposal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX. Maksimal 5MB.</p>
                            <?php $__errorArgs = ['file_proposal'];
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
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="<?php echo e(route('proposal.index')); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Ajukan Proposal
                        </button>
                    </div>
                </form>
            </div>
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/admin/proposal/create.blade.php ENDPATH**/ ?>