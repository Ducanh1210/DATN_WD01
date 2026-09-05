<?php $__env->startSection('title', 'Chi tiết yêu cầu doanh nghiệp: ' . $businessProfile->business_name); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .biz-show {
        --ink: #1e3a5f;
        --body: #3b5980;
        --muted: #6482a6;
        --line: #cbdbe8;
        --line-soft: #e5e7eb;
        --mist: #f1f5f9;
        --paper: #ffffff;
    }

    .biz-show__top {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
    }

    .biz-show__back {
        color: var(--muted);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.825rem;
    }
    .biz-show__back:hover { color: var(--ink); }

    .biz-show__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .biz-panel {
        background: var(--paper);
        border: 1px solid var(--line-soft);
        border-radius: 10px;
        padding: 22px 24px;
        margin-bottom: 16px;
    }

    .biz-panel__title {
        margin: 0 0 14px;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: -0.01em;
    }

    .biz-name {
        margin: 0 0 6px;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: -0.02em;
        line-height: 1.3;
    }

    .biz-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--line-soft);
    }

    .biz-chip {
        display: inline-flex;
        align-items: center;
        padding: 3px 10px;
        border-radius: 6px;
        background: var(--mist);
        color: var(--ink);
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid var(--line);
    }

    .biz-status {
        margin-left: auto;
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--muted);
        padding: 3px 10px;
        border-radius: 6px;
        background: var(--mist);
        border: 1px solid var(--line);
    }
    .biz-status.is-pending { color: #8a6d3b; background: #faf6ef; border-color: #e8dcc8; }
    .biz-status.is-ok { color: var(--ink); background: var(--mist); }
    .biz-status.is-bad { color: #9b3b3b; background: #faf2f2; border-color: #ead4d4; }

    .biz-fields {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px 20px;
        margin-bottom: 20px;
    }
    @media (max-width: 767px) {
        .biz-fields { grid-template-columns: 1fr; }
    }
    .biz-field--full { grid-column: 1 / -1; }

    .biz-label {
        font-size: 0.72rem;
        font-weight: 500;
        color: var(--muted);
        margin-bottom: 4px;
    }
    .biz-value {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--ink);
        line-height: 1.5;
    }
    .biz-value a {
        color: var(--ink);
        text-decoration: none;
        border-bottom: 1px solid var(--line);
    }
    .biz-value a:hover { border-bottom-color: var(--ink); }
    .biz-value .empty { color: var(--muted); font-weight: 400; }

    .biz-section-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--ink);
        margin: 0 0 10px;
    }

    #adminBizMap {
        height: 280px;
        width: 100%;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: var(--mist);
    }

    .biz-coords {
        font-size: 0.75rem;
        color: var(--muted);
        margin-bottom: 8px;
        font-weight: 400;
    }

    .biz-maps-links {
        display: flex;
        flex-wrap: wrap;
        gap: 4px 10px;
        font-size: 0.75rem;
    }
    .biz-maps-links a {
        color: var(--ink);
        text-decoration: none;
        font-weight: 500;
        border-bottom: 1px solid var(--line);
    }
    .biz-maps-links a:hover {
        border-bottom-color: var(--ink);
    }

    .biz-sapo {
        background: #fafafa;
        border-left: 2.5px solid var(--ink);
        padding: 12px 14px;
        color: var(--body);
        font-size: 0.875rem;
        line-height: 1.7;
        white-space: pre-line;
        border-radius: 0 6px 6px 0;
    }

    .biz-note {
        background: var(--mist);
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 12px 14px;
        font-size: 0.8rem;
        color: var(--body);
        line-height: 1.55;
        margin-bottom: 0;
    }
    .biz-note.is-warn {
        background: #faf6ef;
        border-color: #e8dcc8;
        color: #6b5428;
    }
    .biz-note.is-bad {
        background: #faf2f2;
        border-color: #ead4d4;
        color: #7a3535;
    }

    .biz-verify-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 16px;
    }
    @media (max-width: 991px) {
        .biz-verify-grid { grid-template-columns: 1fr; }
    }

    .biz-factbox {
        background: var(--mist);
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 14px;
        font-size: 0.8rem;
        color: var(--body);
        line-height: 1.6;
    }
    .biz-factbox dt {
        font-weight: 500;
        color: var(--muted);
        font-size: 0.72rem;
        margin-top: 10px;
    }
    .biz-factbox dt:first-child { margin-top: 0; }
    .biz-factbox dd {
        margin: 2px 0 0;
        color: var(--ink);
        font-weight: 500;
    }

    .biz-dist {
        display: inline-block;
        margin-top: 2px;
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--ink);
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 6px;
        padding: 2px 8px;
    }
    .biz-dist.is-far { color: #9b3b3b; border-color: #ead4d4; background: #faf2f2; }
    .biz-dist.is-mid { color: #8a6d3b; border-color: #e8dcc8; background: #faf6ef; }

    .photo-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(112px, 1fr));
        gap: 8px;
    }
    .photo-gallery-item {
        aspect-ratio: 4/3;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid var(--line-soft);
        background: var(--mist);
        display: block;
    }
    .photo-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .biz-empty {
        padding: 14px;
        text-align: center;
        color: var(--muted);
        font-size: 0.8rem;
        background: var(--mist);
        border: 1px dashed var(--line);
        border-radius: 8px;
    }

    .biz-side-user {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-bottom: 14px;
    }
    .biz-side-user__name {
        font-weight: 600;
        color: var(--ink);
        font-size: 0.875rem;
    }
    .biz-side-user__email {
        color: var(--muted);
        font-size: 0.75rem;
    }

    .biz-kv {
        border-top: 1px solid var(--line-soft);
        padding-top: 12px;
        display: grid;
        gap: 8px;
        font-size: 0.78rem;
    }
    .biz-kv div {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }
    .biz-kv span { color: var(--muted); }
    .biz-kv strong { color: var(--ink); font-weight: 500; text-align: right; }

    .biz-modal .modal-content {
        border: 1px solid var(--line-soft);
        border-radius: 10px;
    }
    .biz-modal .modal-header {
        border-bottom: 1px solid var(--line-soft);
        background: var(--mist);
    }
    .biz-modal .modal-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--ink);
    }
    .biz-modal textarea.form-control {
        border: none;
        border-bottom: 1px solid var(--line);
        border-radius: 0;
        background: transparent;
        box-shadow: none;
    }
    .biz-modal textarea.form-control:focus {
        border-bottom: 2px solid var(--ink);
        box-shadow: none;
        background: transparent;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $verificationDistMeters = null;
    if ($businessProfile->verification_lat && $businessProfile->verification_lng && $businessProfile->lat && $businessProfile->lng) {
        $earthRadius = 6371000;
        $dLat = deg2rad($businessProfile->verification_lat - $businessProfile->lat);
        $dLng = deg2rad($businessProfile->verification_lng - $businessProfile->lng);
        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($businessProfile->lat)) * cos(deg2rad($businessProfile->verification_lat)) *
             sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $verificationDistMeters = round($earthRadius * $c);
    }

    $vPhotos = !empty($businessProfile->verification_photos)
        ? (array) $businessProfile->verification_photos
        : (!empty($businessProfile->verification_photo) ? [$businessProfile->verification_photo] : []);

    $statusClass = match ($businessProfile->status) {
        'pending' => 'is-pending',
        'approved' => 'is-ok',
        default => 'is-bad',
    };
    $statusLabel = match ($businessProfile->status) {
        'pending' => 'Chờ xét duyệt',
        'approved' => 'Đã kích hoạt',
        default => 'Bị từ chối',
    };
