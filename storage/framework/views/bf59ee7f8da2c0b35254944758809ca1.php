<?php $__env->startSection('title', 'Quản lý Tin tức'); ?>

<?php $__env->startSection('actions'); ?>
    <a href="<?php echo e(route('admin.news.create')); ?>" class="btn-minimal btn-minimal-primary">Thêm bài viết</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Horizontal Metric Strip -->
<div class="metric-strip mb-3">
    <div class="row g-0 align-items-center">
        <div class="col-6 col-md-3 metric-item">
            <div class="metric-label">Tổng bài viết</div>
            <div class="metric-value"><?php echo e(\App\Models\News::count()); ?></div>
        </div>
        <div class="col-6 col-md-3 metric-item">
            <div class="metric-label">Đã xuất bản</div>
            <div class="metric-value"><?php echo e(\App\Models\News::where('status','published')->count()); ?></div>
        </div>
        <div class="col-6 col-md-3 metric-item mt-3 mt-md-0">
            <div class="metric-label">Bản nháp</div>
            <div class="metric-value"><?php echo e(\App\Models\News::where('status','draft')->count()); ?></div>
        </div>
        <div class="col-6 col-md-3 metric-item mt-3 mt-md-0">
            <div class="metric-label">Tổng lượt xem</div>
            <div class="metric-value"><?php echo e(number_format(\App\Models\News::sum('view_count'))); ?></div>
        </div>
    </div>
</div>

<!-- Minimalist Filters -->
<div class="card-minimal mb-3 p-3">
    <form method="GET" action="<?php echo e(route('admin.news.index')); ?>" class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Nhập tiêu đề hoặc nội dung..." value="<?php echo e(request('search')); ?>" style="border-color: #e2e8f0;">
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select form-select-sm" style="border-color: #e2e8f0;">
                <option value="">-- Tất cả loại --</option>
                <option value="news" <?php echo e(request('type') == 'news' ? 'selected' : ''); ?>>Tin tức</option>
                <option value="event" <?php echo e(request('type') == 'event' ? 'selected' : ''); ?>>Sự kiện</option>
                <option value="guide" <?php echo e(request('type') == 'guide' ? 'selected' : ''); ?>>Cẩm nang</option>
                <option value="announcement" <?php echo e(request('type') == 'announcement' ? 'selected' : ''); ?>>Thông báo</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select form-select-sm" style="border-color: #e2e8f0;">
                <option value="">-- Trạng thái --</option>
                <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Đã xuất bản</option>
                <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Bản nháp</option>
                <option value="hidden" <?php echo e(request('status') == 'hidden' ? 'selected' : ''); ?>>Đã ẩn</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn-minimal btn-minimal-primary flex-fill">Lọc</button>
            <a href="<?php echo e(route('admin.news.index')); ?>" class="btn-minimal text-decoration-none px-3 text-center">Làm mới</a>
        </div>
    </form>
</div>

<!-- News Table Minimalist -->
<div class="card-minimal">
    <div class="table-responsive">
        <table class="table table-minimal align-middle mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">ID</th>
                    <th style="width: 60px;">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th class="text-center">Loại</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Lượt xem</th>
                    <th>Tác giả</th>
                    <th>Ngày đăng</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center text-muted" style="font-size: 0.775rem;"><?php echo e($item->id); ?></td>
                    <td>
                        <?php if($item->featured_image): ?>
                            <img src="<?php echo e(asset('storage/' . $item->featured_image)); ?>" alt="" class="rounded" style="width: 48px; height: 32px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 48px; height: 32px; font-size: 0.65rem;">No Img</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="fw-medium text-dark" style="font-size: 0.825rem; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?php echo e($item->title); ?></div>
                        <?php if($item->summary): ?>
                            <div class="text-muted" style="font-size: 0.725rem; max-width: 280px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?php echo e($item->summary); ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <span class="badge-minimal">
                            <?php echo e($item->type_label); ?>

                        </span>
                    </td>
                    <td class="text-center">
                        <?php if($item->status == 'published'): ?>
                            <span class="badge-minimal badge-minimal-success">Đã xuất bản</span>
                        <?php elseif($item->status == 'draft'): ?>
                            <span class="badge-minimal">Bản nháp</span>
                        <?php else: ?>
                            <span class="badge-minimal" style="background: #fef2f2; color: #991b1b; border: 1px solid #fee2e2;">Đã ẩn</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center text-muted" style="font-size: 0.775rem;">
                        <?php echo e(number_format($item->view_count)); ?>

                    </td>
                    <td>
                        <span class="text-muted" style="font-size: 0.775rem;"><?php echo e($item->author->display_name ?? $item->author->username ?? '—'); ?></span>
                    </td>
                    <td>
                        <span class="text-muted" style="font-size: 0.75rem;">
                            <?php echo e($item->published_at ? $item->published_at->format('d/m/Y') : '—'); ?>

                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <a href="<?php echo e(route('admin.news.edit', $item->id)); ?>" class="btn-minimal py-1 px-2 text-decoration-none me-1" style="font-size: 0.75rem;">Sửa</a>
                        <form action="<?php echo e(route('admin.news.toggle', $item->id)); ?>" method="POST" class="d-inline me-1">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn-minimal py-1 px-2" style="font-size: 0.75rem;">
                                <?php echo e($item->status === 'published' ? 'Ẩn' : 'Hiện'); ?>

                            </button>
                        </form>
                        <form action="<?php echo e(route('admin.news.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-minimal py-1 px-2 text-danger" style="font-size: 0.75rem;">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">Chưa có bài viết nào.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($news->hasPages()): ?>
    <div class="p-3 border-top" style="border-color: var(--border-light) !important;">
        <?php echo e($news->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/news/index.blade.php ENDPATH**/ ?>