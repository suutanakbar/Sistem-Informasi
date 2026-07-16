<?php ($anggotaOrmada = $anggotaOrmada ?? null); ?>

<div class="grid gap-5">
    <?php if(! auth()->user()->isPengurusOrmada()): ?>
        <label class="block">
            <span class="text-sm font-medium text-zinc-700">Profil Ormada</span>
            <select name="profil_ormada_id" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                <option value="">Pilih ormada</option>
                <?php $__currentLoopData = $profilOrmadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profil): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($profil->id); ?>" <?php if((string) old('profil_ormada_id', $anggotaOrmada?->profil_ormada_id) === (string) $profil->id): echo 'selected'; endif; ?>><?php echo e($profil->nama_universitas); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </label>
    <?php else: ?>
        <input type="hidden" name="profil_ormada_id" value="<?php echo e(auth()->user()->profilOrmada?->id); ?>">
    <?php endif; ?>

    <!-- Biodata Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Biodata</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Nama Lengkap <span class="text-red-500">*</span></span>
                <input name="nama_lengkap" value="<?php echo e(old('nama_lengkap', $anggotaOrmada?->nama_lengkap)); ?>" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">NIK <span class="text-red-500">*</span></span>
                <input name="nik" value="<?php echo e(old('nik', $anggotaOrmada?->nik)); ?>" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tempat Lahir</span>
                <input name="tempat_lahir" value="<?php echo e(old('tempat_lahir', $anggotaOrmada?->tempat_lahir)); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tanggal Lahir</span>
                <input type="date" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir', $anggotaOrmada?->tanggal_lahir?->format('Y-m-d'))); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Agama</span>
                <select name="agama" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="">Pilih Agama</option>
                    <?php $__currentLoopData = ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agamaOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($agamaOption); ?>" <?php if(old('agama', $anggotaOrmada?->agama) === $agamaOption): echo 'selected'; endif; ?>><?php echo e($agamaOption); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Golongan Darah</span>
                <select name="golongan_darah" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="">Pilih</option>
                    <?php $__currentLoopData = ['A','B','AB','O']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $golongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($golongan); ?>" <?php if(old('golongan_darah', $anggotaOrmada?->golongan_darah) === $golongan): echo 'selected'; endif; ?>><?php echo e($golongan); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>
        </div>
    </div>

    <!-- Akademik Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Akademik</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">NIM <span class="text-red-500">*</span></span>
                <input name="nim" value="<?php echo e(old('nim', $anggotaOrmada?->nim)); ?>" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Program Studi <span class="text-red-500">*</span></span>
                <input name="program_studi" value="<?php echo e(old('program_studi', $anggotaOrmada?->program_studi)); ?>" required class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Fakultas</span>
                <input name="fakultas" value="<?php echo e(old('fakultas', $anggotaOrmada?->fakultas)); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Jurusan (Prodi)</span>
                <input name="prodi" value="<?php echo e(old('prodi', $anggotaOrmada?->prodi)); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Angkatan</span>
                <input name="angkatan" value="<?php echo e(old('angkatan', $anggotaOrmada?->angkatan)); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Status</span>
                <select name="status_aktif" id="status_aktif" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="mahasiswa" <?php if(old('status_aktif', $anggotaOrmada?->status_aktif ?? 'mahasiswa') === 'mahasiswa'): echo 'selected'; endif; ?>>Aktif (Mahasiswa)</option>
                    <option value="alumni" <?php if(old('status_aktif', $anggotaOrmada?->status_aktif) === 'alumni'): echo 'selected'; endif; ?>>Lulus (Alumni)</option>
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tanggal Masuk Kuliah</span>
                <input type="date" name="tanggal_masuk_kuliah" value="<?php echo e(old('tanggal_masuk_kuliah', $anggotaOrmada?->tanggal_masuk_kuliah?->format('Y-m-d'))); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Tanggal Lulus Kuliah</span>
                <input type="date" name="tanggal_lulus_kuliah" value="<?php echo e(old('tanggal_lulus_kuliah', $anggotaOrmada?->tanggal_lulus_kuliah?->format('Y-m-d'))); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
        </div>
    </div>

    <!-- Kontak Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Kontak</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Nomor HP</span>
                <input name="no_hp" value="<?php echo e(old('no_hp', $anggotaOrmada?->no_hp)); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Email</span>
                <input type="email" name="email" value="<?php echo e(old('email', $anggotaOrmada?->email)); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
            </label>
            <label class="block md:col-span-2">
                <span class="text-sm font-medium text-zinc-700">Alamat</span>
                <textarea name="alamat" rows="3" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2"><?php echo e(old('alamat', $anggotaOrmada?->alamat)); ?></textarea>
            </label>
            <label class="block md:col-span-2">
                <span class="text-sm font-medium text-zinc-700">CV (PDF)</span>
                <input type="file" name="cv" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                <?php if($anggotaOrmada?->cv_path): ?>
                    <p class="mt-1 text-sm text-gray-600">CV saat ini: <a href="<?php echo e(asset('storage/'.$anggotaOrmada->cv_path)); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat CV</a></p>
                <?php endif; ?>
            </label>
        </div>
    </div>

    <!-- Pengurus Section -->
    <div class="border border-zinc-200 rounded-lg p-4">
        <h3 class="text-lg font-semibold text-zinc-900 mb-4">Pengurus</h3>
        <div class="grid gap-4 md:grid-cols-2">
            <label class="block">
                <span class="text-sm font-medium text-zinc-700">Pengurus <span class="text-red-500">*</span></span>
                <select name="is_pengurus" id="is_pengurus" required onchange="toggleJabatan()" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="TIDAK" <?php if(old('is_pengurus', $anggotaOrmada?->is_pengurus ?? 'TIDAK') === 'TIDAK'): echo 'selected'; endif; ?>>TIDAK</option>
                    <option value="YA" <?php if(old('is_pengurus', $anggotaOrmada?->is_pengurus) === 'YA'): echo 'selected'; endif; ?>>YA</option>
                </select>
            </label>
            <label class="block md:col-span-2 <?php echo e(($anggotaOrmada?->is_pengurus === 'YA') ? '' : 'hidden'); ?>" id="jabatanField">
                <span class="text-sm font-medium text-zinc-700">Jabatan</span>
                <select name="jabatan" id="jabatan" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                    <option value="">Pilih jabatan</option>
                    <option value="Ketua" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Ketua'): echo 'selected'; endif; ?>>Ketua</option>
                    <option value="Wakil Ketua" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Wakil Ketua'): echo 'selected'; endif; ?>>Wakil Ketua</option>
                    <option value="Sekretaris" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Sekretaris'): echo 'selected'; endif; ?>>Sekretaris</option>
                    <option value="Bendahara" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Bendahara'): echo 'selected'; endif; ?>>Bendahara</option>
                    <option value="Kepala Divisi" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Kepala Divisi'): echo 'selected'; endif; ?>>Kepala Divisi</option>
                    <option value="Wakil Kepala Divisi" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Wakil Kepala Divisi'): echo 'selected'; endif; ?>>Wakil Kepala Divisi</option>
                    <option value="Staff Divisi" <?php if(old('jabatan', $anggotaOrmada?->jabatan) === 'Staff Divisi'): echo 'selected'; endif; ?>>Staff Divisi</option>
                </select>
            </label>

            <div id="tanggalJabatanFields" class="<?php echo e(($anggotaOrmada?->is_pengurus === 'YA') ? '' : 'hidden'); ?>">
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700">Tanggal Mulai Jabatan</span>
                    <input type="date" name="tanggal_mulai_jabatan" value="<?php echo e(old('tanggal_mulai_jabatan', $anggotaOrmada?->tanggal_mulai_jabatan?->format('Y-m-d'))); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                </label>
            </div>
            <div id="tanggalAkhirJabatanField" class="<?php echo e(($anggotaOrmada?->is_pengurus === 'YA') ? '' : 'hidden'); ?>">
                <label class="block">
                    <span class="text-sm font-medium text-zinc-700">Tanggal Akhir Jabatan</span>
                    <input type="date" name="tanggal_akhir_jabatan" value="<?php echo e(old('tanggal_akhir_jabatan', $anggotaOrmada?->tanggal_akhir_jabatan?->format('Y-m-d'))); ?>" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-2">
                </label>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function toggleJabatan() {
        const isPengurus = document.getElementById('is_pengurus').value;
        const jabatanField = document.getElementById('jabatanField');
        const tanggalJabatanFields = document.getElementById('tanggalJabatanFields');
        const tanggalAkhirJabatanField = document.getElementById('tanggalAkhirJabatanField');
        
        if (isPengurus === 'YA') {
            jabatanField.classList.remove('hidden');
            tanggalJabatanFields.classList.remove('hidden');
            tanggalAkhirJabatanField.classList.remove('hidden');
            document.getElementById('jabatan').required = true;
        } else {
            jabatanField.classList.add('hidden');
            tanggalJabatanFields.classList.add('hidden');
            tanggalAkhirJabatanField.classList.add('hidden');
            document.getElementById('jabatan').required = false;
        }
    }

    // Initialize on page load
    toggleJabatan();
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\project\magang\resources\views/anggota_ormada/partials/form.blade.php ENDPATH**/ ?>