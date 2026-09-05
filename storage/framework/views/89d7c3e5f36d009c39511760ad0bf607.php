<?php $__env->startSection('title', 'Thêm Địa điểm mới'); ?>

<?php $__env->startSection('content'); ?>
<div class="card-minimal p-4">
    <form action="<?php echo e(route('admin.locations.store', request()->query())); ?>" method="POST" enctype="multipart/form-data" novalidate>
        <?php echo csrf_field(); ?>
        
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="name" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Tên địa điểm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" style="border-color: #e2e8f0;">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-3">
                    <label for="short_description" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Mô tả ngắn</label>
                    <textarea class="form-control form-control-sm" id="short_description" name="short_description" rows="3" style="border-color: #e2e8f0;"><?php echo e(old('short_description')); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Địa chỉ</label>
                    <input type="text" class="form-control form-control-sm" id="address" name="address" value="<?php echo e(old('address')); ?>" style="border-color: #e2e8f0;">
                </div>
            </div>
            
            <div class="col-md-4 border-start" style="border-color: var(--border-light) !important;">
                <div class="mb-3">
                    <label for="category_id" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Danh mục <span class="text-danger">*</span></label>
                    <select class="form-select form-select-sm <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="category_id" name="category_id" style="border-color: #e2e8f0;">
                        <option value="">-- Chọn danh mục --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="lat" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Vĩ độ (Lat) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="lat" name="lat" value="<?php echo e(old('lat')); ?>" style="border-color: #e2e8f0;">
                        <?php $__errorArgs = ['lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-6">
                        <label for="lng" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Kinh độ (Lng) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['lng'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="lng" name="lng" value="<?php echo e(old('lng')); ?>" style="border-color: #e2e8f0;">
                        <?php $__errorArgs = ['lng'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Trạng thái</label>
                    <select class="form-select form-select-sm" id="status" name="status" style="border-color: #e2e8f0;">
                        <option value="published" <?php echo e(old('status') == 'published' ? 'selected' : ''); ?>>Công khai</option>
                        <option value="draft" <?php echo e(old('status') == 'draft' ? 'selected' : ''); ?>>Bản nháp</option>
                        <option value="hidden" <?php echo e(old('status') == 'hidden' ? 'selected' : ''); ?>>Ẩn</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Ảnh đại diện (Thumbnail)</label>
                    <input type="file" class="form-control form-control-sm <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="thumbnail" name="thumbnail" accept="image/*" style="border-color: #e2e8f0;">
                    <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top" style="border-color: var(--border-light) !important;">
            <a href="<?php echo e(route('admin.locations.index', request()->query())); ?>" class="btn-minimal text-decoration-none">Hủy bỏ</a>
            <button type="submit" class="btn-minimal btn-minimal-primary">Lưu và Tiếp tục thêm Ảnh</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Tự động tách tọa độ khi dán định dạng "lat, lng" vào ô Lat
    document.getElementById('lat').addEventListener('input', function() {
        let val = this.value;
        if (val.includes(',')) {
            let parts = val.split(',');
            if (parts.length >= 2) {
                this.value = parts[0].trim();
                document.getElementById('lng').value = parts[1].trim();
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/locations/create.blade.php ENDPATH**/ ?>