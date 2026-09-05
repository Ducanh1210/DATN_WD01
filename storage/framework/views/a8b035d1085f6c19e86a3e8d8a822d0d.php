<?php $__env->startSection('title', 'Quản lý yêu cầu doanh nghiệp'); ?>

<?php $__env->startSection('content'); ?>
<!-- Metric & Filter Tabs -->
<div class="metric-strip mb-3 d-flex flex-wrap align-items-center justify-content-between p-0 overflow-hidden">
    <a href="<?php echo e(route('admin.business-profiles.index', ['status' => 'all', 'search' => $search])); ?>" 
       class="metric-item flex-fill text-decoration-none py-3 px-4 transition-all <?php echo e($status === 'all' ? 'bg-light border-bottom border-2' : ''); ?>" style="<?php echo e($status === 'all' ? 'border-bottom-color:#1e3a5f!important;' : ''); ?>">
        <div class="metric-label">Tất cả yêu cầu</div>
        <div class="metric-value text-dark" style="font-size: 1.2rem;"><?php echo e($counts['all']); ?></div>
    </a>
    <a href="<?php echo e(route('admin.business-profiles.index', ['status' => 'pending', 'search' => $search])); ?>" 
       class="metric-item flex-fill text-decoration-none py-3 px-4 transition-all <?php echo e($status === 'pending' ? 'bg-light border-bottom border-2' : ''); ?>" style="<?php echo e($status === 'pending' ? 'border-bottom-color:#1e3a5f!important;' : ''); ?>">
        <div class="metric-label <?php echo e($status === 'pending' ? 'text-dark fw-medium' : ''); ?>">Chờ phê duyệt</div>
        <div class="metric-value <?php echo e($status === 'pending' ? 'text-dark' : ''); ?>" style="font-size:1.2rem;"><?php echo e($counts['pending']); ?></div>
    </a>
    <a href="<?php echo e(route('admin.business-profiles.index', ['status' => 'approved', 'search' => $search])); ?>" 
       class="metric-item flex-fill text-decoration-none py-3 px-4 transition-all <?php echo e($status === 'approved' ? 'bg-light border-bottom border-2' : ''); ?>" style="<?php echo e($status === 'approved' ? 'border-bottom-color:#1e3a5f!important;' : ''); ?>">
        <div class="metric-label <?php echo e($status === 'approved' ? 'text-dark fw-medium' : ''); ?>">Đã duyệt</div>
        <div class="metric-value <?php echo e($status === 'approved' ? 'text-dark' : ''); ?>" style="font-size:1.2rem;"><?php echo e($counts['approved']); ?></div>
    </a>
    <a href="<?php echo e(route('admin.business-profiles.index', ['status' => 'rejected', 'search' => $search])); ?>" 
       class="metric-item flex-fill text-decoration-none py-3 px-4 transition-all <?php echo e($status === 'rejected' ? 'bg-light border-bottom border-2' : ''); ?>" style="<?php echo e($status === 'rejected' ? 'border-bottom-color:#1e3a5f!important;' : ''); ?>">
        <div class="metric-label <?php echo e($status === 'rejected' ? 'text-dark fw-medium' : ''); ?>">Đã từ chối</div>
        <div class="metric-value <?php echo e($status === 'rejected' ? 'text-dark' : ''); ?>" style="font-size:1.2rem;"><?php echo e($counts['rejected']); ?></div>
    </a>
</div>

<!-- Form Lọc & Tìm kiếm Minimalist -->
<div class="card-minimal mb-3 p-3">
    <form action="<?php echo e(route('admin.business-profiles.index')); ?>" method="GET" class="row g-2 align-items-center">
        <input type="hidden" name="status" value="<?php echo e($status); ?>">
        <div class="col-md-9">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm kiếm tên doanh nghiệp, SĐT, tài khoản..." value="<?php echo e($search); ?>" style="border-color: #e2e8f0;">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn-minimal btn-minimal-primary w-100 py-1" style="font-size: 0.8rem;">Tìm kiếm</button>
        </div>
    </form>
</div>

<!-- Table Card -->
<div class="card-minimal">
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Tên Doanh Nghiệp</th>
                    <th>Chủ Tài Khoản</th>
                    <th>Danh Mục</th>
                    <th>SĐT / Địa Chỉ</th>
                    <th class="text-center">Trạng Thái</th>
                    <th>Ngày Gửi</th>
                    <th class="text-end pe-4" style="width: 100px;">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $businessProfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center text-muted" style="font-size: 0.775rem;"><?php echo e($businessProfiles->firstItem() + $index); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.business-profiles.show', $item->id)); ?>" class="fw-medium text-dark text-decoration-none" style="font-size: 0.825rem;">
                            <?php echo e($item->business_name); ?>

                        </a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => $item->user,'size' => '24']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item->user),'size' => '24']); ?>
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
                            <div>
                                <div class="fw-medium text-dark" style="font-size: 0.8rem;"><?php echo e($item->user->display_name ?? $item->user->username); ?></div>
                                <div class="text-muted" style="font-size: 0.725rem;"><?php echo e($item->user->email); ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge-minimal">
                            <?php echo e($item->category ? $item->category->name : 'N/A'); ?>

                        </span>
                    </td>
                    <td>
                        <div style="font-size: 0.8rem;"><?php echo e($item->phone); ?></div>
                        <div class="text-muted text-truncate" style="max-width: 220px; font-size: 0.725rem;" title="<?php echo e($item->address_street); ?>, <?php echo e($item->address_city); ?>">
                            <?php echo e($item->address_street); ?>, <?php echo e($item->address_city); ?>

                        </div>
                    </td>
                    <td class="text-center">
                        <?php if($item->status === 'pending'): ?>
                            <span class="badge-minimal badge-minimal-warning">Chờ duyệt</span>
                        <?php elseif($item->status === 'approved'): ?>
                            <span class="badge-minimal badge-minimal-success">Đã duyệt</span>
                        <?php elseif($item->status === 'rejected'): ?>
                            <span class="badge-minimal badge-minimal-danger" title="Lý do: <?php echo e($item->reject_reason); ?>">Bị từ chối</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="text-muted" style="font-size: 0.75rem;"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></span>
                    </td>
                    <td class="text-end pe-4">
                        <a href="<?php echo e(route('admin.business-profiles.show', $item->id)); ?>" class="btn-minimal py-1 px-2 text-decoration-none" style="font-size: 0.75rem;">
                            Chi tiết
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Không tìm thấy yêu cầu doanh nghiệp nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($businessProfiles->hasPages()): ?>
    <div class="p-3 border-top" style="border-color: var(--border-light) !important;">
        <?php echo e($businessProfiles->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/business/index.blade.php ENDPATH**/ ?>