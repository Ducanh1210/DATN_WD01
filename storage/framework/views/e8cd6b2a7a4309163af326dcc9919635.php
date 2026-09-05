<?php $__env->startSection('title', match($tab ?? 'locations') {
    'comments' => 'Báo cáo bình luận',
    'feedbacks' => 'Góp ý / báo lỗi',
    default => 'Báo cáo địa điểm',
}); ?>

<?php $__env->startSection('content'); ?>
<div class="card-minimal">
    <div class="card-header-minimal">
        <?php echo e(match($tab ?? 'locations') {
            'comments' => 'Báo cáo bình luận',
            'feedbacks' => 'Góp ý / báo lỗi bản đồ',
            default => 'Báo cáo địa điểm',
        }); ?>

    </div>

    <?php if(($tab ?? 'locations') === 'feedbacks'): ?>
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th style="width:50px;">ID</th>
                    <th>Người gửi</th>
                    <th>Loại</th>
                    <th>Nội dung</th>
                    <th>Ngày</th>
                    <th>Trạng thái</th>
                    <th class="text-end pe-4">Xem</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-muted" style="font-size:0.75rem;"><?php echo e($item->id); ?></td>
                    <td style="font-size:0.825rem;"><?php echo e($item->user->display_name ?? ($item->user->username ?? 'Khách')); ?></td>
                    <td><span class="badge-minimal"><?php echo e($item->report_type); ?></span></td>
                    <td style="white-space:normal;max-width:280px;font-size:0.8rem;"><?php echo e(\Illuminate\Support\Str::limit($item->content, 80)); ?></td>
                    <td class="text-muted" style="font-size:0.75rem;"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                    <td>
                        <?php if($item->status === 'pending'): ?>
                            <span class="badge-minimal-warning">Chưa xem</span>
                        <?php elseif($item->status === 'resolved'): ?>
                            <span class="badge-minimal-success">Đã ghi nhận</span>
                        <?php elseif($item->status === 'rejected'): ?>
                            <span class="badge-minimal-danger">Bỏ qua</span>
                        <?php else: ?>
                            <span class="badge-minimal"><?php echo e($item->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-inline-flex gap-1 align-items-center justify-content-end">
                            <a href="<?php echo e(route('admin.reports.feedbacks.show', $item->id)); ?>" class="btn-minimal py-1 px-2" style="font-size:0.75rem;">Chi tiết</a>
                            <form action="<?php echo e(route('admin.reports.feedbacks.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Xóa góp ý này?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size:0.75rem;">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Chưa có góp ý nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($feedbacks->hasPages()): ?>
    <div class="p-3 border-top"><?php echo e($feedbacks->links('pagination::bootstrap-5')); ?></div>
    <?php endif; ?>

    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th class="text-center" style="width:50px;">ID</th>
                    <th>Người báo cáo</th>
                    <?php if(($tab ?? 'locations') === 'comments'): ?>
                        <th>Nội dung bình luận</th>
                        <th>Tại địa điểm</th>
                    <?php else: ?>
                        <th>Địa điểm bị báo cáo</th>
                    <?php endif; ?>
                    <th>Lý do</th>
                    <th>Chi tiết</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th class="text-end pe-4">Xem</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center text-muted" style="font-size:0.775rem;"><?php echo e($report->id); ?></td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size:0.825rem;">
                                <?php echo e($report->reporter->display_name ?? ($report->reporter->username ?? 'Unknown')); ?>

                            </div>
                        </td>
                        <?php if(($tab ?? 'locations') === 'comments'): ?>
                            <td style="font-size:0.8rem;max-width:220px;white-space:normal;">
                                <?php if($report->reportable): ?>
                                    <?php echo e(Str::limit($report->reportable->content, 80)); ?>

                                <?php else: ?>
                                    <span class="text-danger" style="font-size:0.75rem;">Đã bị xóa</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:0.8rem;">
                                <?php if($report->reportable?->location): ?>
                                    <?php echo e($report->reportable->location->name); ?>

                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td style="font-size:0.825rem;">
                                <?php if($report->reportable): ?>
                                    <span class="fw-medium" style="color:#0f2442;"><?php echo e($report->reportable->name); ?></span>
                                <?php else: ?>
                                    <span class="text-danger" style="font-size:0.75rem;">Đã bị xóa</span>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                        <td>
                            <div class="fw-medium text-secondary" style="font-size:0.8rem;"><?php echo e($report->reason); ?></div>
                        </td>
                        <td>
                            <div class="text-muted" style="font-size:0.75rem;"><?php echo e($report->description ?? 'Không có'); ?></div>
                        </td>
                        <td class="text-muted" style="font-size:0.75rem;">
                            <?php echo e($report->created_at->format('d/m/Y H:i')); ?>

                        </td>
                        <td>
                            <form action="<?php echo e(route('admin.reports.update_status', $report->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto; min-width: 120px;">
                                    <option value="pending" <?php if($report->status === 'pending'): echo 'selected'; endif; ?>>Chờ xử lý</option>
                                    <option value="resolved" <?php if($report->status === 'resolved'): echo 'selected'; endif; ?>>Đã xử lý</option>
                                    <option value="rejected" <?php if($report->status === 'rejected'): echo 'selected'; endif; ?>>Từ chối</option>
                                </select>
                            </form>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-1 align-items-center justify-content-end">
                                <?php if(($tab ?? 'locations') === 'comments'): ?>
                                    <?php if($report->reportable?->location_id): ?>
                                        <a href="<?php echo e(route('admin.locations.edit', $report->reportable->location_id)); ?>" class="btn-minimal py-1 px-2" style="font-size:0.75rem;">Chi tiết</a>
                                    <?php endif; ?>
                                <?php elseif($report->reportable): ?>
                                    <a href="<?php echo e(route('admin.locations.edit', $report->reportable_id)); ?>" class="btn-minimal py-1 px-2" style="font-size:0.75rem;">Chi tiết</a>
                                <?php endif; ?>
                                <form action="<?php echo e(route('admin.reports.destroy', $report->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Xóa báo cáo này khỏi danh sách?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size:0.75rem;">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="<?php echo e(($tab ?? 'locations') === 'comments' ? 9 : 8); ?>" class="text-center text-muted py-4">
                            Chưa có báo cáo <?php echo e(($tab ?? 'locations') === 'comments' ? 'bình luận' : 'địa điểm'); ?> nào.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($reports->hasPages()): ?>
    <div class="p-3 border-top" style="border-color:var(--border-light)!important;">
        <?php echo e($reports->links('pagination::bootstrap-5')); ?>

    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/reports/index.blade.php ENDPATH**/ ?>