<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <form action="/auth/login" method = "POST">
        <label for="username">Tên đăng nhập</label>
        <input type="text" name="username" id="username">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>