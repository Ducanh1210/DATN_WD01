<?php $__env->startSection('title', 'Bảng điều khiển'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $pendingBiz = \App\Models\BusinessProfile::where('status', 'pending')->count();
    $pendingSuggestions = \App\Models\LocationSuggestion::where('status', 'pending')->count();
    $pendingReportLocations = \App\Models\Report::whereIn('reportable_type', \App\Models\Report::morphTypes(\App\Models\Location::class))->where('status', 'pending')->count();
    $pendingReportComments = \App\Models\Report::whereIn('reportable_type', \App\Models\Report::morphTypes(\App\Models\Comment::class))->where('status', 'pending')->count();
    $pendingFeedbacks = \App\Models\FeedbackReport::where('status', 'pending')->count();
    $pendingTasks = [
        ['label' => 'Duyệt doanh nghiệp', 'count' => $pendingBiz, 'url' => route('admin.business-profiles.index', ['status' => 'pending'])],
        ['label' => 'Đề xuất địa điểm', 'count' => $pendingSuggestions, 'url' => route('admin.contributions.index')],
        ['label' => 'Báo cáo địa điểm', 'count' => $pendingReportLocations, 'url' => route('admin.reports.index', ['tab' => 'locations'])],
        ['label' => 'Báo cáo bình luận', 'count' => $pendingReportComments, 'url' => route('admin.reports.index', ['tab' => 'comments'])],
        ['label' => 'Góp ý / báo lỗi', 'count' => $pendingFeedbacks, 'url' => route('admin.reports.index', ['tab' => 'feedbacks'])],
    ];
    $totalPending = collect($pendingTasks)->sum('count');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-header-title">Tổng quan</h1>
        <p class="text-muted mb-0" style="font-size:0.8rem;font-weight:400;">Cập nhật hệ thống thông tin địa điểm Ninh Bình Travel Hub</p>
    </div>
    <div class="text-muted" style="font-size:0.775rem;">
        Hôm nay: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?>

    </div>
</div>

<div class="card-minimal mb-4">
    <div class="card-header-minimal d-flex justify-content-between align-items-center">
        <span>Việc cần xử lý</span>
        <?php if($totalPending > 0): ?>
            <span class="badge-count"><?php echo e($totalPending); ?></span>
        <?php endif; ?>
    </div>
    <div class="p-3">
        <div class="row g-2">
            <?php $__currentLoopData = $pendingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <a href="<?php echo e($task['url']); ?>" class="pending-task-link <?php echo e($task['count'] > 0 ? 'has-pending' : ''); ?>">
                    <span><?php echo e($task['label']); ?></span>
                    <?php if($task['count'] > 0): ?>
                        <span class="badge-count"><?php echo e($task['count']); ?></span>
                    <?php else: ?>
                        <span class="text-muted" style="font-size:0.75rem;">0</span>
                    <?php endif; ?>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<div class="metric-strip mb-4">
    <div class="row g-0 align-items-center">
        <div class="col-6 col-md-3 metric-item">
            <div class="metric-label">Địa điểm du lịch</div>
            <div class="metric-value"><?php echo e(\App\Models\Location::count()); ?></div>
        </div>
        <div class="col-6 col-md-3 metric-item">
            <div class="metric-label">Tin tức & Sự kiện</div>
            <div class="metric-value"><?php echo e(\App\Models\News::count() + \App\Models\Event::count()); ?></div>
        </div>
        <div class="col-6 col-md-3 metric-item mt-3 mt-md-0">
            <div class="metric-label">Người dùng</div>
            <div class="metric-value"><?php echo e(\App\Models\User::count()); ?></div>
        </div>
        <div class="col-6 col-md-3 metric-item mt-3 mt-md-0">
            <div class="metric-label">Bình luận (7 ngày)</div>
            <div class="metric-value"><?php echo e(\App\Models\Comment::where('created_at', '>=', now()->subDays(7))->count()); ?></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card-minimal">
            <div class="card-header-minimal d-flex justify-content-between align-items-center">
                <span>Địa điểm vừa thêm gần đây</span>
                <a href="<?php echo e(route('admin.locations.index')); ?>" class="btn-minimal">Quản lý</a>
            </div>
            <div class="table-responsive">
                <table class="table table-minimal">
                    <thead>
                        <tr>
                            <th>Tên địa điểm</th>
                            <th>Danh mục</th>
                            <th class="text-end">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = \App\Models\Location::with('category')->orderBy('created_at', 'desc')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="fw-medium text-dark" style="font-size:0.825rem;"><?php echo e($loc->name); ?></div>
                                <div class="text-muted" style="font-size:0.75rem;"><?php echo e($loc->address ?? 'Ninh Bình'); ?></div>
                            </td>
                            <td>
                                <span class="badge-minimal"><?php echo e($loc->category->name ?? 'Mặc định'); ?></span>
                            </td>
                            <td class="text-end text-muted" style="font-size:0.775rem;">
                                <?php echo e($loc->created_at ? $loc->created_at->format('d/m/Y') : '-'); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Chưa có dữ liệu địa điểm.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card-minimal">
            <div class="card-header-minimal d-flex justify-content-between align-items-center">
                <span>Tài khoản mới</span>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="btn-minimal">Xem thêm</a>
            </div>
            <ul class="list-group list-group-flush border-0">
                <?php $__currentLoopData = \App\Models\User::orderBy('created_at', 'desc')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex align-items-center justify-content-between px-3 py-2.5 border-bottom" style="border-color:#f1f5f9!important;">
                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                        <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => $user,'size' => '26']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user),'size' => '26']); ?>
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
                        <div class="text-truncate">
                            <div class="text-dark" style="font-size:0.8rem;font-weight:500;"><?php echo e($user->display_name ?? $user->username); ?></div>
                            <div class="text-muted text-truncate" style="font-size:0.725rem;"><?php echo e($user->email); ?></div>
                        </div>
                    </div>
                    <span class="text-muted flex-shrink-0 ms-2" style="font-size:0.7rem;">
                        <?php echo e($user->created_at->diffForHumans(null, true, true)); ?>

                    </span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>