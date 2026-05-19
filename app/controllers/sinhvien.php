<?php
class sinhvien{
    public function index() {
        //trả về view
        require_once '../app/views/sinhvien/index.php';
        echo "Đây là danh sách sinh viên";
    }

    public function create() {
        require_once '../app/views/sinhvien/create.php';
    }
}
?>