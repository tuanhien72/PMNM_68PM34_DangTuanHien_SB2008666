<?php

require_once '../app/core/Controller.php';

class lophoc extends Controller
{
    public function index($limit = 5, $offset = 0)
    {
        $allowedLimits = [5, 10, 20];
        $limit = (int)$limit;
        $offset = (int)$offset;
        $keyword = trim($_GET['keyword'] ?? '');

        if (!in_array($limit, $allowedLimits)) {
            $limit = 5;
        }

        if ($offset < 0) {
            $offset = 0;
        }

        $result = $this->model('lophocModel')->paging($limit, $offset, $keyword);

        $this->view('lophoc/index', [
            'lophocs' => $result['lophocs'],
            'title' => 'Danh sách lớp học',
            'totalpage' => $result['totalpage'],
            'totalRecord' => $result['totalRecord'],
            'limit' => $limit,
            'offset' => $offset,
            'keyword' => $keyword
        ]);
    }

    public function create()
    {
        $this->view('lophoc/create', [
            'title' => 'Thêm lớp học',
            'errors' => [],
            'old' => []
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/lophoc/create');
        }

        $malop = trim($_POST['malop'] ?? '');
        $tenlop = trim($_POST['tenlop'] ?? '');
        $ghichu = trim($_POST['ghichu'] ?? '');
        $lophocModel = $this->model('lophocModel');
        $errors = $this->validate($malop, $tenlop, $ghichu);

        if ($malop !== '' && $lophocModel->isMalopExists($malop)) {
            $errors[] = 'Mã lớp đã tồn tại.';
        }

        if (!empty($errors)) {
            $this->view('lophoc/create', [
                'title' => 'Thêm lớp học',
                'errors' => $errors,
                'old' => ['malop' => $malop, 'tenlop' => $tenlop, 'ghichu' => $ghichu]
            ]);
            return;
        }

        if ($lophocModel->create($malop, $tenlop, $ghichu)) {
            $this->setFlash('success', 'Thêm lớp học thành công.');
        } else {
            $this->setFlash('danger', 'Thêm lớp học thất bại.');
        }

        $this->redirect('/lophoc/index');
    }

    public function edit($id)
    {
        $lophoc = $this->model('lophocModel')->getById($id);

        if (!$lophoc) {
            $this->setFlash('danger', 'Không tìm thấy lớp học.');
            $this->redirect('/lophoc/index');
        }

        $this->view('lophoc/edit', [
            'lophoc' => $lophoc,
            'title' => 'Sửa lớp học',
            'errors' => []
        ]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/lophoc/index');
        }

        $lophocModel = $this->model('lophocModel');

        if (!$lophocModel->getById($id)) {
            $this->setFlash('danger', 'Không tìm thấy lớp học.');
            $this->redirect('/lophoc/index');
        }

        $malop = trim($_POST['malop'] ?? '');
        $tenlop = trim($_POST['tenlop'] ?? '');
        $ghichu = trim($_POST['ghichu'] ?? '');
        $errors = $this->validate($malop, $tenlop, $ghichu);

        if ($malop !== '' && $lophocModel->isMalopExists($malop, $id)) {
            $errors[] = 'Mã lớp đã tồn tại.';
        }

        if (!empty($errors)) {
            $this->view('lophoc/edit', [
                'title' => 'Sửa lớp học',
                'errors' => $errors,
                'lophoc' => ['id' => $id, 'malop' => $malop, 'tenlop' => $tenlop, 'ghichu' => $ghichu]
            ]);
            return;
        }

        if ($lophocModel->update($id, $malop, $tenlop, $ghichu)) {
            $this->setFlash('success', 'Cập nhật lớp học thành công.');
        } else {
            $this->setFlash('danger', 'Cập nhật lớp học thất bại.');
        }

        $this->redirect('/lophoc/index');
    }

    public function delete($id)
    {
        $lophocModel = $this->model('lophocModel');

        if (!$lophocModel->getById($id)) {
            $this->setFlash('danger', 'Không tìm thấy lớp học.');
            $this->redirect('/lophoc/index');
        }

        $totalSinhvien = $lophocModel->countSinhviens($id);

        if ($lophocModel->delete($id)) {
            $message = 'Xóa lớp học thành công.';

            if ($totalSinhvien > 0) {
                $message .= ' ' . $totalSinhvien . ' sinh viên được chuyển về trạng thái chưa xếp lớp.';
            }

            $this->setFlash('success', $message);
        } else {
            $this->setFlash('danger', 'Xóa lớp học thất bại.');
        }

        $this->redirect('/lophoc/index');
    }

    private function validate($malop, $tenlop, $ghichu)
    {
        $errors = [];

        if ($malop === '') {
            $errors[] = 'Mã lớp không được để trống.';
        } elseif (mb_strlen($malop) > 20) {
            $errors[] = 'Mã lớp không được vượt quá 20 ký tự.';
        }

        if ($tenlop === '') {
            $errors[] = 'Tên lớp không được để trống.';
        } elseif (mb_strlen($tenlop) > 100) {
            $errors[] = 'Tên lớp không được vượt quá 100 ký tự.';
        }

        if (mb_strlen($ghichu) > 255) {
            $errors[] = 'Ghi chú không được vượt quá 255 ký tự.';
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
