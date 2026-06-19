<?php
$sinhviens = $sinhviens ?? [];
$lophocs = $lophocs ?? [];
$totalpage = $totalpage ?? 1;
$totalRecord = $totalRecord ?? 0;
$limit = $limit ?? 5;
$offset = $offset ?? 0;
$keyword = $keyword ?? '';
$lophocFilter = $lophocFilter ?? '';
$sort = $sort ?? 'newest';
$currentPage = floor($offset / $limit) + 1;
$searchParams = array_filter(['keyword' => $keyword, 'lophoc_id' => $lophocFilter, 'sort' => $sort], function ($value, $key) {
    if ($key === 'sort' && $value === 'newest') {
        return false;
    }

    return $value !== '';
}, ARRAY_FILTER_USE_BOTH);
$queryString = empty($searchParams) ? '' : '?' . http_build_query($searchParams);
$hasSearch = !empty($searchParams);
?>

<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <p class="text-primary fw-semibold mb-1">QUẢN LÝ SINH VIÊN</p>
        <h1 class="h2 page-heading mb-1"><?php echo $title ?? 'Danh sách sinh viên'; ?></h1>
        <p class="page-subtitle mb-0">Tìm kiếm, sắp xếp và quản lý thông tin sinh viên.</p>
    </div>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/sinhvien/create"><i class="bi bi-person-plus me-1"></i> Thêm sinh viên</a>
</div>

<form class="card app-card filter-card card-body mb-4" method="GET" action="<?php echo BASE_URL; ?>/sinhvien/index/<?php echo $limit; ?>/0">
    <div class="row g-2 align-items-end">
        <div class="col-12 col-lg">
            <label class="form-label" for="keyword">Tìm kiếm sinh viên</label>
            <input class="form-control" type="text" name="keyword" id="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tìm kiếm theo họ tên hoặc MSSV">
        </div>
        <div class="col-12 col-md-5 col-lg-3">
            <label class="form-label" for="lophoc_id">Lọc theo lớp</label>
            <select class="form-select" name="lophoc_id" id="lophoc_id">
                <option value="">Tất cả lớp</option>
                <option value="none" <?php echo $lophocFilter === 'none' ? 'selected' : ''; ?>>Chưa xếp lớp</option>
                <?php foreach ($lophocs as $lophoc): ?>
                    <option value="<?php echo $lophoc['id']; ?>" <?php echo (string)$lophocFilter === (string)$lophoc['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($lophoc['malop'] . ' - ' . $lophoc['tenlop']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 col-md-5 col-lg-3">
            <label class="form-label" for="sort">Sắp xếp</label>
            <select class="form-select" name="sort" id="sort">
                <option value="newest" <?php echo $sort === 'newest' ? 'selected' : ''; ?>>Mới nhất</option>
                <option value="mssv_asc" <?php echo $sort === 'mssv_asc' ? 'selected' : ''; ?>>MSSV tăng dần</option>
                <option value="mssv_desc" <?php echo $sort === 'mssv_desc' ? 'selected' : ''; ?>>MSSV giảm dần</option>
                <option value="hoten_asc" <?php echo $sort === 'hoten_asc' ? 'selected' : ''; ?>>Họ tên A-Z</option>
                <option value="hoten_desc" <?php echo $sort === 'hoten_desc' ? 'selected' : ''; ?>>Họ tên Z-A</option>
            </select>
        </div>
        <div class="col-12 col-sm-auto"><button class="btn btn-primary w-100" type="submit"><i class="bi bi-search me-1"></i> Tìm kiếm</button></div>
        <div class="col-12 col-sm-auto"><a class="btn btn-outline-secondary w-100" href="<?php echo BASE_URL; ?>/sinhvien/index/<?php echo $limit; ?>/0"><i class="bi bi-arrow-counterclockwise me-1"></i> Đặt lại</a></div>
        <div class="col-12 col-sm-auto">
            <select class="form-select" onchange="window.location.href='<?php echo BASE_URL; ?>/sinhvien/index/' + this.value + '/0<?php echo htmlspecialchars($queryString); ?>'">
                <?php foreach ([5, 10, 20] as $pageLimit): ?>
                    <option value="<?php echo $pageLimit; ?>" <?php echo $limit == $pageLimit ? 'selected' : ''; ?>><?php echo $pageLimit; ?> sinh viên/trang</option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</form>

<div class="card app-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">STT</th>
                        <th>Họ tên</th>
                        <th>MSSV</th>
                        <th class="text-center">Giới tính</th>
                        <th>Lớp học</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($sinhviens)): ?>
                        <tr>
                            <td class="text-center text-secondary py-4" colspan="6">
                                <?php echo $hasSearch ? 'Không tìm thấy sinh viên phù hợp.' : 'Chưa có sinh viên nào trong danh sách.'; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($sinhviens as $index => $sinhvien): ?>
                            <tr>
                                <td class="text-center"><?php echo $offset + $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['hoten']); ?></td>
                                <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                                <td>
                                    <?php if ($sinhvien['lophoc_id']): ?>
                                        <?php echo htmlspecialchars($sinhvien['malop'] . ' - ' . $sinhvien['tenlop']); ?>
                                    <?php else: ?>
                                        <span class="text-secondary">Chưa xếp lớp</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-outline-warning" href="<?php echo BASE_URL; ?>/sinhvien/edit/<?php echo $sinhvien['id']; ?>"><i class="bi bi-pencil-square"></i> Sửa</a>
                                    <a class="btn btn-sm btn-outline-danger" href="<?php echo BASE_URL; ?>/sinhvien/delete/<?php echo $sinhvien['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa sinh viên này không?');"><i class="bi bi-trash"></i> Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
    <p class="page-subtitle mb-0"><i class="bi bi-people me-1"></i> Tổng số sinh viên phù hợp: <strong class="text-dark"><?php echo $totalRecord; ?></strong></p>
    <?php if ($totalpage > 1): ?>
        <nav aria-label="Phân trang danh sách sinh viên">
            <ul class="pagination mb-0">
                <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>/sinhvien/index/<?php echo $limit; ?>/<?php echo max(0, ($currentPage - 2) * $limit); ?><?php echo htmlspecialchars($queryString); ?>">Trước</a></li>
                <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                    <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>/sinhvien/index/<?php echo $limit; ?>/<?php echo ($i - 1) * $limit; ?><?php echo htmlspecialchars($queryString); ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php echo $currentPage >= $totalpage ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>/sinhvien/index/<?php echo $limit; ?>/<?php echo $currentPage * $limit; ?><?php echo htmlspecialchars($queryString); ?>">Sau</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</div>
