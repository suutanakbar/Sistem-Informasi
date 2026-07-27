<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'postingan',
    'class' => ''
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'postingan',
    'class' => ''
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow <?php echo e($class); ?>">
    <?php if($postingan->foto): ?>
    <img src="<?php echo e(asset('storage/' . $postingan->foto)); ?>" alt="<?php echo e($postingan->judul); ?>" class="w-full h-40 object-cover">
    <?php endif; ?>
    <div class="p-4">
        <div class="flex items-center gap-1.5 mb-1.5">
            <span class="px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                <?php echo e(ucfirst($postingan->jenis_konten)); ?>

            </span>
            <?php if($postingan->is_published): ?>
            <span class="px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                Published
            </span>
            <?php else: ?>
            <span class="px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">
                Draft
            </span>
            <?php endif; ?>
        </div>
        <h3 class="font-semibold text-gray-900 text-sm mb-1.5 line-clamp-2"><?php echo e($postingan->judul); ?></h3>
        <p class="text-xs text-gray-600 line-clamp-2 mb-2">
            <?php echo e(Str::limit($postingan->isi_konten, 100)); ?>

        </p>
        <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span><?php echo e($postingan->dibuat_pada->format('d M Y')); ?></span>
        </div>
        <div class="text-xs text-gray-500 mb-2">
            <?php echo e($postingan->admin->nama); ?>

        </div>
        <div class="flex gap-2 pt-2 border-t border-gray-100">
            <a href="<?php echo e(route('postingan.show', $postingan)); ?>" class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                Detail
            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $postingan)): ?>
            <a href="<?php echo e(route('postingan.edit', $postingan)); ?>" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium ml-2">
                Edit
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('publish', $postingan)): ?>
            <?php if(!$postingan->is_published): ?>
            <form method="POST" action="<?php echo e(route('postingan.publish', $postingan)); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit" class="text-green-600 hover:text-green-800 text-xs font-medium ml-2">
                    Publish
                </button>
            </form>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\project\magang\resources\views/components/berita-agenda-card.blade.php ENDPATH**/ ?>