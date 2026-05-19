<?php
    class auth {
        protected $user = [
            'admin' => '123456',
            'hiendt' => '123456'
        ];
        public function login() {
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
                if (isset($this->user[$username]) && $this->user[$username] === $password) {
                    header('Location:/home/index');
                    exit();
                } else {
                    header('Location:/home/login');
                    exit();
                }
            }
        }
    }
?>