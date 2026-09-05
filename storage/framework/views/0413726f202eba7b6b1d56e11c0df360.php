<?php $__env->startSection('title', 'Thêm Danh Mục Mới'); ?>

<?php $__env->startSection('content'); ?>
<div class="card-minimal mx-auto p-4" style="max-width: 720px;">
    <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" enctype="multipart/form-data" novalidate>
        <?php echo csrf_field(); ?>
        
        <div class="mb-3">
            <label for="name" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Tên danh mục <span class="text-danger">*</span></label>
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
            <label for="description" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Mô tả</label>
            <textarea class="form-control form-control-sm" id="description" name="description" rows="3" style="border-color: #e2e8f0;"><?php echo e(old('description')); ?></textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-9">
                <label for="icon" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Ảnh Icon (Map Marker)</label>
                <input type="file" class="form-control form-control-sm <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="icon" name="icon" accept="image/*" style="border-color: #e2e8f0;">
                <div class="text-muted mt-1" style="font-size: 0.725rem;">Nên dùng ảnh PNG có nền trong suốt, kích thước khoảng 64x64px.</div>
                <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-3">
                <label for="icon_color" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Màu ghim bản đồ</label>
                <input type="color" class="form-control form-control-color w-100 <?php $__errorArgs = ['icon_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="icon_color" name="icon_color" value="<?php echo e(old('icon_color', '#ef4444')); ?>" title="Chọn màu cho ghim" style="border-color: #e2e8f0; height: 31px;">
                <?php $__errorArgs = ['icon_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="display_order" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Thứ tự hiển thị</label>
                <input type="number" min="0" class="form-control form-control-sm <?php $__errorArgs = ['display_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="display_order" name="display_order" value="<?php echo e(old('display_order')); ?>" style="border-color: #e2e8f0;">
                <div class="text-muted mt-1" style="font-size: 0.725rem;">Để trống để tự động xếp cuối (không nhập số âm)</div>
                <?php $__errorArgs = ['display_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback" style="font-size: 0.75rem;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label text-dark fw-medium" style="font-size: 0.825rem;">Trạng thái</label>
                <select class="form-select form-select-sm" id="status" name="status" style="border-color: #e2e8f0;">
                    <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Hiển thị</option>
                    <option value="hidden" <?php echo e(old('status') == 'hidden' ? 'selected' : ''); ?>>Ẩn</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top" style="border-color: var(--border-light) !important;">
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn-minimal text-decoration-none">Hủy bỏ</a>
            <button type="submit" class="btn-minimal btn-minimal-primary">Lưu Danh Mục</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\DuAn_TN-main\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>