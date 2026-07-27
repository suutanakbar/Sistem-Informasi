<?php if (isset($component)) { $__componentOriginal71c8a89aeda48b8a852a6b7cf016f61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal71c8a89aeda48b8a852a6b7cf016f61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.pengurus','data' => ['title' => 'Edit Profil Ormada','headerTitle' => 'Edit Profil Ormada']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.pengurus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Profil Ormada','headerTitle' => 'Edit Profil Ormada']); ?>
    <div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="<?php echo e(route('profil-ormada.show', $profilOrmada)); ?>" class="text-sm text-gray-600 hover:text-gray-900">← Kembali ke Detail</a>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Profil Ormada</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui identitas ormada dan logo bila diperlukan.</p>
        </div>

        <form method="POST" action="<?php echo e(route('profil-ormada.update', $profilOrmada)); ?>" enctype="multipart/form-data" class="rounded-lg border border-zinc-200 bg-white p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('profil_ormada.partials.form', ['profilOrmada' => $profilOrmada], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </form>
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
<?php endif; ?><?php /**PATH C:\project\magang\resources\views/pengurus/profil_ormada/edit.blade.php ENDPATH**/ ?>