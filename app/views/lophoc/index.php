<?php
$lophocs = $lophocs ?? [];
$totalpage = $totalpage ?? 1;
$totalRecord = $totalRecord ?? 0;
$limit = $limit ?? 5;
$offset = $offset ?? 0;
$keyword = $keyword ?? '';
$currentPage = floor($offset / $limit) + 1;
$queryString = $keyword !== '' ? '?keyword=' . urlencode($keyword) : '';
$hasSearch = $keyword !== '';
?>

<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <p class="text-primary fw-semibold mb-1">QUẢN LÝ LỚP HỌC</p>
        <h1 class="h2 page-heading mb-1"><?php echo $title ?? 'Danh sách lớp học'; ?></h1>
        <p class="page-subtitle mb-0">Theo dõi lớp học, ghi chú và số lượng sinh viên.</p>
    </div>
    <a class="btn btn-success" href="<?php echo BASE_URL; ?>/lophoc/create"><i class="bi bi-plus-circle me-1"></i> Thêm lớp học</a>
</div>

<form class="card app-card filter-card card-body mb-4" method="GET" action="<?php echo BASE_URL; ?>/lophoc/index/<?php echo $limit; ?>/0">
    <div class="row g-2 align-items-end">
        <div class="col-12 col-lg">
            <label class="form-label" for="keyword">Tìm kiếm lớp học</label>
            <input class="form-control" type="text" name="keyword" id="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tìm kiếm theo mã lớp hoặc tên lớp">
        </div>
        <div class="col-12 col-sm-auto">
            <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search me-1"></i> Tìm kiếm</button>
        </div>
        <div class="col-12 col-sm-auto">
            <a class="btn btn-outline-secondary w-100" href="<?php echo BASE_URL; ?>/lophoc/index/<?php echo $limit; ?>/0"><i class="bi bi-arrow-counterclockwise me-1"></i> Đặt lại</a>
        </div>
        <div class="col-12 col-sm-auto">
            <select class="form-select" onchange="window.location.href='<?php echo BASE_URL; ?>/lophoc/index/' + this.value + '/0<?php echo $queryString; ?>'">
                <?php foreach ([5, 10, 20] as $pageLimit): ?>
                    <option value="<?php echo $pageLimit; ?>" <?php echo $limit == $pageLimit ? 'selected' : ''; ?>><?php echo $pageLimit; ?> lớp/trang</option>
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
                        <th>Mã lớp</th>
                        <th>Tên lớp</th>
                        <th>Ghi chú</th>
                        <th class="text-center">Số sinh viên</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($lophocs)): ?>
                        <tr>
                            <td class="text-center text-secondary py-4" colspan="6">
                                <?php echo $hasSearch ? 'Không tìm thấy lớp học phù hợp.' : 'Chưa có lớp học nào trong danh sách.'; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($lophocs as $index => $lophoc): ?>
                            <tr>
                                <td class="text-center"><?php echo $offset + $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($lophoc['malop']); ?></td>
                                <td><?php echo htmlspecialchars($lophoc['tenlop']); ?></td>
                                <td><?php echo htmlspecialchars($lophoc['ghichu'] ?? ''); ?></td>
                                <td class="text-center"><?php echo $lophoc['total_sinhvien']; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-outline-warning" href="<?php echo BASE_URL; ?>/lophoc/edit/<?php echo $lophoc['id']; ?>"><i class="bi bi-pencil-square"></i> Sửa</a>
                                    <a class="btn btn-sm btn-outline-danger" href="<?php echo BASE_URL; ?>/lophoc/delete/<?php echo $lophoc['id']; ?>" onclick="return confirm('Bạn có chắc muốn xóa lớp học này không?');"><i class="bi bi-trash"></i> Xóa</a>
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
    <p class="page-subtitle mb-0"><i class="bi bi-journal-bookmark me-1"></i> Tổng số lớp học phù hợp: <strong class="text-dark"><?php echo $totalRecord; ?></strong></p>
    <?php if ($totalpage > 1): ?>
        <nav aria-label="Phân trang danh sách lớp học">
            <ul class="pagination mb-0">
                <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>/lophoc/index/<?php echo $limit; ?>/<?php echo max(0, ($currentPage - 2) * $limit); ?><?php echo $queryString; ?>">Trước</a></li>
                <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                    <li class="page-item <?php echo $i == $currentPage ? 'active' : ''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>/lophoc/index/<?php echo $limit; ?>/<?php echo ($i - 1) * $limit; ?><?php echo $queryString; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?php echo $currentPage >= $totalpage ? 'disabled' : ''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>/lophoc/index/<?php echo $limit; ?>/<?php echo $currentPage * $limit; ?><?php echo $queryString; ?>">Sau</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</div>
