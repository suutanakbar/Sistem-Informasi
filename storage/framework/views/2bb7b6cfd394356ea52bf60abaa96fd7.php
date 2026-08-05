<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => ['title' => 'Edit Postingan','headerTitle' => 'Edit Postingan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Postingan','headerTitle' => 'Edit Postingan']); ?>
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Postingan</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui data postingan yang telah dibuat.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="<?php echo e(route('postingan.update', $postingan)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="space-y-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Postingan</label>
                            <input type="text" name="judul" id="judul" value="<?php echo e(old('judul', $postingan->judul)); ?>" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Contoh: Kegiatan Bakti Sosial Ormada 2024">
                            <?php $__errorArgs = ['judul'];
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
                            <label for="jenis_konten" class="block text-sm font-medium text-gray-700">Jenis Konten</label>
                            <select name="jenis_konten" id="jenis_konten" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['jenis_konten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Pilih Jenis Konten</option>
                                <option value="berita" <?php echo e(old('jenis_konten', $postingan->jenis_konten) === 'berita' ? 'selected' : ''); ?>>Berita</option>
                                <option value="pengumuman" <?php echo e(old('jenis_konten', $postingan->jenis_konten) === 'pengumuman' ? 'selected' : ''); ?>>Pengumuman</option>
                                <option value="prestasi" <?php echo e(old('jenis_konten', $postingan->jenis_konten) === 'prestasi' ? 'selected' : ''); ?>>Prestasi</option>
                            </select>
                            <?php $__errorArgs = ['jenis_konten'];
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
                            <label for="isi_konten" class="block text-sm font-medium text-gray-700">Isi Konten</label>
                            <textarea name="isi_konten" id="isi_konten" rows="8" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['isi_konten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Tulis konten postingan di sini..."><?php echo e(old('isi_konten', $postingan->isi_konten)); ?></textarea>
                            <?php $__errorArgs = ['isi_konten'];
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
                            <label for="foto" class="block text-sm font-medium text-gray-700">Foto Postingan (Opsional)</label>
                            <input type="file" name="foto" id="foto"
                                class="mt-1 block w-full text-sm text-gray-500 <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                            <?php if($postingan->foto): ?>
                            <p class="mt-1 text-sm text-gray-600">Foto saat ini: <a href="<?php echo e(asset('storage/' . $postingan->foto)); ?>" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat Foto</a></p>
                            <?php endif; ?>
                            <?php $__errorArgs = ['foto'];
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

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" id="is_published" value="1" <?php echo e(old('is_published', $postingan->is_published) ? 'checked' : ''); ?>

                                class="rounded border-gray-300 text-blue-600 shadow-sm">
                            <label for="is_published" class="text-sm font-medium text-gray-700">
                                Publikasikan sekarang
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">Jika dicentang, postingan akan langsung terlihat oleh publik.</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="<?php echo e(route('postingan.show', $postingan)); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Simpan Perubahan
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/admin/postingan/edit.blade.php ENDPATH**/ ?>