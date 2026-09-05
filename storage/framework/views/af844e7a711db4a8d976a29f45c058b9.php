<?php $__env->startSection('title', $suggestion->name); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #suggestionMap {
        height: 320px;
        width: 100%;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    .suggestion-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.75rem 1.25rem;
        font-size: 0.825rem;
    }
    @media (max-width: 575.98px) {
        .suggestion-meta-grid { grid-template-columns: 1fr; }
    }
    .suggestion-meta-item .label {
        display: block;
        color: #64748b;
        font-size: 0.72rem;
        margin-bottom: 0.15rem;
    }
    .suggestion-photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 0.65rem;
    }
    .suggestion-photo-grid a {
        display: block;
        aspect-ratio: 4/3;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    .suggestion-photo-grid img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }
    .suggestion-photo-grid a:hover img { transform: scale(1.04); }
    .nearby-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.55rem 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.8rem;
    }
    .nearby-item:last-child { border-bottom: 0; padding-bottom: 0; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-3">
    <a href="<?php echo e(route('admin.contributions.index', ['tab' => 'suggestions'])); ?>" class="text-muted text-decoration-none" style="font-size:0.78rem;">← Quay lại danh sách</a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card-minimal mb-3">
            <div class="card-header-minimal d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>Thông tin đề xuất</span>
                <?php if($suggestion->status === 'pending'): ?>
                    <span class="badge-minimal-warning">Chưa xem</span>
                <?php elseif($suggestion->status === 'approved'): ?>
                    <span class="badge-minimal-success">Đã ghi nhận</span>
                <?php elseif($suggestion->status === 'rejected'): ?>
                    <span class="badge-minimal-danger">Bỏ qua</span>
                <?php elseif($suggestion->status === 'need_more_info'): ?>
                    <span class="badge-minimal">Cần thêm thông tin</span>
                <?php else: ?>
                    <span class="badge-minimal"><?php echo e($suggestion->status); ?></span>
                <?php endif; ?>
            </div>
            <div class="p-3">
                <div class="suggestion-meta-grid mb-3">
                    <div class="suggestion-meta-item">
                        <span class="label">Người gửi</span>
                        <strong><?php echo e($suggestion->user->display_name ?? $suggestion->user->username); ?></strong>
                        <?php if($suggestion->user->email ?? null): ?>
                            <div class="text-muted" style="font-size:0.75rem;"><?php echo e($suggestion->user->email); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="suggestion-meta-item">
                        <span class="label">Ngày gửi</span>
                        <span><?php echo e($suggestion->created_at->format('d/m/Y H:i')); ?></span>
                    </div>
                    <div class="suggestion-meta-item">
                        <span class="label">Danh mục gợi ý</span>
                        <span><?php echo e($suggestion->category_suggest ?: '—'); ?></span>
                    </div>
                    <div class="suggestion-meta-item">
                        <span class="label">Mã đề xuất</span>
                        <span class="font-monospace">#<?php echo e($suggestion->id); ?></span>
                    </div>
                    <div class="suggestion-meta-item" style="grid-column: 1 / -1;">
                        <span class="label">Địa chỉ</span>
                        <span><?php echo e($suggestion->address ?: '—'); ?></span>
                    </div>
                    <?php if($suggestion->lat && $suggestion->lng): ?>
                    <div class="suggestion-meta-item">
                        <span class="label">Vĩ độ (Lat)</span>
                        <span class="font-monospace"><?php echo e(number_format((float) $suggestion->lat, 7)); ?></span>
                    </div>
                    <div class="suggestion-meta-item">
                        <span class="label">Kinh độ (Lng)</span>
                        <span class="font-monospace"><?php echo e(number_format((float) $suggestion->lng, 7)); ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="mb-0">
                    <span class="text-muted d-block mb-1" style="font-size:0.72rem;">Mô tả</span>
                    <div style="white-space:pre-wrap;color:#334155;font-size:0.825rem;"><?php echo e($suggestion->description ?: 'Không có'); ?></div>
                </div>
            </div>
        </div>

        <?php if($suggestion->lat && $suggestion->lng): ?>
        <div class="card-minimal mb-3">
            <div class="card-header-minimal d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span>Vị trí trên bản đồ</span>
                <div class="d-flex gap-1 flex-wrap">
                    <a href="https://www.google.com/maps?q=<?php echo e($suggestion->lat); ?>,<?php echo e($suggestion->lng); ?>" target="_blank" rel="noopener" class="btn-minimal py-1 px-2" style="font-size:0.72rem;">Google Maps</a>
                    <a href="https://www.openstreetmap.org/?mlat=<?php echo e($suggestion->lat); ?>&mlon=<?php echo e($suggestion->lng); ?>#map=16/<?php echo e($suggestion->lat); ?>/<?php echo e($suggestion->lng); ?>" target="_blank" rel="noopener" class="btn-minimal py-1 px-2" style="font-size:0.72rem;">OpenStreetMap</a>
                </div>
            </div>
            <div class="p-3 pt-2">
                <div id="suggestionMap"></div>
            </div>
        </div>
        <?php else: ?>
        <div class="card-minimal mb-3">
            <div class="card-header-minimal">Vị trí trên bản đồ</div>
            <div class="p-3 text-muted" style="font-size:0.825rem;">Người gửi chưa cung cấp tọa độ.</div>
        </div>
        <?php endif; ?>

        <?php if($suggestion->images && count($suggestion->images)): ?>
        <div class="card-minimal">
            <div class="card-header-minimal">Ảnh kèm theo (<?php echo e(count($suggestion->images)); ?>)</div>
            <div class="p-3">
                <div class="suggestion-photo-grid">
                    <?php $__currentLoopData = $suggestion->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(asset($img)); ?>" target="_blank" rel="noopener">
                            <img src="<?php echo e(asset($img)); ?>" alt="Ảnh đề xuất">
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-5">
        <div class="card-minimal mb-3">
            <div class="card-header-minimal">Ghi nhận nội bộ</div>
            <div class="p-3">
                <form action="<?php echo e(route('admin.contributions.suggestions.update', $suggestion->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="pending" <?php if($suggestion->status === 'pending'): echo 'selected'; endif; ?>>Chưa xem</option>
                            <option value="approved" <?php if($suggestion->status === 'approved'): echo 'selected'; endif; ?>>Đã ghi nhận</option>
                            <option value="need_more_info" <?php if($suggestion->status === 'need_more_info'): echo 'selected'; endif; ?>>Cần thêm thông tin</option>
                            <option value="rejected" <?php if($suggestion->status === 'rejected'): echo 'selected'; endif; ?>>Bỏ qua</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú admin</label>
                        <textarea name="admin_note" rows="4" class="form-control" placeholder="Ghi chú nội bộ…"><?php echo e(old('admin_note', $suggestion->admin_note)); ?></textarea>
                    </div>
                    <button type="submit" class="btn-minimal btn-minimal-primary">Lưu</button>
                </form>
                <?php if($suggestion->processed_at): ?>
                    <div class="text-muted mt-3" style="font-size:0.72rem;">
                        Cập nhật lần cuối: <?php echo e($suggestion->processed_at->format('d/m/Y H:i')); ?>

                        <?php if($suggestion->processor): ?>
                            · <?php echo e($suggestion->processor->display_name ?? $suggestion->processor->username); ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($suggestion->lat && $suggestion->lng): ?>
        <div class="card-minimal">
            <div class="card-header-minimal">Địa điểm có sẵn gần đó (≤ 3 km)</div>
            <div class="p-3">
                <?php $__empty_1 = true; $__currentLoopData = $nearbyLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="nearby-item">
                        <div>
                            <a href="<?php echo e(route('admin.locations.edit', $loc->id)); ?>" class="fw-medium text-decoration-none" style="color:#1e3a5f;font-size:0.825rem;"><?php echo e($loc->name); ?></a>
                            <?php if($loc->address): ?>
                                <div class="text-muted" style="font-size:0.72rem;"><?php echo e(\Illuminate\Support\Str::limit($loc->address, 60)); ?></div>
                            <?php endif; ?>
                        </div>
                        <span class="text-muted flex-shrink-0" style="font-size:0.72rem;">
                            <?php if($loc->distance_km < 1): ?>
                                ~<?php echo e(round($loc->distance_km * 1000)); ?> m
                            <?php else: ?>
                                ~<?php echo e(number_format($loc->distance_km, 1)); ?> km
                            <?php endif; ?>
                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-muted" style="font-size:0.825rem;">Không có địa điểm nào trong bán kính 3 km.</div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php if($suggestion->lat && $suggestion->lng): ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lat = <?php echo json_encode((float) $suggestion->lat, 15, 512) ?>;
    const lng = <?php echo json_encode((float) $suggestion->lng, 15, 512) ?>;
    const nearby = <?php echo json_encode($nearbyMapData, 15, 512) ?>;
    const suggestionName = <?php echo json_encode($suggestion->name, 15, 512) ?>;
    const suggestionAddress = <?php echo json_encode($suggestion->address ? \Illuminate\Support\Str::limit($suggestion->address, 80) : 'Không có địa chỉ', 512) ?>;
    const geoJsonUrl = <?php echo json_encode(asset('geo/ha-nam-old.geojson'), 15, 512) ?>;

    if (Number.isNaN(lat) || Number.isNaN(lng)) return;

    const map = L.map('suggestionMap', {
        zoomControl: true,
        attributionControl: false,
    }).setView([lat, lng], 15);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd',
        maxZoom: 19,
    }).addTo(map);

    fetch(geoJsonUrl)
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                style: {
                    color: '#7ba7d4',
                    weight: 2,
                    opacity: 0.55,
                    fillColor: '#f8fafc',
                    fillOpacity: 0.04,
                },
            }).addTo(map);
        })
        .catch(() => {});

    const suggestionIcon = L.divIcon({
        className: '',
        html: '<div style="width:18px;height:18px;background:#1e3a5f;border:3px solid #fff;border-radius:50%;box-shadow:0 2px 8px rgba(15,36,66,.35);"></div>',
        iconSize: [18, 18],
        iconAnchor: [9, 9],
    });

    L.marker([lat, lng], { icon: suggestionIcon })
        .addTo(map)
        .bindPopup(`
            <div style="font-family:inherit;font-size:0.85rem;min-width:160px;">
                <strong style="color:#1e3a5f;">${suggestionName}</strong><br>
                <span style="color:#64748b;">${suggestionAddress}</span>
            </div>
        `)
        .openPopup();

    nearby.forEach(function (loc) {
        L.circleMarker([loc.lat, loc.lng], {
            radius: 6,
            color: '#94a3b8',
            weight: 2,
            fillColor: '#e2e8f0',
            fillOpacity: 0.9,
        })
            .addTo(map)
            .bindPopup(`
                <div style="font-family:inherit;font-size:0.8rem;">
                    <strong>${loc.name}</strong><br>
                    <span style="color:#64748b;">~${loc.distance_km < 1 ? Math.round(loc.distance_km * 1000) + ' m' : loc.distance_km + ' km'}</span>
                </div>
            `);
    });

    if (nearby.length) {
        const bounds = L.latLngBounds([[lat, lng]]);
        nearby.forEach(loc => bounds.extend([loc.lat, loc.lng]));
        map.fitBounds(bounds, { padding: [36, 36], maxZoom: 15 });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/contributions/show_suggestion.blade.php ENDPATH**/ ?>