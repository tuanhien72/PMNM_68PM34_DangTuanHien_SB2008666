<?php
$errors = $errors ?? [];
$old = $old ?? [];
$lophocs = $lophocs ?? [];
?>

<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card app-card">
            <div class="card-body p-4 p-lg-5">
                <div class="mb-4">
                    <p class="text-primary fw-semibold mb-1">QUẢN LÝ SINH VIÊN</p>
                    <h1 class="h3 page-heading mb-1">Thêm mới sinh viên</h1>
                    <p class="page-subtitle mb-0">Nhập đầy đủ thông tin để tạo hồ sơ sinh viên.</p>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?><div><?php echo $error; ?></div><?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>/sinhvien/store" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="hoten">Họ tên <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="hoten" id="hoten" maxlength="100" value="<?php echo htmlspecialchars($old['hoten'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="gioitinh">Giới tính <span class="text-danger">*</span></label>
                        <select class="form-select" name="gioitinh" id="gioitinh" required>
                            <option value="">-- Chọn giới tính --</option>
                            <?php foreach (['Nam', 'Nữ', 'Khác'] as $gioitinh): ?>
                                <option value="<?php echo $gioitinh; ?>" <?php echo ($old['gioitinh'] ?? '') === $gioitinh ? 'selected' : ''; ?>><?php echo $gioitinh; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="mssv">MSSV <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="mssv" id="mssv" maxlength="20" value="<?php echo htmlspecialchars($old['mssv'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="lophoc_id">Lớp học</label>
                        <select class="form-select" name="lophoc_id" id="lophoc_id">
                            <option value="">-- Chưa xếp lớp --</option>
                            <?php foreach ($lophocs as $lophoc): ?>
                                <option value="<?php echo $lophoc['id']; ?>" <?php echo (string)($old['lophoc_id'] ?? '') === (string)$lophoc['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($lophoc['malop'] . ' - ' . $lophoc['tenlop']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-success" type="submit"><i class="bi bi-check-circle me-1"></i> Thêm mới</button>
                        <a class="btn btn-outline-secondary" href="<?php echo BASE_URL; ?>/sinhvien/index"><i class="bi bi-arrow-left me-1"></i> Quay lại danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
