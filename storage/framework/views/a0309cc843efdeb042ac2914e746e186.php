<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Doanh Nghiệp - <?php echo e($businessProfile->business_name); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/avatar-frames.css')); ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --text-heading: #0f2442;
            --text-body: #475569;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --accent-primary: #1e3a5f;
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Be Vietnam Pro', 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: var(--bg-main);
            color: var(--text-body);
            font-size: 0.85rem;
            line-height: 1.5;
            margin: 0;
        }

        .biz-shell { min-height: 100vh; }

        .main-wrapper { min-width: 0; display: flex; flex-direction: column; min-height: 100vh; }
        .page-wrap {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .biz-header {
            background: #fff;
            border-bottom: 1px solid var(--border-light);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .biz-header__inner {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 0.7rem 1.5rem;
        }
        .biz-header__back {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.78rem;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .biz-header__back:hover { color: var(--text-heading); }
        .biz-header__nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex: 1;
            min-width: 0;
            overflow-x: auto;
        }
        .biz-header__user {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }
        .user-pill { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; color: var(--text-heading); }
        .biz-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.42rem 0.75rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 999px;
            font-size: 0.8rem;
            white-space: nowrap;
            transition: background 0.12s, color 0.12s;
        }
        .biz-nav-link:hover { color: var(--text-heading); background: #f8fafc; }
        .biz-nav-link.active {
            color: var(--accent-primary);
            background: #f1f5f9;
            font-weight: 600;
        }
        .biz-nav-link--ghost {
            border: 1px solid var(--border-light);
            background: #fff;
        }
        .biz-nav-link .badge-count {
            font-size: 0.68rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        .content-area { padding: 1.25rem 0 2rem; flex: 1; }

        /* Header gọn */
        .biz-hero {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .biz-hero__top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 1.15rem;
            border-bottom: 1px solid var(--border-light);
            flex-wrap: wrap;
        }
        .biz-hero__name {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-heading);
            margin: 0 0 4px;
        }
        .biz-hero__meta { font-size: 0.78rem; color: var(--text-muted); }
        .biz-hero__actions { display: flex; flex-wrap: wrap; gap: 6px; }
        .biz-hero__stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }
        .biz-stat {
            padding: 0.75rem 1rem;
            border-right: 1px solid var(--border-light);
        }
        .biz-stat:last-child { border-right: none; }
        .biz-stat__val {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-heading);
            font-variant-numeric: tabular-nums;
        }
        .biz-stat__val small { font-size: 0.72rem; font-weight: 400; color: var(--text-muted); }
        .biz-stat__lbl { font-size: 0.7rem; color: var(--text-muted); margin-top: 2px; }

        .btn-minimal {
            font-size: 0.78rem;
            font-weight: 500;
            padding: 0.38rem 0.75rem;
            border-radius: 6px;
            border: 1px solid var(--border-light);
            background: #fff;
            color: var(--text-body);
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        .btn-minimal:hover { background: #f8fafc; color: var(--text-heading); }
        .btn-minimal[disabled] {
            opacity: 0.55;
            cursor: not-allowed;
            pointer-events: none;
        }
        .btn-minimal-primary {
            background: var(--accent-primary);
            border-color: var(--accent-primary);
            color: #fff;
        }
        .btn-minimal-primary:hover { background: #2b4c7e; color: #fff; }
        .btn-minimal-link {
            background: none;
            border: none;
            color: var(--accent-primary);
            padding: 0;
            font-size: 0.78rem;
            cursor: pointer;
            text-decoration: underline;
        }

        .biz-grid { display: grid; gap: 1rem; }
        .biz-grid--2 { grid-template-columns: 1fr 1fr; }
        .biz-grid--3 { grid-template-columns: 1.4fr 1fr; }
        @media (max-width: 992px) {
            .biz-grid--2, .biz-grid--3 { grid-template-columns: 1fr; }
            .biz-hero__stats { grid-template-columns: repeat(2, 1fr); }
            .biz-stat:nth-child(2) { border-right: none; }
            .biz-stat:nth-child(1), .biz-stat:nth-child(2) { border-bottom: 1px solid var(--border-light); }
        }

        .card-minimal {
            background: #fff;
            border: 1px solid var(--border-light);
            border-radius: 8px;
        }
        .card-header-minimal {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border-light);
            font-weight: 600;
            color: var(--text-heading);
            font-size: 0.84rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-body-pad { padding: 0.85rem 1rem; }

        .checklist-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.45rem 0;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.78rem;
        }
        .checklist-item:last-child { border-bottom: none; }
        .checklist-item__mark { width: 14px; color: var(--text-muted); flex-shrink: 0; }
        .checklist-item__mark.done { color: var(--accent-primary); }
        .checklist-item__text { flex: 1; }
        .checklist-item__link {
            font-size: 0.72rem;
            color: var(--accent-primary);
            text-decoration: none;
        }
        .profile-progress {
            height: 4px;
            background: #f1f5f9;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.65rem;
        }
        .profile-progress__bar {
            height: 100%;
            background: var(--accent-primary);
            border-radius: 2px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.8rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row__label { color: var(--text-muted); }
        .info-row__value { color: var(--text-heading); font-weight: 500; text-align: right; word-break: break-word; }
        .description-box {
            background: #f8fafc;
            border: 1px solid var(--border-light);
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 0.8rem;
            line-height: 1.55;
            white-space: pre-line;
        }

        #dashboardMap { height: 260px; width: 100%; }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 8px;
            padding: 0.85rem 1rem 1rem;
        }
        .photo-grid-item {
            aspect-ratio: 4/3;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            position: relative;
            background: #f8fafc;
        }
        .photo-grid-item img { width: 100%; height: 100%; object-fit: cover; }
        .photo-grid-item form { position: absolute; top: 4px; right: 4px; margin: 0; }
        .photo-grid-item .del-btn {
            width: 20px; height: 20px;
            border: 1px solid var(--border-light);
            background: #fff;
            border-radius: 4px;
            font-size: 0.7rem;
            cursor: pointer;
            color: var(--text-muted);
            line-height: 1;
        }

        .empty-state {
            text-align: center;
            padding: 1.75rem 1rem;
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        .empty-state__title { font-weight: 600; color: var(--text-heading); margin-bottom: 4px; }
        .empty-state__desc { margin-bottom: 0.75rem; }

        .tip-text {
            margin: 0 1rem 1rem;
            font-size: 0.74rem;
            color: var(--text-muted);
            line-height: 1.45;
        }

        .contact-preview .info-row { padding: 0.6rem 0; }

        .review-summary {
            display: flex;
            align-items: baseline;
            gap: 1rem;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border-light);
            font-size: 0.8rem;
        }
        .review-summary__score { font-size: 1.5rem; font-weight: 600; color: var(--text-heading); }
        .review-stars { color: #c4a574; letter-spacing: 1px; font-size: 0.78rem; }
        .review-stars .is-empty { color: #e2e8f0; }
        .review-summary__stars { font-size: 0.85rem; }
        .review-summary__meta { color: var(--text-muted); }
        .review-card { padding: 0.85rem 1rem; border-bottom: 1px solid #f8fafc; }
        .review-card:last-child { border-bottom: none; }
        .review-reply {
            margin-top: 0.55rem;
            padding: 0.6rem 0.75rem;
            background: #f8fafc;
            border-left: 2px solid var(--border-light);
            font-size: 0.78rem;
        }
        .review-reply__label { font-size: 0.68rem; color: var(--text-muted); margin-bottom: 2px; }
        .review-reply-form { margin-top: 0.55rem; }
        .review-reply-form.is-hidden { display: none; }
        .review-reply-form textarea { min-height: 56px; font-size: 0.8rem; }
        .review-reply-form .btn-row { display: flex; justify-content: flex-end; gap: 6px; margin-top: 6px; }
        .review-card__actions { margin-top: 0.45rem; }

        .form-control {
            font-size: 0.82rem;
            border-color: #cbdbe8;
            border-radius: 6px;
        }
        .form-control:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 2px rgba(30,58,95,0.06);
        }
        .form-label { font-size: 0.78rem; font-weight: 500; color: var(--text-heading); }

        .tab-pane { display: none; }
        .tab-pane.active { display: block; }

        .mini-preview-row {
            display: flex;
            gap: 6px;
            padding: 0 1rem 0.85rem;
            overflow-x: auto;
        }
        .mini-preview-row img {
            width: 52px;
            height: 40px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid var(--border-light);
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .page-wrap { padding-left: 1rem; padding-right: 1rem; }
            .biz-header__inner {
                flex-wrap: wrap;
                gap: 0.75rem;
                padding: 0.65rem 1rem;
            }
            .biz-header__nav {
                order: 3;
                flex: 1 1 100%;
                padding-bottom: 0.15rem;
            }
            .content-area { padding: 1rem 0 1.5rem; }
        }
    </style>
</head>
<body>
<?php
    $commentCount = $comments->count();
    $menuPhotos = $businessProfile->menu_photos ?? [];
    $legacyStorefrontPhotos = $businessProfile->storefront_photos ?? [];
    $galleryPhotos = array_merge($legacyStorefrontPhotos, $menuPhotos);
    $galleryTotal = count($galleryPhotos);
    $heroImage = $location->resolveThumbnailUrl();
    if (!$heroImage && !empty($businessProfile->avatar_photo)) {
        $heroImage = asset('storage/' . ltrim($businessProfile->avatar_photo, '/'));
    }
    if (!$heroImage && $galleryTotal > 0) {
        $heroImage = asset('storage/' . ltrim($galleryPhotos[0], '/'));
    }
    $hasDescription = !empty(trim((string) $businessProfile->description));
    $hasPublicContact = !empty($businessProfile->public_phone) || !empty($businessProfile->zalo) || !empty($businessProfile->facebook);
    $checklistDone = 0;
    $checklistTotal = 4;
    if ($hasDescription) $checklistDone++;
    if ($galleryTotal > 0) $checklistDone++;
    if ($hasPublicContact) $checklistDone++;
    if ($commentCount > 0) $checklistDone++;
    $profilePercent = (int) round(($checklistDone / $checklistTotal) * 100);
?>

<div class="biz-shell">
    <div class="main-wrapper">
        <header class="biz-header">
            <div class="biz-header__inner">
                <a href="<?php echo e(route('client.profile')); ?>" class="biz-header__back">← Trang cá nhân</a>
                <nav class="biz-header__nav">
                    <a href="#tab-overview" class="biz-nav-link active" data-tab="tab-overview">Tổng quan</a>
                    <a href="#tab-gallery" class="biz-nav-link" data-tab="tab-gallery">Hình ảnh</a>
                    <a href="#tab-reviews" class="biz-nav-link" data-tab="tab-reviews">
                        Đánh giá<?php if($commentCount > 0): ?> <span class="badge-count">(<?php echo e($commentCount); ?>)</span><?php endif; ?>
                    </a>
                    <a href="#tab-contact" class="biz-nav-link" data-tab="tab-contact">Liên hệ</a>
                    <a href="<?php echo e(route('client.pano_service')); ?>" class="biz-nav-link biz-nav-link--ghost" target="_blank" rel="noopener">Tour 360</a>
                </nav>
                <div class="biz-header__user">
                    <div class="user-pill">
                        <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => Auth::user(),'size' => '28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()),'size' => '28']); ?>
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
                        <span><?php echo e(Auth::user()->display_name ?? Auth::user()->username); ?></span>
                    </div>
                </div>
            </div>
        </header>

        <main class="content-area">
            <div class="page-wrap">
            <?php if(session('success')): ?>
                <div class="alert border-0 py-2 px-3 mb-3 bg-white border-start border-3 border-success shadow-sm" style="font-size: 0.8rem; color: #166534;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert border-0 py-2 px-3 mb-3 bg-white border-start border-3 border-danger shadow-sm" style="font-size: 0.8rem; color: #991b1b;">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert border-0 py-2 px-3 mb-3 bg-white border-start border-3 border-danger shadow-sm" style="font-size: 0.8rem; color: #991b1b;">
                    <ul class="mb-0 ps-3"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
                </div>
            <?php endif; ?>

            
            <div class="biz-hero">
                <div class="biz-hero__top">
                    <div>
                        <h1 class="biz-hero__name"><?php echo e($businessProfile->business_name); ?></h1>
                        <div class="biz-hero__meta">
                            <?php echo e($businessProfile->category?->name ?? 'Doanh nghiệp'); ?>

                            · <?php echo e($businessProfile->address_street); ?>, <?php echo e($businessProfile->address_city); ?>

                        </div>
                    </div>
                    <div class="biz-hero__actions">
                        <?php if($location): ?>
                            <a href="<?php echo e(route('client.locations.360', $location->slug)); ?>" target="_blank" class="btn-minimal">Xem trang công khai</a>
                        <?php endif; ?>
                        <button type="button" class="btn-minimal btn-minimal-primary" data-bs-toggle="modal" data-bs-target="#editInfoModal">Sửa mô tả</button>
                        <button type="button" class="btn-minimal" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal" <?php echo e($galleryTotal >= 20 ? 'disabled' : ''); ?>>Tải ảnh</button>
                    </div>
                </div>
                <div class="biz-hero__stats">
                    <div class="biz-stat">
                        <div class="biz-stat__val"><?php echo e(number_format($viewsCount)); ?></div>
                        <div class="biz-stat__lbl">Lượt xem</div>
                    </div>
                    <div class="biz-stat">
                        <div class="biz-stat__val"><?php echo e(number_format($averageRating, 1)); ?><small> /5</small></div>
                        <div class="biz-stat__lbl">Đánh giá TB</div>
                    </div>
                    <div class="biz-stat">
                        <div class="biz-stat__val"><?php echo e(number_format($favoritesCount)); ?></div>
                        <div class="biz-stat__lbl">Yêu thích</div>
                    </div>
                    <div class="biz-stat">
                        <div class="biz-stat__val"><?php echo e(number_format($commentCount)); ?></div>
                        <div class="biz-stat__lbl">Nhận xét</div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane active" id="tab-overview">
                <div class="biz-grid biz-grid--3">
                    <div style="display:flex;flex-direction:column;gap:1rem;">
                        <div class="card-minimal">
                            <div class="card-header-minimal">
                                <span>Thông tin doanh nghiệp</span>
                                <button type="button" class="btn-minimal-link" data-bs-toggle="modal" data-bs-target="#editInfoModal">Sửa</button>
                            </div>
                            <div class="card-body-pad">
                                <div class="info-row">
                                    <span class="info-row__label">SĐT hồ sơ</span>
                                    <span class="info-row__value"><?php echo e($businessProfile->phone ?: '—'); ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-row__label">Website</span>
                                    <span class="info-row__value">
                                        <?php if($businessProfile->website): ?>
                                            <a href="<?php echo e($businessProfile->website); ?>" target="_blank" style="color:var(--accent-primary);text-decoration:none;"><?php echo e($businessProfile->website); ?></a>
                                        <?php else: ?> <span style="color:#94a3b8;font-weight:400;">Chưa cập nhật</span> <?php endif; ?>
                                    </span>
                                </div>
                                <div class="info-row">
                                    <span class="info-row__label">Địa chỉ</span>
                                    <span class="info-row__value"><?php echo e($businessProfile->address_street); ?>, <?php echo e($businessProfile->address_city); ?>, <?php echo e($businessProfile->address_province); ?></span>
                                </div>
                                <div class="pt-2">
                                    <div class="info-row__label mb-1" style="font-size:0.76rem;">Mô tả</div>
                                    <div class="description-box"><?php echo e($businessProfile->description ?? 'Chưa có mô tả. Thêm mô tả giúp khách hiểu rõ hơn về bạn.'); ?></div>
                                </div>
                            </div>
                        </div>

                        <?php if($galleryTotal > 0): ?>
                        <div class="card-minimal">
                            <div class="card-header-minimal">
                                <span>Hình ảnh (<?php echo e($galleryTotal); ?>)</span>
                                <a href="#tab-gallery" class="btn-minimal-link biz-nav-link" data-tab="tab-gallery">Xem tất cả</a>
                            </div>
                            <div class="mini-preview-row">
                                <?php $__currentLoopData = array_slice($galleryPhotos, 0, 6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e(asset('storage/' . $photo)); ?>" alt="">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:1rem;">
                        <div class="card-minimal">
                            <div class="card-header-minimal">
                                <span>Hoàn thiện hồ sơ</span>
                                <span style="font-size:0.72rem;color:var(--text-muted);"><?php echo e($profilePercent); ?>%</span>
                            </div>
                            <div class="card-body-pad">
                                <div class="profile-progress"><div class="profile-progress__bar" style="width:<?php echo e($profilePercent); ?>%"></div></div>
                                <div class="checklist-item">
                                    <span class="checklist-item__mark <?php echo e($hasDescription ? 'done' : ''); ?>"><?php echo e($hasDescription ? '✓' : '○'); ?></span>
                                    <span class="checklist-item__text">Viết mô tả doanh nghiệp</span>
                                    <?php if (! ($hasDescription)): ?><a href="#" class="checklist-item__link" data-bs-toggle="modal" data-bs-target="#editInfoModal">Thêm</a><?php endif; ?>
                                </div>
                                <div class="checklist-item">
                                    <span class="checklist-item__mark <?php echo e($galleryTotal > 0 ? 'done' : ''); ?>"><?php echo e($galleryTotal > 0 ? '✓' : '○'); ?></span>
                                    <span class="checklist-item__text">Tải ít nhất 1 hình ảnh</span>
                                    <?php if($galleryTotal === 0): ?><button type="button" class="checklist-item__link" style="border:none;background:none;cursor:pointer;padding:0;" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">Tải</button><?php endif; ?>
                                </div>
                                <div class="checklist-item">
                                    <span class="checklist-item__mark <?php echo e($hasPublicContact ? 'done' : ''); ?>"><?php echo e($hasPublicContact ? '✓' : '○'); ?></span>
                                    <span class="checklist-item__text">Thêm liên hệ cho khách</span>
                                    <?php if (! ($hasPublicContact)): ?><a href="#tab-contact" class="checklist-item__link biz-nav-link" data-tab="tab-contact">Cập nhật</a><?php endif; ?>
                                </div>
                                <div class="checklist-item">
                                    <span class="checklist-item__mark <?php echo e($commentCount > 0 ? 'done' : ''); ?>"><?php echo e($commentCount > 0 ? '✓' : '○'); ?></span>
                                    <span class="checklist-item__text">Theo dõi đánh giá khách</span>
                                    <?php if($commentCount > 0): ?><a href="#tab-reviews" class="checklist-item__link biz-nav-link" data-tab="tab-reviews">Mở</a><?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="card-minimal">
                            <div class="card-header-minimal">Vị trí trên bản đồ</div>
                            <div id="dashboardMap"></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane" id="tab-gallery">
                <div class="card-minimal">
                    <div class="card-header-minimal">
                        <span>Hình ảnh địa điểm (<?php echo e($galleryTotal); ?>)</span>
                        <button type="button" class="btn-minimal btn-minimal-primary" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal" <?php echo e($galleryTotal >= 20 ? 'disabled' : ''); ?>>Tải ảnh</button>
                    </div>
                    <?php if($galleryTotal > 0): ?>
                        <div class="photo-grid">
                            <?php $__currentLoopData = $legacyStorefrontPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="photo-grid-item">
                                    <a href="<?php echo e(asset('storage/' . $photo)); ?>" target="_blank"><img src="<?php echo e(asset('storage/' . $photo)); ?>" alt=""></a>
                                    <form action="<?php echo e(route('business.delete_photo')); ?>" method="POST" onsubmit="return confirm('Xóa ảnh này?');">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <input type="hidden" name="type" value="storefront"><input type="hidden" name="index" value="<?php echo e($index); ?>">
                                        <button type="submit" class="del-btn">×</button>
                                    </form>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $menuPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="photo-grid-item">
                                    <a href="<?php echo e(asset('storage/' . $photo)); ?>" target="_blank"><img src="<?php echo e(asset('storage/' . $photo)); ?>" alt=""></a>
                                    <form action="<?php echo e(route('business.delete_photo')); ?>" method="POST" onsubmit="return confirm('Xóa ảnh này?');">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <input type="hidden" name="type" value="menu"><input type="hidden" name="index" value="<?php echo e($index); ?>">
                                        <button type="submit" class="del-btn">×</button>
                                    </form>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <p class="tip-text">Ảnh rõ nét (không gian, món ăn, bảng giá) giúp khách quyết định ghé thăm nhanh hơn.</p>
                    <?php else: ?>
                        <div class="empty-state">
                            <div class="empty-state__title">Chưa có hình ảnh</div>
                            <div class="empty-state__desc">Tải ảnh không gian, món ăn hoặc bảng giá — khách sẽ thấy trên trang địa điểm của bạn.</div>
                            <button type="button" class="btn-minimal btn-minimal-primary mt-2" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal" <?php echo e($galleryTotal >= 20 ? 'disabled' : ''); ?>>Tải ảnh đầu tiên</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="tab-pane" id="tab-contact">
                <div class="biz-grid biz-grid--2">
                    <div class="card-minimal">
                        <div class="card-header-minimal">Cập nhật liên hệ</div>
                        <form action="<?php echo e(route('business.update_contact')); ?>" method="POST" class="card-body-pad">
                            <?php echo csrf_field(); ?>
                            <p style="font-size:0.76rem;color:var(--text-muted);margin-bottom:1rem;line-height:1.45;">
                                Ba kênh này hiện khi khách mở trang địa điểm trên bản đồ. Khác với SĐT dùng lúc đăng ký duyệt hồ sơ.
                            </p>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['public_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="public_phone" value="<?php echo e(old('public_phone', $businessProfile->public_phone)); ?>" placeholder="VD: 0912345678" maxlength="30">
                                <?php $__errorArgs = ['public_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-1" style="font-size:0.72rem;"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Zalo</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['zalo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="zalo" value="<?php echo e(old('zalo', $businessProfile->zalo)); ?>" placeholder="Số Zalo hoặc https://zalo.me/..." maxlength="255">
                                <?php $__errorArgs = ['zalo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-1" style="font-size:0.72rem;"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['facebook'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="facebook" value="<?php echo e(old('facebook', $businessProfile->facebook)); ?>" placeholder="https://facebook.com/ten-trang" maxlength="255">
                                <?php $__errorArgs = ['facebook'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-1" style="font-size:0.72rem;"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <button type="submit" class="btn-minimal btn-minimal-primary">Lưu liên hệ</button>
                        </form>
                    </div>
                    <div class="card-minimal">
                        <div class="card-header-minimal">Khách sẽ thấy</div>
                        <div class="card-body-pad contact-preview">
                            <div class="info-row">
                                <span class="info-row__label">Điện thoại</span>
                                <span class="info-row__value" style="<?php echo e($businessProfile->public_phone ? '' : 'color:#94a3b8;font-weight:400;'); ?>"><?php echo e($businessProfile->public_phone ?: 'Chưa có'); ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-row__label">Zalo</span>
                                <span class="info-row__value" style="<?php echo e($businessProfile->zalo ? '' : 'color:#94a3b8;font-weight:400;'); ?>"><?php echo e($businessProfile->zalo ?: 'Chưa có'); ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-row__label">Facebook</span>
                                <span class="info-row__value" style="<?php echo e($businessProfile->facebook ? '' : 'color:#94a3b8;font-weight:400;'); ?>"><?php echo e($businessProfile->facebook ?: 'Chưa có'); ?></span>
                            </div>
                            <p class="tip-text" style="margin:0.75rem 0 0;">Facebook chỉ nhận link dạng facebook.com.</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane" id="tab-reviews">
                <div class="card-minimal">
                    <div class="card-header-minimal">Nhận xét từ khách hàng</div>
                    <?php if($commentCount > 0): ?>
                        <div class="review-summary">
                            <div>
                                <div class="review-summary__score"><?php echo e(number_format($averageRating, 1)); ?></div>
                                <div class="review-stars review-summary__stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= round($averageRating)): ?>★<?php else: ?><span class="is-empty">★</span><?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <div class="review-summary__meta"><?php echo e($commentCount); ?> nhận xét · <?php echo e($favoritesCount); ?> lượt lưu</div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $bizReply = $comment->replies->firstWhere('user_id', Auth::id()) ?? $comment->replies->first();
                        ?>
                        <div class="review-card">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <div class="d-flex align-items-center gap-2">
                                    <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => $comment->user,'size' => '34']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($comment->user),'size' => '34']); ?>
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
                                        <div style="font-size:0.82rem;font-weight:600;color:var(--text-heading);"><?php echo e($comment->user->display_name ?? $comment->user->username); ?></div>
                                        <div style="color:var(--text-muted);font-size:0.68rem;"><?php echo e($comment->created_at->format('d/m/Y H:i')); ?></div>
                                    </div>
                                </div>
                                <div class="review-stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?><?php if($i <= ($comment->rating ?? 5)): ?>★<?php else: ?><span class="is-empty">★</span><?php endif; ?> <?php endfor; ?>
                                </div>
                            </div>
                            <p class="mb-0" style="font-size:0.82rem;color:var(--text-body);"><?php echo e($comment->content); ?></p>
                            <?php if($bizReply): ?>
                                <div class="review-reply">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div>
                                            <div class="review-reply__label">Phản hồi của bạn</div>
                                            <p class="review-reply__text mb-0"><?php echo e($bizReply->content); ?></p>
                                        </div>
                                        <div class="d-flex gap-2 flex-shrink-0">
                                            <button type="button" class="btn-minimal-link review-reply-toggle">Sửa</button>
                                            <form action="<?php echo e(route('business.delete_reply', $comment)); ?>" method="POST" onsubmit="return confirm('Thu hồi câu trả lời này?');">
                                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn-minimal" style="color:#b91c1c;border-color:#fecaca;font-size:0.72rem;">Thu hồi</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="review-card__actions">
                                    <button type="button" class="btn-minimal-link review-reply-toggle">Trả lời</button>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('business.reply_comment', $comment)); ?>" method="POST" class="review-reply-form is-hidden">
                                <?php echo csrf_field(); ?>
                                <textarea class="form-control" name="content" rows="2" maxlength="1000" placeholder="<?php echo e($bizReply ? 'Sửa câu trả lời...' : 'Viết trả lời cho khách...'); ?>" required><?php echo e($bizReply?->content); ?></textarea>
                                <div class="btn-row">
                                    <button type="button" class="btn-minimal review-reply-cancel">Hủy</button>
                                    <button type="submit" class="btn-minimal btn-minimal-primary"><?php echo e($bizReply ? 'Cập nhật' : 'Gửi trả lời'); ?></button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            <div class="empty-state__title">Chưa có đánh giá</div>
                            <div class="empty-state__desc">Khi khách để lại nhận xét trên trang địa điểm, bạn sẽ thấy và trả lời tại đây.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            </div>
        </main>
    </div>
</div>


<div class="modal fade" id="editInfoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?php echo e(route('business.update_info')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content border-0" style="border-radius: 8px; overflow: hidden; border: 1px solid var(--border-light);">
                <div class="modal-header px-3 py-2" style="background: #fff; border-bottom: 1px solid var(--border-light);">
                    <h5 class="modal-title" style="color: var(--text-heading); font-size: 0.95rem; font-weight: 600;">Sửa mô tả</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="mb-0">
                        <label class="form-label">Mô tả doanh nghiệp</label>
                        <textarea class="form-control" name="description" rows="5" maxlength="1000" placeholder="Giới thiệu ngắn về cửa hàng của bạn..."><?php echo e($businessProfile->description); ?></textarea>
                        <div class="form-text" style="font-size:0.75rem;color:var(--text-muted);">Tối đa 1000 ký tự. Tên, địa chỉ và SĐT hồ sơ không đổi tại đây.</div>
                    </div>
                </div>
                <div class="modal-footer px-3 py-2" style="background: #fff; border-top: 1px solid var(--border-light);">
                    <button type="button" class="btn-minimal" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn-minimal btn-minimal-primary">Lưu mô tả</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?php echo e(route('business.upload_photo')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content border-0" style="border-radius: 8px; overflow: hidden; border: 1px solid var(--border-light);">
                <div class="modal-header px-3 py-2" style="background: #fff; border-bottom: 1px solid var(--border-light);">
                    <h5 class="modal-title" style="color: var(--text-heading); font-size: 0.95rem; font-weight: 600;">Tải ảnh mới lên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <input type="hidden" name="type" value="menu">
                    <div class="mb-0">
                        <label class="form-label">Chọn hình ảnh *</label>
                        <input type="file" class="form-control" name="photo" accept="image/*" required>
                        <div class="form-text" style="font-size:0.75rem;color:var(--text-muted);">Ảnh không gian, món ăn, bảng giá... Tối đa 20 ảnh, mỗi ảnh 20MB. PNG, JPG, JPEG, WEBP.</div>
                    </div>
                </div>
                <div class="modal-footer px-3 py-2" style="background: #fff; border-top: 1px solid var(--border-light);">
                    <button type="button" class="btn-minimal" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn-minimal btn-minimal-primary">Tải lên</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titles = {
        'tab-overview': 'Tổng quan',
        'tab-gallery': 'Hình ảnh',
        'tab-contact': 'Liên hệ',
        'tab-reviews': 'Đánh giá'
    };
    let dashboardMap = null;

    function showTab(tabId) {
        document.querySelectorAll('.tab-pane').forEach(function (pane) {
            pane.classList.toggle('active', pane.id === tabId);
        });
        document.querySelectorAll('.biz-nav-link[data-tab]').forEach(function (link) {
            link.classList.toggle('active', link.getAttribute('data-tab') === tabId);
        });
        if (tabId === 'tab-overview' && dashboardMap) {
            setTimeout(function () { dashboardMap.invalidateSize(); }, 150);
        }
        if (history.replaceState) {
            history.replaceState(null, '', '#' + tabId);
        }
    }

    document.querySelectorAll('.biz-nav-link[data-tab]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            showTab(link.getAttribute('data-tab'));
        });
    });

    // Mở tab từ hash (#tab-pano)
    const initialHash = (window.location.hash || '').replace(/^#/, '');
    if (initialHash && titles[initialHash]) {
        showTab(initialHash);
    } else if (document.querySelector('.content-area .alert ul')) {
        showTab('tab-contact');
    }

    function openReplyForm(card) {
        const form = card.querySelector('.review-reply-form');
        const reply = card.querySelector('.review-reply');
        const actions = card.querySelector('.review-card__actions');
        if (!form) return;

        form.classList.remove('is-hidden');
        if (reply) reply.style.display = 'none';
        if (actions) actions.style.display = 'none';
        const textarea = form.querySelector('textarea');
        if (textarea) textarea.focus();
    }

    function closeReplyForm(card) {
        const form = card.querySelector('.review-reply-form');
        const reply = card.querySelector('.review-reply');
        const actions = card.querySelector('.review-card__actions');
        if (!form) return;

        form.classList.add('is-hidden');
        if (reply) reply.style.display = '';
        if (actions) actions.style.display = '';
    }

    document.querySelectorAll('.review-reply-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openReplyForm(btn.closest('.review-card'));
        });
    });

    document.querySelectorAll('.review-reply-cancel').forEach(function (btn) {
        btn.addEventListener('click', function () {
            closeReplyForm(btn.closest('.review-card'));
        });
    });

    function initDashboardMap() {
        const mapEl = document.getElementById('dashboardMap');
        if (!mapEl || dashboardMap) return;
        const lat = parseFloat("<?php echo e($businessProfile->lat); ?>");
        const lng = parseFloat("<?php echo e($businessProfile->lng); ?>");
        if (isNaN(lat) || isNaN(lng)) return;

        dashboardMap = L.map('dashboardMap', {
            zoomControl: true,
            attributionControl: false
        }).setView([lat, lng], 15);

        L.tileLayer(<?php echo json_encode(config('services.carto.tile_url'), 15, 512) ?>, {
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(dashboardMap);

        fetch('<?php echo e(asset('geo/ha-nam-old.geojson')); ?>')
            .then(function (res) { return res.json(); })
            .then(function (data) {
                L.geoJSON(data, {
                    style: {
                        color: '#cbdbe8',
                        weight: 2,
                        opacity: 0.55,
                        fillColor: '#f8fafc',
                        fillOpacity: 0.04
                    }
                }).addTo(dashboardMap);
            })
            .catch(function () {});

        L.marker([lat, lng]).addTo(dashboardMap).bindPopup(
            '<div style="font-family:inherit;font-size:0.85rem;"><strong style="color:#1e3a5f;"><?php echo e($businessProfile->business_name); ?></strong><br><span style="color:#64748b;"><?php echo e($businessProfile->address_street); ?>, <?php echo e($businessProfile->address_city); ?></span></div>'
        ).openPopup();
    }

    initDashboardMap();

    const hash = (location.hash || '').replace('#', '');
    if (hash && titles[hash]) showTab(hash);
});
</script>
</body>
</html>
<?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/client/business/dashboard.blade.php ENDPATH**/ ?>