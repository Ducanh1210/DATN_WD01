<?php $__env->startSection('title', 'Quản lý Bình luận'); ?>

<?php $__env->startSection('content'); ?>
<!-- AI Moderation Banner -->
<div class="card-minimal mb-3 p-3">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
        <div>
            <div class="fw-semibold text-dark d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                <i class="fas fa-robot"></i> Kiểm duyệt bằng AI
            </div>
            <div class="text-muted mt-1" style="font-size: 0.775rem;">
                AI quét bình luận và gắn cờ nội dung nghi ngờ / vi phạm để bạn xem xét nhanh.
                <span class="text-danger fw-medium"><?php echo e($aiStats['violation']); ?> vi phạm</span> ·
                <span class="fw-medium" style="color:#b45309;"><?php echo e($aiStats['suspect']); ?> nghi ngờ</span> ·
                <span class="text-secondary"><?php echo e($aiStats['unchecked']); ?> chưa quét</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <?php if($aiConfigured): ?>
                <button type="button" id="btnScanAi" class="btn-minimal btn-minimal-primary" data-scope="unchecked">
                    <i class="fas fa-magic me-1"></i><span class="scan-label">Quét bình luận mới</span>
                </button>
                <button type="button" id="btnScanAll" class="btn-minimal" data-scope="all" title="Quét lại toàn bộ bình luận">
                    Quét lại tất cả
                </button>
            <?php else: ?>
                <span class="badge-minimal text-muted">Chưa cấu hình API Key AI</span>
            <?php endif; ?>
        </div>
    </div>
    <div id="scanProgress" class="text-muted mt-2 d-none" style="font-size: 0.775rem;">
        <span class="spinner-border spinner-border-sm me-1" role="status"></span>
        Đang quét bằng AI, vui lòng đợi...
    </div>
</div>

<!-- Search & Filter Form Minimalist -->
<div class="card-minimal mb-3 p-3">
    <form action="<?php echo e(route('admin.comments.index')); ?>" method="GET" class="row g-2 align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm theo nội dung, tên user..." value="<?php echo e(request('search')); ?>" style="border-color: #e2e8f0;">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select form-select-sm" style="border-color: #e2e8f0;">
                <option value="">-- Trạng thái --</option>
                <option value="visible" <?php echo e(request('status') == 'visible' ? 'selected' : ''); ?>>Hiển thị</option>
                <option value="hidden" <?php echo e(request('status') == 'hidden' ? 'selected' : ''); ?>>Đang ẩn</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="ai_flag" class="form-select form-select-sm" style="border-color: #e2e8f0;">
                <option value="">-- AI: Tất cả --</option>
                <option value="violation" <?php echo e(request('ai_flag') == 'violation' ? 'selected' : ''); ?>>Vi phạm</option>
                <option value="suspect" <?php echo e(request('ai_flag') == 'suspect' ? 'selected' : ''); ?>>Nghi ngờ</option>
                <option value="safe" <?php echo e(request('ai_flag') == 'safe' ? 'selected' : ''); ?>>An toàn</option>
                <option value="unchecked" <?php echo e(request('ai_flag') == 'unchecked' ? 'selected' : ''); ?>>Chưa quét</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn-minimal btn-minimal-primary flex-fill">Tìm kiếm</button>
            <a href="<?php echo e(route('admin.comments.index', ['sort_risk' => 1])); ?>" class="btn-minimal flex-fill text-center text-decoration-none" title="Sắp xếp rủi ro cao lên đầu">Rủi ro cao</a>
            <a href="<?php echo e(route('admin.comments.index')); ?>" class="btn-minimal flex-fill text-center text-decoration-none">Xóa lọc</a>
        </div>
    </form>
</div>

