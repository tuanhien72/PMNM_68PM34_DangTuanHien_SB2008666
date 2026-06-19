<?php

class ConnectDB
{
    private $host = 'localhost';
    private $db_name = '68pm4';
    private $username = 'root';
    private $password = '';
    public $conn;

    public static function Connect()
    {
        $self = new self();
        $self->conn = null;

        try {
            $self->conn = new PDO(
                'mysql:host=' . $self->host . ';dbname=' . $self->db_name,
                $self->username,
                $self->password
            );

            $self->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $self->conn->exec("set names utf8mb4");
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
            exit();
        }

        return $self->conn;
    }
}
