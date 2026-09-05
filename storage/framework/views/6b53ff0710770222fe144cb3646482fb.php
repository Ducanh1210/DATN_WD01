<?php $__env->startSection('title', 'Yêu cầu làm tour 360'); ?>

<?php $__env->startSection('content'); ?>
<div class="metric-strip mb-3 d-flex flex-wrap align-items-center justify-content-between p-0 overflow-hidden">
    <?php $__currentLoopData = [
        'all' => 'Tất cả',
        'pending' => 'Chờ liên hệ',
        'contacted' => 'Đã liên hệ',
        'done' => 'Hoàn thành',
        'cancelled' => 'Đã hủy',
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.panorama-requests.index', ['status' => $key, 'search' => $search])); ?>"
           class="metric-item flex-fill text-decoration-none py-3 px-3 transition-all <?php echo e($status === $key ? 'bg-light border-bottom border-2' : ''); ?>"
           style="<?php echo e($status === $key ? 'border-bottom-color:#1e3a5f!important;' : ''); ?>">
            <div class="metric-label"><?php echo e($label); ?></div>
            <div class="metric-value text-dark" style="font-size: 1.1rem;"><?php echo e($counts[$key] ?? 0); ?></div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="card-minimal mb-3 p-3">
    <form action="<?php echo e(route('admin.panorama-requests.index')); ?>" method="GET" class="row g-2 align-items-center">
        <input type="hidden" name="status" value="<?php echo e($status); ?>">
        <div class="col-md-9">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm tên địa điểm, SĐT, tài khoản..." value="<?php echo e($search); ?>" style="border-color: #e2e8f0;">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn-minimal btn-minimal-primary w-100 py-1" style="font-size: 0.8rem;">Tìm kiếm</button>
        </div>
    </form>
</div>

<div class="card-minimal">
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Địa điểm</th>
                    <th>Liên hệ</th>
                    <th>Nhu cầu</th>
                    <th>Trạng thái</th>
                    <th>Ngày gửi</th>
                    <th class="text-end pe-3">Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $typeLabels = \App\Models\PanoramaServiceRequest::placeTypeLabels();
                        $sceneLabels = \App\Models\PanoramaServiceRequest::sceneEstimateLabels();
                        $statusLabels = \App\Models\PanoramaServiceRequest::statusLabels();
                    ?>
                    <tr>
                        <td class="text-muted small"><?php echo e($requests->firstItem() + $index); ?></td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size:0.825rem;"><?php echo e($item->place_name); ?></div>
                            <div class="text-muted" style="font-size:0.72rem;"><?php echo e($typeLabels[$item->place_type] ?? '—'); ?></div>
                            <?php if($item->note): ?>
                                <div class="text-secondary mt-1" style="font-size:0.72rem;max-width:280px;"><?php echo e($item->note); ?></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-size:0.8rem;"><?php echo e($item->contact_name); ?></div>
                            <div class="text-muted" style="font-size:0.72rem;"><?php echo e($item->phone); ?></div>
                            <?php if($item->user): ?>
                                <div class="text-muted" style="font-size:0.7rem;"><?php echo e($item->user->email); ?></div>
                            <?php else: ?>
                                <div class="text-muted" style="font-size:0.7rem;">Khách (chưa có TK)</div>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:0.78rem;"><?php echo e($sceneLabels[$item->scene_estimate] ?? '—'); ?></td>
                        <td>
                            <span class="badge-minimal"><?php echo e($statusLabels[$item->status] ?? $item->status); ?></span>
                        </td>
                        <td class="small text-muted"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                        <td class="text-end pe-3">
                            <form action="<?php echo e(route('admin.panorama-requests.update', $item)); ?>" method="POST" class="d-inline-flex gap-1.5 align-items-center justify-content-end flex-wrap">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <select name="status" class="form-select form-select-sm" style="width: auto; min-width: 130px;">
                                    <?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php if($item->status === $key): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button type="submit" class="btn-minimal btn-minimal-primary py-1 px-2.5" style="font-size:0.75rem;">Lưu</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Chưa có yêu cầu nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($requests->hasPages()): ?>
        <div class="p-3"><?php echo e($requests->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/panorama_requests/index.blade.php ENDPATH**/ ?>