<div class="card-minimal">
    <div class="table-responsive">
        <table class="table table-minimal align-middle">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">ID</th>
                    <th>Người dùng</th>
                    <th>Địa điểm</th>
                    <th>Nội dung</th>
                    <th class="text-center">AI</th>
                    <th>Thời gian</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-center text-muted" style="font-size: 0.775rem;"><?php echo e($comment->id); ?></td>
                        <td>
                            <div class="fw-medium text-dark" style="font-size: 0.825rem;"><?php echo e($comment->user->display_name ?? ($comment->user->username ?? 'Unknown')); ?></div>
                            <div class="text-muted" style="font-size: 0.725rem;"><?php echo e($comment->user->email ?? ''); ?></div>
                        </td>
                        <td>
                            <?php if($comment->location): ?>
                                <a href="<?php echo e(route('client.locations.360', $comment->location->slug)); ?>" target="_blank" class="text-decoration-none text-primary" style="font-size: 0.8rem;">
                                    <?php echo e($comment->location->name); ?>

                                </a>
                            <?php else: ?>
                                <span class="text-muted" style="font-size: 0.75rem;">Địa điểm đã xóa</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="text-secondary" style="font-size: 0.8rem; max-width: 320px;">
                                <?php echo e(Str::limit($comment->content, 90)); ?>

                            </div>
                        </td>
                        <td class="text-center" style="min-width: 120px;">
                            <?php if($comment->ai_checked_at): ?>
                                <?php
                                    $flag = $comment->ai_flag;
                                    $badgeStyle = 'background:#f1f5f9;color:#64748b;';
                                    $label = 'An toàn';
                                    if ($flag === 'violation') { $badgeStyle = 'background:#fee2e2;color:#b91c1c;'; $label = 'Vi phạm'; }
                                    elseif ($flag === 'suspect') { $badgeStyle = 'background:#fef3c7;color:#b45309;'; $label = 'Nghi ngờ'; }
                                ?>
                                <span class="badge-minimal" style="<?php echo e($badgeStyle); ?> font-weight:500;">
                                    <?php echo e($label); ?><?php if(!is_null($comment->ai_score)): ?> · <?php echo e($comment->ai_score); ?><?php endif; ?>
                                </span>
                                <?php if($comment->ai_reason): ?>
                                    <div class="text-muted mt-1" style="font-size: 0.7rem; max-width: 200px; margin:0 auto;" title="<?php echo e($comment->ai_reason); ?>">
                                        <?php echo e(Str::limit($comment->ai_reason, 60)); ?>

                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted" style="font-size: 0.72rem;">Chưa quét</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-muted" style="font-size: 0.75rem;">
                            <?php echo e($comment->created_at->format('d/m/Y H:i')); ?>

                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-inline-block">
                                <input class="form-check-input toggle-status" type="checkbox" data-id="<?php echo e($comment->id); ?>" <?php echo e($comment->status === 'visible' ? 'checked' : ''); ?> style="cursor: pointer;">
                                <div id="status-label-<?php echo e($comment->id); ?>" class="mt-1">
                                    <?php echo $comment->status === 'visible' ? '<span class="badge-minimal badge-minimal-success">Hiển thị</span>' : '<span class="badge-minimal">Đang ẩn</span>'; ?>

                                </div>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <form action="<?php echo e(route('admin.comments.destroy', $comment->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size: 0.75rem;">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Chưa có bình luận nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($comments->hasPages()): ?>
    <div class="p-3 border-top" style="border-color: var(--border-light) !important;">
        <?php echo e($comments->links('pagination::bootstrap-5')); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtns = document.querySelectorAll('.toggle-status');
        
        toggleBtns.forEach(btn => {
            btn.addEventListener('change', function() {
                const commentId = this.dataset.id;
                const label = document.getElementById('status-label-' + commentId);
                
                fetch(`/admin/comments/${commentId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === 'visible') {
                            label.innerHTML = '<span class="badge-minimal badge-minimal-success">Hiển thị</span>';
                        } else {
                            label.innerHTML = '<span class="badge-minimal">Đang ẩn</span>';
                        }
                    }
                })
                .catch(err => console.error(err));
            });
        });

        // AI moderation scan
        const scanProgress = document.getElementById('scanProgress');
        const scanButtons = [document.getElementById('btnScanAi'), document.getElementById('btnScanAll')].filter(Boolean);

        function runScan(scope, triggerBtn) {
            if (!scanProgress) return;
            scanButtons.forEach(b => b.disabled = true);
            scanProgress.classList.remove('d-none');

            fetch('<?php echo e(route('admin.comments.scan_ai')); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ scope: scope })
            })
            .then(res => res.json())
            .then(data => {
                scanProgress.classList.add('d-none');
                scanButtons.forEach(b => b.disabled = false);
                if (data.success) {
                    alert(data.message || 'Đã quét xong.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Không thể quét lúc này.');
                }
            })
            .catch(err => {
                console.error(err);
                scanProgress.classList.add('d-none');
                scanButtons.forEach(b => b.disabled = false);
                alert('Có lỗi khi quét AI. Vui lòng thử lại.');
            });
        }

        const btnScanAi = document.getElementById('btnScanAi');
        if (btnScanAi) {
            btnScanAi.addEventListener('click', () => runScan('unchecked', btnScanAi));
        }
        const btnScanAll = document.getElementById('btnScanAll');
        if (btnScanAll) {
            btnScanAll.addEventListener('click', () => {
                if (confirm('Quét lại TẤT CẢ bình luận (tối đa 60 mỗi lần)? Thao tác này sẽ ghi đè kết quả AI cũ.')) {
                    runScan('all', btnScanAll);
                }
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/comments/index.blade.php ENDPATH**/ ?>