?>

<div class="biz-show">
    <div class="biz-show__top">
        <a href="<?php echo e(route('admin.business-profiles.index')); ?>" class="biz-show__back">← Quay lại danh sách</a>

        <div class="biz-show__actions">
            <?php if($businessProfile->status === 'pending'): ?>
                <button type="button" class="btn-minimal text-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                    Từ chối
                </button>
                <form action="<?php echo e(route('admin.business-profiles.approve', $businessProfile->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-minimal btn-minimal-primary px-3" onclick="return confirm('Phê duyệt doanh nghiệp này?')">
                        Phê duyệt
                    </button>
                </form>
            <?php elseif($businessProfile->status === 'approved'): ?>
            <?php elseif($businessProfile->status === 'rejected'): ?>
                <button type="button" class="btn-minimal btn-minimal-primary px-3" data-bs-toggle="modal" data-bs-target="#reApproveModal">
                    Phê duyệt lại
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <section class="biz-panel">
                <div class="biz-meta-row">
                    <div style="min-width:0;flex:1;">
                        <h1 class="biz-name"><?php echo e($businessProfile->business_name); ?></h1>
                        <div class="d-flex flex-wrap gap-1 mt-1">
                            <span class="biz-chip"><?php echo e($businessProfile->category->name ?? 'Chưa phân loại'); ?></span>
                            <?php $__currentLoopData = (array) ($businessProfile->business_types ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="biz-chip"><?php echo e($type); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($businessProfile->location_id): ?>
                                <span class="biz-chip" style="background:#eef2ff;color:#4338ca;">Nhận địa điểm có sẵn</span>
                            <?php endif; ?>
                        </div>
                        <?php if($businessProfile->claimedLocation): ?>
                            <div class="mt-2" style="font-size:0.82rem;color:#475569;">
                                POI: <strong><?php echo e($businessProfile->claimedLocation->name); ?></strong>
                                <a href="<?php echo e(route('admin.locations.edit', $businessProfile->claimedLocation->id)); ?>" class="ms-1">Xem / sửa địa điểm</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <span class="biz-status <?php echo e($statusClass); ?>"><?php echo e($statusLabel); ?></span>
                </div>

                <div class="biz-fields">
                    <div>
                        <div class="biz-label">Số điện thoại</div>
                        <div class="biz-value"><?php echo e($businessProfile->phone ?: '—'); ?></div>
                    </div>
                    <div>
                        <div class="biz-label">Website</div>
                        <div class="biz-value">
                            <?php if($businessProfile->website): ?>
                                <a href="<?php echo e($businessProfile->website); ?>" target="_blank" rel="noopener"><?php echo e($businessProfile->website); ?></a>
                            <?php else: ?>
                                <span class="empty">Chưa cập nhật</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="biz-field--full">
                        <div class="biz-label">Địa chỉ</div>
                        <div class="biz-value">
                            <?php echo e($businessProfile->address_street); ?>, <?php echo e($businessProfile->address_city); ?>, <?php echo e($businessProfile->address_province); ?>

                            <?php if($businessProfile->address_postal_code): ?>
                                <span class="empty">· <?php echo e($businessProfile->address_postal_code); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php
                    $mapsAddress = trim(implode(', ', array_filter([
                        $businessProfile->address_street,
                        $businessProfile->address_city,
                        $businessProfile->address_province,
                    ])));
                ?>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                        <div class="biz-section-label mb-0">Vị trí</div>
                        <div class="biz-maps-links">
                            <?php if($mapsAddress !== ''): ?>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode($mapsAddress)); ?>" target="_blank" rel="noopener">Địa chỉ</a>
                            <?php endif; ?>
                            <?php if($businessProfile->lat && $businessProfile->lng): ?>
                                <a href="https://www.google.com/maps?q=<?php echo e($businessProfile->lat); ?>,<?php echo e($businessProfile->lng); ?>" target="_blank" rel="noopener">Ghim</a>
                            <?php endif; ?>
                            <?php if($businessProfile->verification_lat && $businessProfile->verification_lng): ?>
                                <a href="https://www.google.com/maps?q=<?php echo e($businessProfile->verification_lat); ?>,<?php echo e($businessProfile->verification_lng); ?>" target="_blank" rel="noopener">GPS chụp</a>
                            <?php endif; ?>
                            <?php if($businessProfile->verification_lat && $businessProfile->lat): ?>
                                <a href="https://www.google.com/maps/dir/<?php echo e($businessProfile->verification_lat); ?>,<?php echo e($businessProfile->verification_lng); ?>/<?php echo e($businessProfile->lat); ?>,<?php echo e($businessProfile->lng); ?>" target="_blank" rel="noopener">So sánh</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="biz-coords"><?php echo e(number_format((float) $businessProfile->lat, 6)); ?>, <?php echo e(number_format((float) $businessProfile->lng, 6)); ?></div>
                    <div id="adminBizMap"></div>
                </div>

                <div>
                    <div class="biz-section-label">Giới thiệu</div>
                    <div class="biz-sapo"><?php echo e($businessProfile->description ?: 'Chưa có mô tả giới thiệu.'); ?></div>
                </div>
            </section>

            <section class="biz-panel">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <h2 class="biz-panel__title mb-0">Xác thực thực địa</h2>
                    <span class="biz-chip"><?php echo e(count($vPhotos) > 0 ? count($vPhotos) . ' ảnh' : 'Chưa có ảnh'); ?></span>
                </div>

                <?php if(count($vPhotos) > 0): ?>
                    <div class="biz-verify-grid">
                        <div>
                            <div class="biz-label mb-2">Ảnh chụp tại chỗ</div>
                            <div class="photo-gallery-grid">
                                <?php $__currentLoopData = $vPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(asset('storage/' . $photo)); ?>" target="_blank" class="photo-gallery-item">
                                        <img src="<?php echo e(asset('storage/' . $photo)); ?>" alt="Ảnh xác thực">
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <dl class="biz-factbox mb-0">
                            <dt>GPS khi chụp</dt>
                            <dd>
                                <?php if($businessProfile->verification_lat): ?>
                                    <?php echo e(number_format($businessProfile->verification_lat, 6)); ?>, <?php echo e(number_format($businessProfile->verification_lng, 6)); ?>

                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </dd>
                            <dt>Ghim trên bản đồ</dt>
                            <dd><?php echo e(number_format((float) $businessProfile->lat, 6)); ?>, <?php echo e(number_format((float) $businessProfile->lng, 6)); ?></dd>
                            <?php if($verificationDistMeters !== null): ?>
                                <dt>Khoảng cách lệch</dt>
                                <dd>
                                    <?php if($verificationDistMeters <= 100): ?>
                                        <span class="biz-dist">Trùng khớp · ~<?php echo e($verificationDistMeters); ?>m</span>
                                    <?php elseif($verificationDistMeters <= 500): ?>
                                        <span class="biz-dist is-mid">Lệch ~<?php echo e($verificationDistMeters); ?>m</span>
                                    <?php else: ?>
                                        <span class="biz-dist is-far">Cách xa <?php echo e(number_format($verificationDistMeters / 1000, 1)); ?> km</span>
                                    <?php endif; ?>
                                </dd>
                            <?php endif; ?>
                            <dt>Thời điểm chụp</dt>
                            <dd>
                                <?php echo e($businessProfile->verification_time ? \Carbon\Carbon::parse($businessProfile->verification_time)->format('d/m/Y H:i') : '—'); ?>

                            </dd>
                        </dl>
                    </div>
                <?php else: ?>
                    <div class="biz-empty">Người đăng ký chưa gửi ảnh chụp thực địa.</div>
                <?php endif; ?>
            </section>

            <section class="biz-panel">
                <h2 class="biz-panel__title">Hình ảnh doanh nghiệp <span class="text-muted" style="font-size:.8rem;font-weight:400;">(công khai)</span></h2>

                <div class="mb-4">
                    <div class="biz-label mb-2">Ảnh đại diện</div>
                    <?php if(!empty($businessProfile->avatar_photo)): ?>
                        <div class="photo-gallery-grid">
                            <a href="<?php echo e(asset('storage/' . $businessProfile->avatar_photo)); ?>" target="_blank" class="photo-gallery-item">
                                <img src="<?php echo e(asset('storage/' . $businessProfile->avatar_photo)); ?>" alt="Ảnh đại diện">
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="biz-empty">Chưa chọn ảnh đại diện.</div>
                    <?php endif; ?>
                </div>

                <?php
                    $galleryPhotos = array_values(array_filter(array_unique(array_merge(
                        $businessProfile->storefront_photos ?? [],
                        $businessProfile->menu_photos ?? []
                    ))));
                ?>
                <div>
                    <div class="biz-label mb-2">Ảnh gallery địa điểm (<?php echo e(count($galleryPhotos)); ?>)</div>
                    <?php if(!empty($galleryPhotos)): ?>
                        <div class="photo-gallery-grid">
                            <?php $__currentLoopData = $galleryPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(asset('storage/' . $photo)); ?>" target="_blank" class="photo-gallery-item">
                                    <img src="<?php echo e(asset('storage/' . $photo)); ?>" alt="Ảnh địa điểm">
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="biz-empty">Không có ảnh gallery.</div>
                    <?php endif; ?>
                </div>
            </section>

            <section class="biz-panel">
                <h2 class="biz-panel__title">Giấy tờ chứng minh chủ sở hữu <span class="text-muted" style="font-size:.8rem;font-weight:400;">(riêng tư · chỉ admin)</span></h2>
                <?php if(!empty($businessProfile->business_documents)): ?>
                    <div class="photo-gallery-grid">
                        <?php $__currentLoopData = $businessProfile->business_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(asset('storage/' . $doc)); ?>" target="_blank" class="photo-gallery-item">
                                <img src="<?php echo e(asset('storage/' . $doc)); ?>" alt="Giấy tờ chứng minh">
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="biz-empty">Người đăng ký không gửi giấy tờ chứng minh (tùy chọn).</div>
                <?php endif; ?>
            </section>
        </div>

        <div class="col-lg-4">
            <aside class="biz-panel">
                <h2 class="biz-panel__title">Người đăng ký</h2>
                <div class="biz-side-user">
                    <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => $businessProfile->user,'size' => '44']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($businessProfile->user),'size' => '44']); ?>
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
                        <div class="biz-side-user__name"><?php echo e($businessProfile->user->display_name ?? $businessProfile->user->username); ?></div>
                        <div class="biz-side-user__email"><?php echo e($businessProfile->user->email); ?></div>
                    </div>
                </div>
                <div class="biz-kv">
                    <div>
                        <span>Tài khoản</span>
                        <strong><?php echo e($businessProfile->user->username); ?></strong>
                    </div>
                    <div>
                        <span>Vai trò</span>
                        <strong><?php echo e($businessProfile->user->role); ?></strong>
                    </div>
                    <div>
                        <span>Ngày tạo TK</span>
                        <strong><?php echo e($businessProfile->user->created_at?->format('d/m/Y') ?? '—'); ?></strong>
                    </div>
                    <div>
                        <span>Ngày gửi yêu cầu</span>
                        <strong><?php echo e($businessProfile->created_at->format('d/m/Y H:i')); ?></strong>
                    </div>
                </div>
            </aside>

            <aside class="biz-panel">
                <h2 class="biz-panel__title">Trạng thái xử lý</h2>

                <?php if($businessProfile->status === 'pending'): ?>
                    <p class="biz-note is-warn mb-0">
                        Đang chờ duyệt. Kiểm tra địa chỉ, GPS xác thực và ảnh trước khi phê duyệt.
                    </p>
                <?php elseif($businessProfile->status === 'approved'): ?>
                    <p class="biz-note mb-0">
                        Đã phê duyệt. Địa điểm đã lên bản đồ.
                    </p>
                <?php elseif($businessProfile->status === 'rejected'): ?>
                    <p class="biz-note is-bad mb-0">
                        <strong style="font-weight:600;">Đã từ chối.</strong><br>
                        <?php echo e($businessProfile->reject_reason); ?>

                    </p>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</div>


