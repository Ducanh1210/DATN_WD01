<div class="photo-viewer-stage" id="photoViewer">
    <?php if(count($photoSlides) > 0): ?>
        <img
            src="<?php echo e($photoSlides[0]['url']); ?>"
            alt=""
            class="photo-viewer-stage__blur"
            id="photoViewerBlur"
            aria-hidden="true"
        >
        <img
            src="<?php echo e($photoSlides[0]['url']); ?>"
            alt="<?php echo e($photoSlides[0]['caption'] ?? $location->name); ?>"
            class="photo-viewer-stage__img"
            id="photoViewerImage"
        >
        <?php if(count($photoSlides) > 1): ?>
            <button type="button" class="photo-viewer-nav photo-viewer-nav--prev" id="photoViewerPrev" aria-label="Ảnh trước">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button type="button" class="photo-viewer-nav photo-viewer-nav--next" id="photoViewerNext" aria-label="Ảnh sau">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        <?php endif; ?>
    <?php else: ?>
        <div class="photo-viewer-stage__empty">
            <p style="font-size: 1rem; font-weight: 600; color: #fff; margin-bottom: 8px;"><?php echo e($location->name); ?></p>
            <p style="margin: 0;">Địa điểm chưa có ảnh minh họa</p>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/client/partials/location-photo-viewer.blade.php ENDPATH**/ ?>