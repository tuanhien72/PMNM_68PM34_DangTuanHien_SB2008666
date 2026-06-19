<?php

require_once '../app/core/Controller.php';

class sinhvien extends Controller
{
    public function index($limit = 5, $offset = 0)
    {
        $allowedLimits = [5, 10, 20];
        $limit = (int)$limit;
        $offset = (int)$offset;
        $keyword = trim($_GET['keyword'] ?? '');
        $lophocFilter = trim($_GET['lophoc_id'] ?? ''); 
        $sort = trim($_GET['sort'] ?? 'newest');
        $allowedSorts = ['newest', 'mssv_asc', 'mssv_desc', 'hoten_asc', 'hoten_desc'];

        if (!in_array($limit, $allowedLimits)) {
            $limit = 5;
        }

        if ($offset < 0) {
            $offset = 0;
        }

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'newest';
        }

        $lophocModel = $this->model('lophocModel');

        if ($lophocFilter !== '' && !$lophocModel->isMalopExists($lophocFilter)) {
            $lophocFilter = '';
        }

        $result = $this->model('sinhvienModel')->paging($limit, $offset, $keyword, $lophocFilter, $sort);

        $this->view('sinhvien/index', [
            'sinhviens' => $result['sinhviens'],
            'title' => 'Danh sách sinh viên',
            'totalpage' => $result['totalpage'],
            'totalRecord' => $result['totalRecord'],
            'limit' => $limit,
            'offset' => $offset,
            'keyword' => $keyword,
            'lophocFilter' => $lophocFilter,
            'sort' => $sort,
            'lophocs' => $lophocModel->getAllLophoc() 
        ]);
    }

    public function create()
    {
        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên',
            'errors' => [],
            'old' => [],
            'lophocs' => $this->model('lophocModel')->getAllLophoc()
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/sinhvien/create');
        }

        $hoten = trim($_POST['hoten'] ?? '');
        $gioitinh = trim($_POST['gioitinh'] ?? '');
        $mssv = trim($_POST['mssv'] ?? '');
        $malop = $this->getMalop(); 
        $sinhvienModel = $this->model('sinhvienModel');
        $lophocModel = $this->model('lophocModel');
        $errors = $this->validate($hoten, $gioitinh, $mssv, $malop, $lophocModel);

        if ($mssv !== '' && $sinhvienModel->isMssvExists($mssv)) {
            $errors[] = 'MSSV đã tồn tại.';
        }

        if (!empty($errors)) {
            $this->view('sinhvien/create', [
                'title' => 'Thêm sinh viên',
                'errors' => $errors,
                'old' => ['hoten' => $hoten, 'gioitinh' => $gioitinh, 'mssv' => $mssv, 'lophoc_id' => $malop],
                'lophocs' => $lophocModel->getAllLophoc()
            ]);
            return;
        }

        if ($sinhvienModel->create($hoten, $gioitinh, $mssv, $malop)) {
            $this->setFlash('success', 'Thêm sinh viên thành công.');
        } else {
            $this->setFlash('danger', 'Thêm sinh viên thất bại.');
        }

        $this->redirect('/sinhvien/index');
    }

    public function edit($id)
    {
        $sinhvien = $this->model('sinhvienModel')->getById($id);

        if (!$sinhvien) {
            $this->setFlash('danger', 'Không tìm thấy sinh viên.');
            $this->redirect('/sinhvien/index');
        }

        $this->view('sinhvien/edit', [
            'sinhvien' => $sinhvien,
            'title' => 'Sửa sinh viên',
            'errors' => [],
            'lophocs' => $this->model('lophocModel')->getAllLophoc()
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/sinhvien/index');
        }

        $sinhvienModel = $this->model('sinhvienModel');

        if (!$sinhvienModel->getById($id)) {
            $this->setFlash('danger', 'Không tìm thấy sinh viên.');
            $this->redirect('/sinhvien/index');
        }

        $hoten = trim($_POST['hoten'] ?? '');
        $gioitinh = trim($_POST['gioitinh'] ?? '');
        $mssv = trim($_POST['mssv'] ?? '');
        $malop = $this->getMalop(); 
        $lophocModel = $this->model('lophocModel');
        $errors = $this->validate($hoten, $gioitinh, $mssv, $malop, $lophocModel);

        if ($mssv !== '' && $sinhvienModel->isMssvExists($mssv, $id)) {
            $errors[] = 'MSSV đã tồn tại.';
        }

        if (!empty($errors)) {
            $this->view('sinhvien/edit', [
                'title' => 'Sửa sinh viên',
                'errors' => $errors,
                'sinhvien' => ['id' => $id, 'hoten' => $hoten, 'gioitinh' => $gioitinh, 'mssv' => $mssv, 'malop' => $malop],
                'lophocs' => $lophocModel->getAllLophoc()
            ]);
            return;
        }

        if ($sinhvienModel->update($id, $hoten, $gioitinh, $mssv, $malop)) {
            $this->setFlash('success', 'Cập nhật sinh viên thành công.');
        } else {
            $this->setFlash('danger', 'Cập nhật sinh viên thất bại.');
        }

        $this->redirect('/sinhvien/index');
    }

    public function delete($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');

        if (!$sinhvienModel->getById($id)) {
            $this->setFlash('danger', 'Không tìm thấy sinh viên.');
            $this->redirect('/sinhvien/index');
        }

        if ($sinhvienModel->delete($id)) {
            $this->setFlash('success', 'Xóa sinh viên thành công.');
        } else {
            $this->setFlash('danger', 'Xóa sinh viên thất bại.');
        }
        $this->redirect('/sinhvien/index');
    }

    private function getMalop()
    {
        return trim($_POST['lophoc_id'] ?? '');
    }

    private function validate($hoten, $gioitinh, $mssv, $malop, $lophocModel)
    {
        $errors = [];

        if ($hoten === '') {
            $errors[] = 'Họ tên không được để trống.';
        } elseif (mb_strlen($hoten) > 100) {
            $errors[] = 'Họ tên không được vượt quá 100 ký tự.';
        }

        if ($mssv === '') {
            $errors[] = 'MSSV không được để trống.';
        } elseif (mb_strlen($mssv) > 20) {
            $errors[] = 'MSSV không được vượt quá 20 ký tự.';
        }

        if (!in_array($gioitinh, ['Nam', 'Nữ', 'Khác'])) {
            $errors[] = 'Giới tính không hợp lệ.';
        }

        if ($malop === '') {
            $errors[] = 'Vui lòng chọn lớp học cho sinh viên.';
        } elseif (!$lophocModel->isMalopExists($malop)) {
            $errors[] = 'Lớp học không hợp lệ hoặc không tồn tại.';
        }

        return $errors;
    }

    private function setFlash($type, $message)
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    private function redirect($path)
    {
        header('Location: ' . BASE_URL . $path);
        exit();
    }
}

?>