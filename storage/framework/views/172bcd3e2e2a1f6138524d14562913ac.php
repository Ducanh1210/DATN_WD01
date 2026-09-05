<?php $__env->startSection('title', 'Quản lý Danh mục'); ?>

<?php $__env->startSection('actions'); ?>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn-minimal btn-minimal-primary">Thêm danh mục</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="card-minimal">
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th width="60" class="text-center">ID</th>
                    <th width="60" class="text-center">Icon</th>
                    <th>Tên Danh mục</th>
                    <th>Slug</th>
                    <th width="80" class="text-center">Thứ tự</th>
                    <th width="110" class="text-center">Trạng thái</th>
                    <th width="140" class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center text-muted" style="font-size: 0.775rem;"><?php echo e($item->id); ?></td>
                        <td class="text-center">
                            <?php if($item->icon): ?>
                                <div class="d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                    <img src="<?php echo e(asset($item->icon)); ?>" alt="Icon" style="height: 22px; width: 22px; object-fit: contain;">
                                </div>
                            <?php else: ?>
                                <span class="text-muted" style="font-size: 0.75rem;">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size: 0.825rem;"><?php echo e($item->name); ?></div>
                        </td>
                        <td>
                            <span class="text-muted" style="font-size: 0.775rem;"><?php echo e($item->slug); ?></span>
                        </td>
                        <td class="text-center text-muted" style="font-size: 0.8rem;"><?php echo e($item->display_order); ?></td>
                        <td class="text-center">
                            <?php if($item->status == 'active'): ?>
                                <span class="badge-minimal badge-minimal-success">Hiển thị</span>
                            <?php else: ?>
                                <span class="badge-minimal">Đang ẩn</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <a href="<?php echo e(route('admin.categories.edit', $item->id)); ?>" class="btn-minimal py-1 px-2 text-decoration-none me-1" style="font-size: 0.75rem;">Sửa</a>
                            <?php if(($item->locations_count ?? 0) > 0): ?>
                                <button type="button" class="btn-minimal py-1 px-2 text-muted" style="font-size: 0.75rem; cursor: not-allowed; opacity: 0.5;" title="Danh mục này đang chứa <?php echo e($item->locations_count); ?> địa điểm du lịch, không thể xóa" disabled>Xóa</button>
                            <?php else: ?>
                                <form action="<?php echo e(route('admin.categories.destroy', $item->id)); ?>" method="POST" class="d-inline" 
                                      data-confirm-title="Xóa danh mục" 
                                      data-confirm-text="Bạn có chắc chắn muốn xóa danh mục <strong>&quot;<?php echo e($item->name); ?>&quot;</strong> không? Thao tác này không thể hoàn tác." 
                                      data-confirm-btn="Xóa danh mục" 
                                      data-confirm-type="danger">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size: 0.75rem;">Xóa</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Chưa có danh mục nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($categories->hasPages()): ?>
    <div class="p-3 border-top" style="border-color: var(--border-light) !important;">
        <?php echo e($categories->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>