<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Hệ thống Quản lý'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-slate-50 min-h-screen flex flex-col text-slate-800">

    <?php require_once "partial/header.php"; ?>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg shadow-sm">
            <h3 class="text-base font-bold text-blue-800"><?php echo $title ?? 'Danh Sách Học Vụ'; ?></h3>
            <p class="text-xs text-blue-600 mt-1">Trang thao tác dữ liệu thời gian thực kết nối MySQL qua cấu trúc kiến trúc MVC Pattern.</p>
        </div>

        <div class="content-wrapper">
            <?php 
                if (!empty($viewname)): 
                    require_once '../app/views/' . $viewName . '.php'; 
                endif; 
            ?>
        </div>
    </main>

    <?php require_once "partial/footer.php"; ?>

</body>
</html>