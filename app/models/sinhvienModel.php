<?php

require_once '../app/core/DB.php';

class sinhvienModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function create($hoten, $gioitinh, $mssv, $malop)
    {
        $query = "INSERT INTO tbl_sinhviens (hoten, gioitinh, mssv, malop)
                  VALUES (:hoten, :gioitinh, :mssv, :malop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop, PDO::PARAM_STR); 

        return $stmt->execute();
    }

    public function paging($limit = 5, $offset = 0, $keyword = '', $lophocFilter = '', $sort = 'newest')
    {
        $conditions = [];
        $params = [];

        if ($keyword !== '') {
            $conditions[] = "(s.hoten LIKE :keyword_hoten OR s.mssv LIKE :keyword_mssv)";
            $params[':keyword_hoten'] = '%' . $keyword . '%';
            $params[':keyword_mssv'] = '%' . $keyword . '%';
        }

        if ($lophocFilter !== '') {
            $conditions[] = "s.malop = :malop";
            $params[':malop'] = $lophocFilter;
        }

        $where = empty($conditions) ? '' : 'WHERE ' . implode(' AND ', $conditions);
        $orderByOptions = [
            'newest' => 's.id DESC',
            'mssv_asc' => 's.mssv ASC, s.id DESC',
            'mssv_desc' => 's.mssv DESC, s.id DESC',
            'hoten_asc' => 's.hoten ASC, s.id DESC',
            'hoten_desc' => 's.hoten DESC, s.id DESC'
        ];
        $orderBy = $orderByOptions[$sort] ?? $orderByOptions['newest'];


        $query = "SELECT s.*, s.malop AS lophoc_id, l.tenlop
                  FROM tbl_sinhviens s
                  LEFT JOIN tbl_lophocs l ON s.malop = l.malop
                  $where
                  ORDER BY $orderBy
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $this->bindSearchParams($stmt, $params);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        $countQuery = "SELECT COUNT(*) FROM tbl_sinhviens s $where";
        $countStmt = $this->conn->prepare($countQuery);
        $this->bindSearchParams($countStmt, $params);
        $countStmt->execute();
        $totalRecord = $countStmt->fetchColumn();

        return [
            'sinhviens' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'totalpage' => ceil($totalRecord / $limit),
            'totalRecord' => $totalRecord
        ];
    }

    public function getById($id)
    {
        $query = "SELECT * FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isMssvExists($mssv, $excludeId = null)
    {
        $query = "SELECT COUNT(*) FROM tbl_sinhviens WHERE mssv = :mssv";

        if ($excludeId !== null) {
            $query .= " AND id != :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mssv', $mssv);

        if ($excludeId !== null) {
            $stmt->bindParam(':id', $excludeId, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function update($id, $hoten, $gioitinh, $mssv, $malop)
    {
        $query = "UPDATE tbl_sinhviens
                  SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, malop = :malop
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function bindSearchParams($stmt, $params)
    {
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, $key === ':malop' ? PDO::PARAM_STR : PDO::PARAM_STR);
        }
    }
}

?>