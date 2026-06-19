<section class="mb-4">
    <p class="text-primary fw-semibold mb-2">TỔNG QUAN HỆ THỐNG</p>
    <h1 class="display-6 page-heading mb-2">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p class="page-subtitle mb-0">Quản lý thông tin sinh viên và lớp học từ một nơi.</p>
</section>

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between gap-3 mb-4">
                    <div>
                        <h2 class="h4 page-heading">Quản lý sinh viên</h2>
                        <p class="page-subtitle mb-0">Thêm, cập nhật, tìm kiếm và xếp lớp sinh viên.</p>
                    </div>
                    <span class="stat-icon text-primary bg-primary-subtle"><i class="bi bi-people-fill"></i></span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-primary" href="<?php echo BASE_URL; ?>/sinhvien/index">
                        <i class="bi bi-list-ul me-1"></i> Danh sách sinh viên
                    </a>
                    <a class="btn btn-outline-primary" href="<?php echo BASE_URL; ?>/sinhvien/create">
                        <i class="bi bi-person-plus me-1"></i> Thêm sinh viên
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card stat-card h-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between gap-3 mb-4">
                    <div>
                        <h2 class="h4 page-heading">Quản lý lớp học</h2>
                        <p class="page-subtitle mb-0">Quản lý lớp, ghi chú và số lượng sinh viên.</p>
                    </div>
                    <span class="stat-icon text-success bg-success-subtle"><i class="bi bi-journal-bookmark-fill"></i></span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/lophoc/index">
                        <i class="bi bi-list-ul me-1"></i> Danh sách lớp học
                    </a>
                    <a class="btn btn-outline-success" href="<?php echo BASE_URL; ?>/lophoc/create">
                        <i class="bi bi-plus-circle me-1"></i> Thêm lớp học
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
