<?php
$sinhvien = $sinhvien ?? null;
?>

<h1>Sửa sinh viên</h1>

<?php if ($sinhvien): ?>
    <form action="<?php echo BASE_URL; ?>/sinhvien/update/<?php echo $sinhvien['id']; ?>" method="POST">
        <label for="hoten">Họ tên</label>
        <br>
        <input type="text" name="hoten" id="hoten" value="<?php echo $sinhvien['hoten']; ?>" required>
        <br><br>

        <label for="gioitinh">Giới tính</label>
        <br>
        <input type="text" name="gioitinh" id="gioitinh" value="<?php echo $sinhvien['gioitinh']; ?>" required>
        <br><br>

        <label for="mssv">MSSV</label>
        <br>
        <input type="text" name="mssv" id="mssv" value="<?php echo $sinhvien['mssv']; ?>" required>
        <br><br>

        <button type="submit">Cập nhật</button>
    </form>

    <br>

    <a href="<?php echo BASE_URL; ?>/sinhvien/index">Quay lại danh sách sinh viên</a>
<?php else: ?>
    <p>Không tìm thấy sinh viên.</p>

    <a href="<?php echo BASE_URL; ?>/sinhvien/index">Quay lại danh sách sinh viên</a>
<?php endif; ?>