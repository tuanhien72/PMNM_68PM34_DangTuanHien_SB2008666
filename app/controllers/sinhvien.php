<?php

require_once '../app/core/Controller.php';

class sinhvien extends Controller
{
    public function index($limit = 5, $offset = 0)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;

        if ($limit <= 0) {
            $limit = 5;
        }

        if ($offset < 0) {
            $offset = 0;
        }

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset);

        $sinhviens = $result['sinhviens'];
        $totalpage = $result['totalpage'];

        $this->view('sinhvien/index', [
            'sinhviens' => $sinhviens,
            'title' => 'Danh sách sinh viên',
            'totalpage' => $totalpage,
            'limit' => $limit,
            'offset' => $offset
        ]);
    }

    public function create()
    {
        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên'
        ]);
    }

    public function store()
    {
        $hoten = $_POST['hoten'] ?? '';
        $gioitinh = $_POST['gioitinh'] ?? '';
        $mssv = $_POST['mssv'] ?? '';

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->create($hoten, $gioitinh, $mssv);

        if ($result) {
            header('Location: ' . BASE_URL . '/sinhvien/index');
            exit();
        } else {
            echo 'Thêm mới sinh viên thất bại';
        }
    }

    public function edit($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getById($id);

        $this->view('sinhvien/edit', [
            'sinhvien' => $sinhvien,
            'title' => 'Sửa sinh viên'
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $mssv = $_POST['mssv'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $hoten, $gioitinh, $mssv);

            if ($result) {
                header('Location: ' . BASE_URL . '/sinhvien/index');
                exit();
            } else {
                echo 'Cập nhật sinh viên thất bại';
            }
        }
    }
}

?>