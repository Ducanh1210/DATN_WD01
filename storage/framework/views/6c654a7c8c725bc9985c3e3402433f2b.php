<?php $__env->startSection('title', 'Chi tiết Người dùng'); ?>

<?php $__env->startSection('actions'); ?>
    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn-minimal">Quay lại</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card-minimal p-4 text-center mb-3">
            <div class="d-flex justify-content-center mb-2">
                <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => $user,'size' => '72']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user),'size' => '72']); ?>
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
            </div>
            <h5 class="fw-semibold text-dark mb-0" style="font-size: 1.05rem;"><?php echo e($user->display_name); ?></h5>
            <div class="text-muted small mb-2"><?php echo e('@' . $user->username); ?></div>
            
            <div>
                <?php if($user->role == 'admin'): ?>
                    <span class="badge-minimal" style="background: #f5f3ff; color: #5b21b6; border: 1px solid #ede9fe;">Admin</span>
                <?php elseif($user->role == 'moderator'): ?>
                    <span class="badge-minimal" style="background: #fffbeb; color: #b45309; border: 1px solid #fef3c7;">Moderator</span>
                <?php else: ?>
                    <span class="badge-minimal">User</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-minimal p-3">
            <div class="fw-medium text-dark mb-3 pb-2 border-bottom" style="font-size: 0.85rem; border-color: var(--border-light) !important;">Thay đổi điểm số</div>
            <form action="<?php echo e(route('admin.users.adjust_points', $user->id)); ?>" method="POST" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="mb-2">
                    <label class="form-label text-muted" style="font-size: 0.775rem;">Số điểm (dùng số âm để trừ)</label>
                    <input type="number" name="amount" class="form-control form-control-sm <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ví dụ: 50 hoặc -20" value="<?php echo e(old('amount')); ?>" style="border-color: #e2e8f0;">
                    <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.725rem;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted" style="font-size: 0.775rem;">Lý do thay đổi</label>
                    <input type="text" name="description" class="form-control form-control-sm <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Lý do thay đổi điểm" value="<?php echo e(old('description')); ?>" style="border-color: #e2e8f0;">
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block mt-1" style="font-size: 0.725rem;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button type="submit" class="btn-minimal btn-minimal-primary w-100">Cập nhật điểm</button>
            </form>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card-minimal p-3 mb-3">
            <div class="fw-medium text-dark mb-2 pb-2 border-bottom" style="font-size: 0.85rem; border-color: var(--border-light) !important;">Thông tin chi tiết</div>
            <table class="table table-borderless table-sm mb-0 align-middle">
                <tbody>
                    <tr>
                        <th width="30%" class="text-muted fw-normal" style="font-size: 0.8rem;">ID Tài khoản</th>
                        <td class="fw-medium text-dark" style="font-size: 0.8rem;">#<?php echo e($user->id); ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Tên hiển thị</th>
                        <td class="fw-medium text-dark" style="font-size: 0.8rem;"><?php echo e($user->display_name); ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Username</th>
                        <td class="text-secondary" style="font-size: 0.8rem;"><?php echo e($user->username); ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Email</th>
                        <td class="text-secondary" style="font-size: 0.8rem;"><?php echo e($user->email); ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Điểm tích lũy</th>
                        <td class="fw-medium text-primary" style="font-size: 0.85rem;"><?php echo e($user->points); ?> điểm</td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Trạng thái</th>
                        <td>
                            <?php if($user->status == 'active'): ?>
                                <span class="badge-minimal badge-minimal-success">Hoạt động</span>
                            <?php elseif($user->status == 'inactive'): ?>
                                <span class="badge-minimal">Chưa kích hoạt</span>
                            <?php else: ?>
                                <span class="badge-minimal" style="background: #fef2f2; color: #991b1b;">Bị khóa</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Ngày tạo</th>
                        <td class="text-muted" style="font-size: 0.8rem;"><?php echo e($user->created_at ? $user->created_at->format('d/m/Y H:i:s') : 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted fw-normal" style="font-size: 0.8rem;">Cập nhật lần cuối</th>
                        <td class="text-muted" style="font-size: 0.8rem;"><?php echo e($user->updated_at ? $user->updated_at->format('d/m/Y H:i:s') : 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-minimal p-3">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom" style="border-color:var(--border-light)!important;">
                <div class="fw-medium text-dark" style="font-size:0.85rem;">Lịch sử giao dịch điểm</div>
                <span class="text-muted" style="font-size:0.72rem;">
                    <?php echo e($pointHistory->total()); ?> mục
                    <?php if(($historyData['raw_total'] ?? 0) > $pointHistory->total()): ?>
                        · gộp từ <?php echo e($historyData['raw_total']); ?> bản ghi
                    <?php endif; ?>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-minimal align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                            <th>Số điểm</th>
                            <th>Nội dung chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $pointHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-muted" style="font-size:0.775rem;"><?php echo e($tx['created_at']->format('d/m/Y H:i')); ?></td>
                                <td>
                                    <span class="badge-minimal">
                                        <?php echo e(\App\Services\PointService::actionLabel($tx['action'])); ?>

                                    </span>
                                    <?php if(!empty($tx['aggregated'])): ?>
                                        <span class="text-muted" style="font-size:0.68rem;"> · gộp</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-medium <?php echo e($tx['amount'] >= 0 ? 'text-success' : 'text-danger'); ?>" style="font-size:0.8rem;">
                                    <?php echo e($tx['amount'] >= 0 ? '+' : ''); ?><?php echo e($tx['amount']); ?>

                                </td>
                                <td class="text-muted" style="font-size:0.775rem;max-width:280px;white-space:normal;"><?php echo e($tx['description'] ?: '—'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Chưa có giao dịch điểm nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if($pointHistory->hasPages()): ?>
            <div class="p-2 border-top"><?php echo e($pointHistory->links('pagination::bootstrap-5')); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/users/show.blade.php ENDPATH**/ ?>