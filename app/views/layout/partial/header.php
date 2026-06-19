<header class="bg-indigo-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-lg font-bold tracking-tight">Hệ Thống Quản Lý Học Vụ</h1>
            <p class="text-xs text-indigo-200">Xin chào, <?php echo $_SESSION['username'] ?? 'Guest'; ?></p>
        </div>
        <nav class="flex space-x-2 bg-indigo-800 p-1 rounded-lg text-sm font-semibold">
            <a href="/sinhvien/index" class="px-4 py-2 rounded-md hover:bg-indigo-600 transition">Quản lý Sinh Viên</a>
            <a href="/lophoc/index" class="px-4 py-2 rounded-md hover:bg-indigo-600 transition">Quản lý Lớp Học</a>
            <a href="/auth/logout" class="px-4 py-2 bg-rose-600 text-white rounded-md hover:bg-rose-700 transition">Đăng xuất</a>
        </nav>
    </div>
</header>