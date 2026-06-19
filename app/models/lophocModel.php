<?php

require_once '../app/core/DB.php';

class lophocModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllLophoc()
    {
        $query = "SELECT * FROM tbl_lophocs ORDER BY malop ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($malop, $tenlop, $ghichu)
    {
        $query = "INSERT INTO tbl_lophocs (malop, tenlop, ghichu)
                  VALUES (:malop, :tenlop, :ghichu)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindValue(':ghichu', $ghichu === '' ? null : $ghichu);

        return $stmt->execute();
    }

    public function paging($limit = 5, $offset = 0, $keyword = '')
    {
        $where = '';
        $params = [];

        if ($keyword !== '') {
            $where = "WHERE l.malop LIKE :keyword_malop OR l.tenlop LIKE :keyword_tenlop";
            $params[':keyword_malop'] = '%' . $keyword . '%';
            $params[':keyword_tenlop'] = '%' . $keyword . '%';
        }

        // --- SỬA Ở ĐÂY: LEFT JOIN qua s.malop = l.malop thay vì s.lophoc_id = l.id ---
        $query = "SELECT l.*, COUNT(s.id) AS total_sinhvien
                  FROM tbl_lophocs l
                  LEFT JOIN tbl_sinhviens s ON l.malop = s.malop
                  $where
                  GROUP BY l.id, l.malop, l.tenlop, l.ghichu
                  ORDER BY l.id DESC
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        $countQuery = "SELECT COUNT(*) FROM tbl_lophocs l $where";
        $countStmt = $this->conn->prepare($countQuery);

        foreach ($params as $key => $value) {
            $countStmt->bindValue($key, $value);
        }

        $countStmt->execute();
        $totalRecord = $countStmt->fetchColumn();

        return [
            'lophocs' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'totalpage' => ceil($totalRecord / $limit),
            'totalRecord' => $totalRecord
        ];
    }

    public function getById($id)
    {
        $query = "SELECT * FROM tbl_lophocs WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isMalopExists($malop, $excludeId = null)
    {
        $query = "SELECT COUNT(*) FROM tbl_lophocs WHERE malop = :malop";

        if ($excludeId !== null) {
            $query .= " AND id != :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);

        if ($excludeId !== null) {
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    // --- SỬA Ở ĐÂY: Đếm số sinh viên dựa theo malop thay vì lophoc_id (id số nguyên) ---
    public function countSinhviens($malop)
    {
        $query = "SELECT COUNT(*) FROM tbl_sinhviens WHERE malop = :malop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop, PDO::PARAM_STR);
        $stmt->execute();

        return (int)$stmt->fetchColumn();
    }

    public function update($id, $malop, $tenlop, $ghichu)
    {
        $query = "UPDATE tbl_lophocs
                  SET malop = :malop, tenlop = :tenlop, ghichu = :ghichu
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindValue(':ghichu', $ghichu === '' ? null : $ghichu);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM tbl_lophocs WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

?>