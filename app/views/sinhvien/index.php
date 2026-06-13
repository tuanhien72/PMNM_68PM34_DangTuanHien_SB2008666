<?php
$sinhviens = $sinhviens ?? [];
$totalpage = $totalpage ?? 1;
$limit = $limit ?? 5;
$offset = $offset ?? 0;

$currentPage = floor($offset / $limit) + 1;
?>

<h1><?php echo $title ?? 'Danh sách sinh viên'; ?></h1>

<div style="margin-bottom: 15px;">
    <a href="<?php echo BASE_URL; ?>/home/index">Trở về Home</a>
    |
    <a href="<?php echo BASE_URL; ?>/sinhvien/create">Thêm sinh viên</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>MSSV</th>
        <th>Giới tính</th>
        <th>Thao tác</th>
    </tr>

    <?php foreach ($sinhviens as $index => $sinhvien): ?>
        <tr>
            <td><?php echo $offset + $index + 1; ?></td>
            <td><?php echo $sinhvien['hoten']; ?></td>
            <td><?php echo $sinhvien['mssv']; ?></td>
            <td><?php echo $sinhvien['gioitinh']; ?></td>
            <td>
                <a href="<?php echo BASE_URL; ?>/sinhvien/edit/<?php echo $sinhvien['id']; ?>">Sửa</a>
                |
                <a href="<?php echo BASE_URL; ?>/sinhvien/delete/<?php echo $sinhvien['id']; ?>">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div style="margin-top: 20px;">
    <?php for ($i = 1; $i <= $totalpage; $i++): ?>
        <?php
            $newOffset = ($i - 1) * $limit;
        ?>

        <?php if ($i == $currentPage): ?>
            <strong style="margin-right: 8px;">
                <?php echo $i; ?>
            </strong>
        <?php else: ?>
            <a style="margin-right: 8px;" href="<?php echo BASE_URL; ?>/sinhvien/index/<?php echo $limit; ?>/<?php echo $newOffset; ?>">
                <?php echo $i; ?>
            </a>
        <?php endif; ?>
    <?php endfor; ?>
</div>