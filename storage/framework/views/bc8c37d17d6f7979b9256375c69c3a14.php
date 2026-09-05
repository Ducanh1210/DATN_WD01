<?php $__env->startSection('title', 'Đề xuất địa điểm'); ?>

<?php $__env->startSection('content'); ?>
<div class="card-minimal">
    <div class="card-header-minimal">Đề xuất địa điểm từ người dùng</div>
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th style="width:50px;">ID</th>
                    <th>Tên đề xuất</th>
                    <th>Người gửi</th>
                    <th>Danh mục gợi ý</th>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $suggestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-muted" style="font-size:0.75rem;"><?php echo e($item->id); ?></td>
                    <td>
                        <div class="fw-medium" style="font-size:0.825rem;color:#0f2442;"><?php echo e($item->name); ?></div>
                        <?php if($item->address): ?>
                            <div class="text-muted" style="font-size:0.72rem;white-space:normal;max-width:240px;"><?php echo e(\Illuminate\Support\Str::limit($item->address, 60)); ?></div>
                        <?php endif; ?>
                    </td>
                    <td style="font-size:0.825rem;"><?php echo e($item->user->display_name ?? ($item->user->username ?? '—')); ?></td>
                    <td><span class="badge-minimal"><?php echo e($item->category_suggest ?: '—'); ?></span></td>
                    <td class="text-muted" style="font-size:0.75rem;"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                    <td>
                        <?php if($item->status === 'pending'): ?>
                            <span class="badge-minimal-warning">Chưa xem</span>
                        <?php elseif($item->status === 'approved'): ?>
                            <span class="badge-minimal-success">Đã ghi nhận</span>
                        <?php elseif($item->status === 'rejected'): ?>
                            <span class="badge-minimal-danger">Bỏ qua</span>
                        <?php else: ?>
                            <span class="badge-minimal"><?php echo e($item->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-inline-flex gap-1 flex-wrap justify-content-end">
                            <a href="<?php echo e(route('admin.contributions.suggestions.show', $item->id)); ?>" class="btn-minimal py-1 px-2" style="font-size:0.75rem;">Chi tiết</a>
                            <form action="<?php echo e(route('admin.contributions.suggestions.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Xóa đề xuất địa điểm này?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size:0.75rem;">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Chưa có đề xuất nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($suggestions->hasPages()): ?>
    <div class="p-3 border-top"><?php echo e($suggestions->links('pagination::bootstrap-5')); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/contributions/index.blade.php ENDPATH**/ ?>