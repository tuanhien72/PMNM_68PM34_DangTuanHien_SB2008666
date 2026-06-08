<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhviens = $sinhvienModel->getAllSinhVien();
        $this->view("sinhvien/index", ['sinhviens' => $sinhviens]);
    }

    public function create() {
        require_once '../app/views/sinhvien/create.php';
    }

    public function store() {
        if (isset($_SERVER ['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $mssv = $_POST['mssv'] ?? '';
            $result = $sinhvienModel->create($hoten, $gioitinh, $mssv);
            if($result) {
                echo "Thêm mới sinh viên thành công";
            }else {
                echo "Thêm mới sinh viên thất bại";
            }
        }
    }
}