<?php if (isset($_SESSION['username'])): ?>
<nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="<?php echo BASE_URL; ?>/home/index">
            <span class="app-brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            <span>QLSV</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <div class="navbar-nav me-auto ms-lg-3 gap-lg-1">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>/sinhvien/index">
                    <i class="bi bi-people me-1"></i> Quản lý sinh viên
                </a>
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>/lophoc/index">
                    <i class="bi bi-journal-bookmark me-1"></i> Quản lý lớp học
                </a>
            </div>

            <div class="navbar-nav align-items-lg-center gap-lg-2">
                <span class="navbar-text text-white-50">
                    <i class="bi bi-person-circle me-1"></i>
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <a class="btn btn-sm btn-outline-light mt-2 mt-lg-0" href="<?php echo BASE_URL; ?>/auth/logout">
                    <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
                </a>
            </div>
        </div>
    </div>
</nav>
<?php endif; ?>