<div class="modal fade biz-modal" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?php echo e(route('admin.business-profiles.reject', $businessProfile->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Từ chối yêu cầu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="small mb-3" style="color:#6482a6;">Nhập lý do để người dùng biết cần chỉnh gì.</p>
                    <label class="biz-label">Lý do từ chối *</label>
                    <textarea name="reject_reason" class="form-control" rows="4" required placeholder="Ví dụ: Ảnh mặt tiền không rõ, tọa độ lệch địa chỉ..."></textarea>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-minimal" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn-minimal text-danger px-3">Xác nhận từ chối</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade biz-modal" id="reApproveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?php echo e(route('admin.business-profiles.approve', $businessProfile->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Phê duyệt lại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" style="color:#3b5980;font-size:0.875rem;line-height:1.6;">
                        Phê duyệt lại yêu cầu này? Địa điểm sẽ được đưa lên hệ thống.
                    </p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn-minimal" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn-minimal btn-minimal-primary px-3">Xác nhận phê duyệt</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lat = parseFloat(<?php echo json_encode($businessProfile->lat, 15, 512) ?>);
        const lng = parseFloat(<?php echo json_encode($businessProfile->lng, 15, 512) ?>);

        if (isNaN(lat) || isNaN(lng)) return;

        const map = L.map('adminBizMap', {
            zoomControl: true,
            attributionControl: false
        }).setView([lat, lng], 15);

        L.tileLayer(<?php echo json_encode(config('services.carto.tile_url'), 15, 512) ?>, {
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);

        fetch(<?php echo json_encode(asset('geo/ninh-binh.geojson'), 15, 512) ?>)
            .then(res => res.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: '#7ba7d4',
                        weight: 2,
                        opacity: 0.55,
                        fillColor: '#f8fafc',
                        fillOpacity: 0.04
                    }
                }).addTo(map);
            })
            .catch(() => {});

        L.marker([lat, lng]).addTo(map).bindPopup(
            '<div style="font-size:0.85rem;line-height:1.45;">' +
            '<strong style="color:#1e3a5f;">' + <?php echo json_encode($businessProfile->business_name, 15, 512) ?> + '</strong><br>' +
            '<span style="color:#6482a6;">' + <?php echo json_encode(trim($businessProfile->address_street . ', ' . $businessProfile->address_city), 512) ?> + '</span>' +
            '</div>'
        ).openPopup();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/business/show.blade.php ENDPATH**/ ?>