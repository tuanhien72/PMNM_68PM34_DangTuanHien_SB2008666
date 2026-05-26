<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>MSSV</th>
        </tr>
        <?php foreach ($sinhviens as $index => $sinhvien) : ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $sinhvien['hoten']; ?></td>
                <td><?php echo $sinhvien['gioitinh']; ?></td>
                <td><?php echo $sinhvien['mssv']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>