<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Edit Anggota Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Anggota Ormada']); ?>
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Edit Anggota Ormada','description' => 'Perbarui data anggota']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Anggota Ormada','description' => 'Perbarui data anggota']); ?>
        <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('anggota-ormada.show', $anggotaOrmada)).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('anggota-ormada.show', $anggotaOrmada)).'','variant' => 'secondary']); ?>Kembali ke Detail <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $attributes = $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $component = $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
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

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="<?php echo e(route('anggota-ormada.update', $anggotaOrmada)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo e(old('nama_lengkap', $anggotaOrmada->nama_lengkap)); ?>" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['nama_lengkap'];
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
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                        <input type="text" name="nim" id="nim" value="<?php echo e(old('nim', $anggotaOrmada->nim)); ?>" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['nim'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['nim'];
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
                        <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi <span class="text-red-500">*</span></label>
                        <input type="text" name="program_studi" id="program_studi" value="<?php echo e(old('program_studi', $anggotaOrmada->program_studi)); ?>" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['program_studi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['program_studi'];
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
                        <label for="status_aktif" class="block text-sm font-medium text-gray-700">Status Aktif <span class="text-red-500">*</span></label>
                        <select name="status_aktif" id="status_aktif" required onchange="toggleJabatan()"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['status_aktif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Pilih Status</option>
                            <option value="fungsionaris" <?php echo e(old('status_aktif', $anggotaOrmada->status_aktif) === 'fungsionaris' ? 'selected' : ''); ?>>Fungsionaris</option>
                            <option value="mahasiswa_biasa" <?php echo e(old('status_aktif', $anggotaOrmada->status_aktif) === 'mahasiswa_biasa' ? 'selected' : ''); ?>>Mahasiswa Biasa</option>
                            <option value="demisioner" <?php echo e(old('status_aktif', $anggotaOrmada->status_aktif) === 'demisioner' ? 'selected' : ''); ?>>Demisioner</option>
                            <option value="alumni" <?php echo e(old('status_aktif', $anggotaOrmada->status_aktif) === 'alumni' ? 'selected' : ''); ?>>Alumni</option>
                        </select>
                        <?php $__errorArgs = ['status_aktif'];
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
                        <label for="is_pengurus" class="block text-sm font-medium text-gray-700">Pengurus <span class="text-red-500">*</span></label>
                        <select name="is_pengurus" id="is_pengurus" required onchange="toggleJabatan()"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['is_pengurus'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Pilih</option>
                            <option value="TIDAK" <?php echo e(old('is_pengurus', $anggotaOrmada->is_pengurus) === 'TIDAK' ? 'selected' : ''); ?>>Tidak</option>
                            <option value="YA" <?php echo e(old('is_pengurus', $anggotaOrmada->is_pengurus) === 'YA' ? 'selected' : ''); ?>>Ya</option>
                        </select>
                        <?php $__errorArgs = ['is_pengurus'];
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

                    <div id="jabatanField" class="<?php echo e($anggotaOrmada->is_pengurus === 'YA' ? '' : 'hidden'); ?>">
                        <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan <span class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" id="jabatan" value="<?php echo e(old('jabatan', $anggotaOrmada->jabatan)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['jabatan'];
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
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" value="<?php echo e(old('no_hp', $anggotaOrmada->no_hp)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['no_hp'];
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
                        <label for="tanggal_masuk_kuliah" class="block text-sm font-medium text-gray-700">Tanggal Masuk Kuliah</label>
                        <input type="date" name="tanggal_masuk_kuliah" id="tanggal_masuk_kuliah" value="<?php echo e(old('tanggal_masuk_kuliah', $anggotaOrmada->tanggal_masuk_kuliah)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tanggal_masuk_kuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['tanggal_masuk_kuliah'];
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
                        <label for="tanggal_lulus_kuliah" class="block text-sm font-medium text-gray-700">Tanggal Lulus Kuliah</label>
                        <input type="date" name="tanggal_lulus_kuliah" id="tanggal_lulus_kuliah" value="<?php echo e(old('tanggal_lulus_kuliah', $anggotaOrmada->tanggal_lulus_kuliah)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tanggal_lulus_kuliah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['tanggal_lulus_kuliah'];
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
                        <label for="tanggal_mulai_jabatan" class="block text-sm font-medium text-gray-700">Tanggal Mulai Jabatan</label>
                        <input type="date" name="tanggal_mulai_jabatan" id="tanggal_mulai_jabatan" value="<?php echo e(old('tanggal_mulai_jabatan', $anggotaOrmada->tanggal_mulai_jabatan)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tanggal_mulai_jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['tanggal_mulai_jabatan'];
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
                        <label for="tanggal_akhir_jabatan" class="block text-sm font-medium text-gray-700">Tanggal Akhir Jabatan</label>
                        <input type="date" name="tanggal_akhir_jabatan" id="tanggal_akhir_jabatan" value="<?php echo e(old('tanggal_akhir_jabatan', $anggotaOrmada->tanggal_akhir_jabatan)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tanggal_akhir_jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['tanggal_akhir_jabatan'];
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
                        <label for="tanggal_demisioner" class="block text-sm font-medium text-gray-700">Tanggal Demisioner</label>
                        <input type="date" name="tanggal_demisioner" id="tanggal_demisioner" value="<?php echo e(old('tanggal_demisioner', $anggotaOrmada->tanggal_demisioner)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tanggal_demisioner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['tanggal_demisioner'];
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
                        <label for="tanggal_lulus" class="block text-sm font-medium text-gray-700">Tanggal Lulus</label>
                        <input type="date" name="tanggal_lulus" id="tanggal_lulus" value="<?php echo e(old('tanggal_lulus', $anggotaOrmada->tanggal_lulus)); ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['tanggal_lulus'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['tanggal_lulus'];
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

                    <?php if(auth()->user()->isAdmin()): ?>
                    <div class="md:col-span-2">
                        <label for="profil_ormada_id" class="block text-sm font-medium text-gray-700">Profil Ormada <span class="text-red-500">*</span></label>
                        <select name="profil_ormada_id" id="profil_ormada_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm <?php $__errorArgs = ['profil_ormada_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__currentLoopData = $profilOrmadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($profil->id); ?>" <?php echo e(old('profil_ormada_id', $anggotaOrmada->profil_ormada_id) == $profil->id ? 'selected' : ''); ?>>
                                    <?php echo e($profil->nama_universitas); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['profil_ormada_id'];
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
                    <?php endif; ?>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <?php if (isset($component)) { $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-link','data' => ['href' => ''.e(route('anggota-ormada.show', $anggotaOrmada)).'','variant' => 'secondary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('anggota-ormada.show', $anggotaOrmada)).'','variant' => 'secondary']); ?>Batal <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $attributes = $__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__attributesOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7)): ?>
<?php $component = $__componentOriginal5a94ef8b388dd14c079478b029d5d8c7; ?>
<?php unset($__componentOriginal5a94ef8b388dd14c079478b029d5d8c7); ?>
<?php endif; ?>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        function toggleJabatan() {
            const isPengurus = document.getElementById('is_pengurus').value;
            const jabatanField = document.getElementById('jabatanField');
            
            if (isPengurus === 'YA') {
                jabatanField.classList.remove('hidden');
                document.getElementById('jabatan').required = true;
            } else {
                jabatanField.classList.add('hidden');
                document.getElementById('jabatan').required = false;
            }
        }

        // Initialize on page load
        toggleJabatan();
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/anggota_ormada/edit.blade.php ENDPATH**/ ?>