<?php $__env->startSection('title', 'Quản lý Người dùng'); ?>

<?php $__env->startSection('actions'); ?>
    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn-minimal btn-minimal-primary">Thêm tài khoản</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card-minimal">
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">ID</th>
                    <th style="width: 50px;">Avatar</th>
                    <th>Tên hiển thị</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Xu</th>
                    <th>Vai trò</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center text-muted" style="font-size: 0.775rem;"><?php echo e($user->id); ?></td>
                        <td>
                            <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => $user,'size' => '32']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user),'size' => '32']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e)): ?>
<?php $attributes = $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e; ?>
<?php unset($__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e)): ?>
<?php $component = $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e; ?>
<?php unset($__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e); ?>
<?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size: 0.825rem;"><?php echo e($user->display_name); ?></div>
                        </td>
                        <td>
                            <span class="text-muted" style="font-size: 0.775rem;"><?php echo e($user->username); ?></span>
                        </td>
                        <td>
                            <span class="text-secondary" style="font-size: 0.775rem;"><?php echo e($user->email); ?></span>
                        </td>
                        <td>
                            <span class="fw-medium text-primary" style="font-size: 0.8rem;"><?php echo e($user->points); ?></span>
                        </td>
                        <td>
                            <?php if($user->role == 'admin'): ?>
                                <span class="badge-minimal" style="background: #f5f3ff; color: #5b21b6; border: 1px solid #ede9fe;">Admin</span>
                            <?php elseif($user->role == 'moderator'): ?>
                                <span class="badge-minimal" style="background: #fffbeb; color: #b45309; border: 1px solid #fef3c7;">Mod</span>
                            <?php else: ?>
                                <span class="badge-minimal">User</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($user->status == 'active'): ?>
                                <span class="badge-minimal badge-minimal-success">Hoạt động</span>
                            <?php elseif($user->status == 'inactive'): ?>
                                <span class="badge-minimal">Chưa kích hoạt</span>
                            <?php else: ?>
                                <span class="badge-minimal" style="background: #fef2f2; color: #991b1b; border: 1px solid #fee2e2;">Bị khóa</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn-minimal py-1 px-2 text-decoration-none me-1" style="font-size: 0.75rem;">Xem</a>
                            <?php if(auth()->id() != $user->id): ?>
                                <?php if($user->status == 'banned'): ?>
                                    <form action="<?php echo e(route('admin.users.toggle_status', $user->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="btn-minimal py-1 px-2 text-success" style="font-size: 0.75rem;">Mở</button>
                                    </form>
                                <?php else: ?>
                                    <form action="<?php echo e(route('admin.users.toggle_status', $user->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size: 0.75rem;">Khóa</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Chưa có người dùng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($users->hasPages()): ?>
    <div class="p-3 border-top" style="border-color: var(--border-light) !important;">
        <?php echo e($users->links('pagination::bootstrap-5')); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/users/index.blade.php ENDPATH**/ ?>