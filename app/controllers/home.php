<?php

require_once '../app/core/Controller.php';

class home extends Controller
{
    public function index()
    {
        $this->view('home/index', [
            'title' => 'Trang chủ'
        ]);
    }

    public function create()
    {
        echo "Đây là trang tạo mới của Home";
    }

    public function login()
    {
        $this->view('home/login', [
            'title' => 'Đăng nhập'
        ]);
    }
}

?>
