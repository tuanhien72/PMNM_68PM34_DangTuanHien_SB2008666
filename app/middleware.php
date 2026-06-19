<?php
// Bỏ require_once App.php ở đây vì index.php đã require rồi
class middleware {
    function checklogin() {
        // THÊM dấu / vào đầu các đường dẫn ở đây để khớp với $_SERVER['REQUEST_URI']
        $publicPages = ['/home/login', '/auth/login']; 
        
        if(!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPages)) {
            header('Location: /home/login');
            exit();
        }
    }
}
?>