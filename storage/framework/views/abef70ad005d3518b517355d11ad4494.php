<?php if (isset($component)) { $__componentOriginal990183e42b3bc9a3478730eaf04b4592 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal990183e42b3bc9a3478730eaf04b4592 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pemda','data' => ['title' => 'Edit Agenda','headerTitle' => 'Edit Agenda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pemda'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Agenda','headerTitle' => 'Edit Agenda']); ?>
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Agenda</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui data agenda yang telah dibuat.</p>
        </div>

        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="<?php echo e(route('agenda.update', $agenda)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="space-y-6">
                        <div>
                            <label for="nama_agenda" class="block text-sm font-medium text-gray-700">Nama Agenda</label>
                            <input type="text" name="nama_agenda" id="nama_agenda" value="<?php echo e(old('nama_agenda', $agenda->nama_agenda)); ?>" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['nama_agenda'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Contoh: Bakti Sosial 2024">
                            <?php $__errorArgs = ['nama_agenda'];
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
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" id="kategori" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Pilih Kategori</option>
                                <option value="kegiatan_ormada" <?php echo e(old('kategori', $agenda->kategori) === 'kegiatan_ormada' ? 'selected' : ''); ?>>Kegiatan Ormada</option>
                                <option value="kegiatan_pemda" <?php echo e(old('kategori', $agenda->kategori) === 'kegiatan_pemda' ? 'selected' : ''); ?>>Kegiatan Pemda</option>
                                <option value="baksos" <?php echo e(old('kategori', $agenda->kategori) === 'baksos' ? 'selected' : ''); ?>>Bakti Sosial</option>
                                <option value="pendidikan" <?php echo e(old('kategori', $agenda->kategori) === 'pendidikan' ? 'selected' : ''); ?>>Pendidikan</option>
                                <option value="kesehatan" <?php echo e(old('kategori', $agenda->kategori) === 'kesehatan' ? 'selected' : ''); ?>>Kesehatan</option>
                                <option value="lingkungan" <?php echo e(old('kategori', $agenda->kategori) === 'lingkungan' ? 'selected' : ''); ?>>Lingkungan</option>
                                <option value="lainnya" <?php echo e(old('kategori', $agenda->kategori) === 'lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                            </select>
                            <?php $__errorArgs = ['kategori'];
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
                            <label for="deskripsi_agenda" class="block text-sm font-medium text-gray-700">Deskripsi Agenda</label>
                            <textarea name="deskripsi_agenda" id="deskripsi_agenda" rows="6" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['deskripsi_agenda'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Jelaskan agenda kegiatan ini..."><?php echo e(old('deskripsi_agenda', $agenda->deskripsi_agenda)); ?></textarea>
                            <?php $__errorArgs = ['deskripsi_agenda'];
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
                            <label for="gambar_poster" class="block text-sm font-medium text-gray-700">Poster Agenda (Opsional)</label>
                            <input type="file" name="gambar_poster" id="gambar_poster"
                                class="mt-1 block w-full text-sm text-gray-500 <?php $__errorArgs = ['gambar_poster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah poster.</p>
                            <?php if($agenda->gambar_poster): ?>
                            <p class="mt-1 text-sm text-gray-600">Poster saat ini: <a href="<?php echo e(asset('storage/' . $agenda->gambar_poster)); ?>" target="_blank" class="text-emerald-600 hover:text-emerald-800">Lihat Poster</a></p>
                            <?php endif; ?>
                            <?php $__errorArgs = ['gambar_poster'];
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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" value="<?php echo e(old('waktu_mulai', $agenda->waktu_mulai->format('Y-m-d\TH:i'))); ?>" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['waktu_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['waktu_mulai'];
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
                                <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" value="<?php echo e(old('waktu_selesai', $agenda->waktu_selesai->format('Y-m-d\TH:i'))); ?>" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['waktu_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['waktu_selesai'];
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

                        <div>
                            <label for="tempat" class="block text-sm font-medium text-gray-700">Tempat</label>
                            <input type="text" name="tempat" id="tempat" value="<?php echo e(old('tempat', $agenda->tempat)); ?>" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tempat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Contoh: Gedung Serbaguna Pemda">
                            <?php $__errorArgs = ['tempat'];
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

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Volunteer (Opsional)</h3>
                            <p class="text-sm text-gray-600 mb-4">Isi bagian ini jika agenda membuka pendaftaran volunteer.</p>

                            <div class="space-y-4">
                                <div>
                                    <label for="kuota_volunteer" class="block text-sm font-medium text-gray-700">Kuota Volunteer</label>
                                    <input type="number" name="kuota_volunteer" id="kuota_volunteer" value="<?php echo e(old('kuota_volunteer', $agenda->kuota_volunteer)); ?>" min="1"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['kuota_volunteer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Contoh: 50">
                                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak membuka volunteer.</p>
                                    <?php $__errorArgs = ['kuota_volunteer'];
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
                                    <label for="deadline_pendaftaran" class="block text-sm font-medium text-gray-700">Deadline Pendaftaran</label>
                                    <input type="datetime-local" name="deadline_pendaftaran" id="deadline_pendaftaran" value="<?php echo e(old('deadline_pendaftaran', $agenda->deadline_pendaftaran?->format('Y-m-d\TH:i'))); ?>"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['deadline_pendaftaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <p class="mt-1 text-xs text-gray-500">Harus sebelum waktu mulai agenda.</p>
                                    <?php $__errorArgs = ['deadline_pendaftaran'];
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
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" id="is_published" value="1" <?php echo e(old('is_published', $agenda->is_published) ? 'checked' : ''); ?>

                                class="rounded border-gray-300 text-emerald-600 shadow-sm">
                            <label for="is_published" class="text-sm font-medium text-gray-700">
                                Publikasikan sekarang
                            </label>
                        </div>
                        <p class="text-xs text-gray-500">Jika dicentang, agenda akan langsung terlihat oleh publik.</p>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="<?php echo e(route('agenda.show', $agenda)); ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700">
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
<?php if (isset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $attributes = $__attributesOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__attributesOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal990183e42b3bc9a3478730eaf04b4592)): ?>
<?php $component = $__componentOriginal990183e42b3bc9a3478730eaf04b4592; ?>
<?php unset($__componentOriginal990183e42b3bc9a3478730eaf04b4592); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pemda/agenda/edit.blade.php ENDPATH**/ ?>