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
                    $_SESSION['username'] = $username;
                    header('Location: ' . BASE_URL . '/home/index');
                    exit();
                } else {
                    header('Location: ' . BASE_URL . '/home/login?error=1');
                    exit();
                }
            }

            header('Location: ' . BASE_URL . '/home/login');
            exit();
        }

        public function logout()
        {
        session_destroy();

        header('Location: ' . BASE_URL . '/home/login');
        exit();
        }
}

?>