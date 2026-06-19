<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Quản lý sinh viên'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --app-primary: #3157a4;
            --app-primary-dark: #24427f;
            --app-bg: #f4f7fb;
            --app-border: #e5eaf1;
            --app-muted: #6c7890;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #273248;
            background: var(--app-bg);
        }

        main {
            flex: 1;
        }

        .app-navbar {
            background: linear-gradient(135deg, var(--app-primary-dark), var(--app-primary));
        }

        .app-brand-mark {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: var(--app-primary);
            background: white;
        }

        .app-navbar .nav-link {
            border-radius: 8px;
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .app-navbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .page-heading {
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .page-subtitle {
            color: var(--app-muted);
        }

        .app-card {
            border: 1px solid var(--app-border);
            border-radius: 14px;
            box-shadow: 0 8px 28px rgba(39, 50, 72, 0.06);
        }

        .filter-card {
            background: white;
        }

        .table {
            --bs-table-hover-bg: #f4f7fc;
        }

        .table thead th {
            white-space: nowrap;
            color: #45516a;
            background: #eef3fb;
            border-bottom-width: 1px;
        }

        .table td,
        .table th {
            padding: 0.85rem;
            border-color: var(--app-border);
        }

        .btn {
            border-radius: 8px;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border-color: #dce3ed;
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #8da7d9;
            box-shadow: 0 0 0 0.2rem rgba(49, 87, 164, 0.12);
        }

        .stat-card {
            overflow: hidden;
            border: 0;
            border-radius: 14px;
            box-shadow: 0 8px 28px rgba(39, 50, 72, 0.07);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            font-size: 1.4rem;
        }

        .empty-state {
            padding: 3rem 1rem !important;
            color: var(--app-muted) !important;
        }

        .pagination .page-link {
            color: var(--app-primary);
        }

        .pagination .active > .page-link {
            background-color: var(--app-primary);
            border-color: var(--app-primary);
        }

        .app-footer {
            color: #7a859b;
            border-top: 1px solid var(--app-border);
            background: white;
        }

        @media (max-width: 991.98px) {
            .app-navbar .navbar-collapse {
                margin-top: 12px;
                padding-top: 12px;
                border-top: 1px solid rgba(255, 255, 255, 0.15);
            }
        }
    </style>
</head>
<body>
    <?php require_once '../app/views/layout/partial/header.php'; ?>

    <main class="container py-4 py-lg-5">
        <?php if (isset($_SESSION['flash'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?> alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>
                <?php echo $_SESSION['flash']['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php } ?>

        <?php
            $viewname = $viewname ?? '';
            require_once '../app/views/' . $viewname . '.php';
        ?>
    </main>

    <?php require_once '../app/views/layout/partial/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
