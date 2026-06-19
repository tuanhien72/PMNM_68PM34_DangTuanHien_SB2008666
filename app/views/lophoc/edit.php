<?php
$errors = $errors ?? [];
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card app-card">
            <div class="card-body p-4 p-lg-5">
                <div class="mb-4">
                    <p class="text-primary fw-semibold mb-1">QUẢN LÝ LỚP HỌC</p>
                    <h1 class="h3 page-heading mb-1">Cập nhật lớp học</h1>
                    <p class="page-subtitle mb-0">Chỉnh sửa mã lớp, tên lớp và nội dung ghi chú.</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?><div><?php echo $error; ?></div><?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>/lophoc/update/<?php echo $lophoc['id']; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="malop">Mã lớp <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="malop" id="malop" maxlength="20" value="<?php echo htmlspecialchars($lophoc['malop']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="tenlop">Tên lớp <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="tenlop" id="tenlop" maxlength="100" value="<?php echo htmlspecialchars($lophoc['tenlop']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="ghichu">Ghi chú</label>
                        <textarea class="form-control" name="ghichu" id="ghichu" rows="4" maxlength="255"><?php echo htmlspecialchars($lophoc['ghichu'] ?? ''); ?></textarea>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-warning" type="submit"><i class="bi bi-save me-1"></i> Cập nhật</button>
                        <a class="btn btn-outline-secondary" href="<?php echo BASE_URL; ?>/lophoc/index"><i class="bi bi-arrow-left me-1"></i> Quay lại danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
