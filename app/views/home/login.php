<div class="row justify-content-center align-items-center py-lg-5">
    <div class="col-12 col-md-8 col-lg-5">
        <div class="app-card card border-0">
            <div class="card-body p-4 p-lg-5">
                <div class="text-center mb-4">
                    <div class="stat-icon text-primary bg-primary-subtle mx-auto mb-3">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h1 class="h3 page-heading mb-2">Đăng nhập hệ thống</h1>
                    <p class="page-subtitle mb-0">Sử dụng tài khoản được cấp để tiếp tục</p>
                </div>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger border-0">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        Sai tên đăng nhập hoặc mật khẩu.
                    </div>
                <?php } ?>

                <form action="<?php echo BASE_URL; ?>/auth/login" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="username">Tên đăng nhập</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="password">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                            <input class="form-control" type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
