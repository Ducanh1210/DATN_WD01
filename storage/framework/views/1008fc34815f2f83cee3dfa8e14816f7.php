<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['user' => null, 'size' => 36, 'class' => '']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['user' => null, 'size' => 36, 'class' => '']); ?>
<?php foreach (array_filter((['user' => null, 'size' => 36, 'class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $sizePx = is_numeric($size) ? $size . 'px' : $size;
    $displayName = $user ? ($user->display_name ?? $user->username) : 'Guest';
    $fallbackUrl = 'https://ui-avatars.com/api/?name=' . urlencode($displayName) . '&background=1e3a5f&color=fff';
    $avatarUrl = $user ? $user->avatar_formatted_url : $fallbackUrl;
    
    $frameClass = '';
    $frameImageUrl = null;
    if ($user && $user->equippedFrame) {
        $frameClass = $user->equippedFrame->css_style;
        $frameImageUrl = $user->equippedFrame->image_url;
    }
?>

<div class="avatar-frame-wrapper <?php echo e($frameImageUrl ? 'has-png-frame' : $frameClass); ?> <?php echo e($class); ?>" style="width: <?php echo e($sizePx); ?>; height: <?php echo e($sizePx); ?>; flex-shrink: 0;" title="<?php echo e($displayName); ?>">
    <img src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($displayName); ?>" onerror="this.onerror=null; this.src='<?php echo e($fallbackUrl); ?>';" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
    <?php if($frameImageUrl): ?>
        <img src="<?php echo e(asset($frameImageUrl)); ?>" alt="Frame" class="avatar-frame-png-overlay">
    <?php endif; ?>
</div>
<?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/components/user-avatar.blade.php ENDPATH**/ ?>