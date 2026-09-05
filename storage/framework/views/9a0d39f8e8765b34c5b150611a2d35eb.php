<?php $__env->startSection('title', 'Tin tức — Cổng Thông Tin Du Lịch Ninh Bình'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/heritage.css')); ?>?v=<?php echo e(@filemtime(public_path('css/heritage.css'))); ?>">
<style>
    .news-merge-compact .nb-columns {
        grid-template-columns: 160px 1fr;
        gap: 28px;
    }

    .news-merge-compact .nb-card-grid {
        gap: 18px;
    }

    .news-merge-compact .nb-card__media {
        aspect-ratio: 16 / 10;
    }

    .news-merge-compact .nb-card__body {
        padding: 16px;
    }

    .news-merge-compact .nb-card__title {
        font-size: 1rem;
        line-height: 1.4;
    }

    .news-merge-compact .nb-card__excerpt {
        font-size: 0.8rem;
        line-height: 1.55;
    }

    .news-merge-compact .nb-side__link {
        padding: 12px 0;
        font-size: 0.84rem;
    }

    @media (min-width: 1280px) {
        .news-merge-compact .nb-card-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php
    $placeholder = asset('images/nen03.png');

    /** Định dạng ngày kiểu "15 Tháng 4, 2024". */
    $formatDate = function ($date) {
        if (!$date) {
            return null;
        }

        return $date->format('d') . ' Tháng ' . $date->format('n') . ', ' . $date->format('Y');
    };
?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
    <div class="container py-4">
        <div class="page-header">
            <h1 class="page-header__title">Tin tức & Cẩm nang</h1>
            <p class="page-header__subtitle mb-0">Thông tin du lịch, văn hóa và sự kiện nổi bật tại Ninh Bình</p>
        </div>

        <?php if($featured): ?>
            <div class="row g-4 mb-4 pb-4 border-bottom" style="border-color: #e5e7eb !important;">
                <div class="col-lg-7">
                    <article>
                        <a href="<?php echo e($featured['url']); ?>" class="text-decoration-none editorial-link d-block">
                            <div class="mb-3">
                                <?php echo $__env->make('client.partials.cover-image', [
                                    'src' => $featured['image'],
                                    'alt' => $featured['title'],
                                    'ratio' => '16/9',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <h2 class="editorial-link__title fw-semibold mb-2" style="color: #27272a; font-size: 1.25rem; line-height: 1.4;">
                                <?php echo e($featured['title']); ?>

                            </h2>
                            <?php if($featured['excerpt']): ?>
                                <p class="mb-2" style="color: #52525b; font-size: 0.875rem; line-height: 1.55; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo e($featured['excerpt']); ?>

                                </p>
                            <?php endif; ?>
                            <?php if($featured['date']): ?>
                                <div class="meta-text">
                                    <?php echo e($featured['date']->format('d/m/Y')); ?>

                                </div>
                            <?php endif; ?>
                        </a>
                    </article>
                </div>

                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-3 h-100">
                        <?php $__currentLoopData = $subFeatured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="pb-3 border-bottom" style="border-color: #f4f4f5 !important;">
                                <a href="<?php echo e($sub['url']); ?>" class="text-decoration-none editorial-link d-flex gap-3 align-items-start">
                                    <div style="width: 130px; flex-shrink: 0;">
                                        <?php echo $__env->make('client.partials.cover-image', [
                                            'src' => $sub['image'],
                                            'alt' => $sub['title'],
                                            'ratio' => '4/3',
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <h3 class="editorial-link__title fw-semibold mb-2" style="color: #27272a; font-size: 0.9rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            <?php echo e($sub['title']); ?>

                                        </h3>
                                        <?php if($sub['date']): ?>
                                            <div class="meta-text">
                                                <?php echo e($sub['date']->format('d/m/Y')); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="nb news-merge-compact">
    
    <section class="nb-section nb-section--tight">
        <div class="nb-wrap">
            <div class="nb-columns">

                <aside>
                    <div class="nb-side">
                        <div class="nb-side__title">Danh mục</div>
                        <ul class="nb-side__list">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('client.events.index', $key === 'all' ? [] : ['cat' => $key])); ?>"
                                       class="nb-side__link <?php echo e($cat === $key ? 'is-active' : ''); ?>">
                                        <span><?php echo e($meta['label']); ?></span>
                                        <span class="nb-side__count"><?php echo e($meta['count']); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </aside>

                <div>
                    <?php if($items->isNotEmpty()): ?>
                        <div class="nb-card-grid">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($item['url']); ?>" class="nb-card">
                                    <div class="nb-card__media">
                                        <img src="<?php echo e($item['image'] ?: $placeholder); ?>"
                                             alt="<?php echo e($item['title']); ?>"
                                             class="nb-card__img"
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='<?php echo e($placeholder); ?>';">
                                        <span class="nb-chip <?php echo e($item['kind'] === 'event' ? 'nb-chip--warm' : 'nb-chip--ink'); ?> nb-card__chip"><?php echo e($item['label']); ?></span>
                                    </div>
                                    <div class="nb-card__body">
                                        <?php if($item['date']): ?>
                                            <div class="nb-card__date"><?php echo e($formatDate($item['date'])); ?></div>
                                        <?php endif; ?>
                                        <h3 class="nb-card__title"><?php echo e($item['title']); ?></h3>
                                        <?php if($item['excerpt']): ?>
                                            <p class="nb-card__excerpt"><?php echo e($item['excerpt']); ?></p>
                                        <?php endif; ?>
                                        <span class="nb-card__more">Đọc tiếp</span>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if($items->hasPages()): ?>
                            <div class="nb-pager">
                                <?php echo e($items->links('pagination::bootstrap-5')); ?>

                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="nb-empty">
                            <h3 class="nb-empty__title">Chưa có nội dung trong danh mục này</h3>
                            <p class="nb-empty__text">
                                Hãy chọn một danh mục khác hoặc quay lại sau — nội dung mới được cập nhật thường xuyên.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/client/events/index.blade.php ENDPATH**/ ?>