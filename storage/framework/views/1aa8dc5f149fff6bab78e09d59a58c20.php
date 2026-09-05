<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['src' => null, 'alt' => '', 'class' => '', 'ratio' => '16/9']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['src' => null, 'alt' => '', 'class' => '', 'ratio' => '16/9']); ?>
<?php foreach (array_filter((['src' => null, 'alt' => '', 'class' => '', 'ratio' => '16/9']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['cover-image', $class]); ?>" style="aspect-ratio: <?php echo e($ratio); ?>;">
    <?php if($src): ?>
        <img src="<?php echo e($src); ?>" alt="<?php echo e($alt); ?>" loading="lazy" class="cover-image__img">
    <?php else: ?>
        <div class="cover-image__placeholder" aria-hidden="true">
            <span>Ninh Bình</span>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/client/partials/cover-image.blade.php ENDPATH**/ ?>