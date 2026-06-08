<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
</head>
<body>
    <h2>Thêm sinh viên</h2>
    <form action="/sinhvien/store" method = "POST">
        <label for="hoten">Họ tên</label>
        <input type="text" name="hoten" id="hoten">
        <label for="gioitinh">Giới tính</label>
        <input type="text" name="gioitinh" id="gioitinh">
        <label for="mssv">MSSV</label>
        <input type="text" name="mssv" id="mssv">
        <input type="submit" class="submit" value="Thêm mới">
    </form>
</body>
</html>