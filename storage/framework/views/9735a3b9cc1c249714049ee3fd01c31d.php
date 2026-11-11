<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'description' => null]));

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

foreach (array_filter((['title', 'description' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
    <div>
        <h1 class="text-2xl font-semibold tracking-normal text-zinc-950"><?php echo e($title); ?></h1>
        <?php if($description): ?>
            <p class="mt-2 max-w-3xl text-sm leading-6 text-zinc-600"><?php echo e($description); ?></p>
        <?php endif; ?>
    </div>
    <?php if($slot->isNotEmpty()): ?>
        <div class="flex shrink-0 flex-wrap gap-2"><?php echo e($slot); ?></div>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\User\OneDrive\Documents\GitHub\magang\resources\views/components/page-header.blade.php ENDPATH**/ ?>