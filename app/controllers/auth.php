<?php

class auth
{
    protected $users = [
        'hiendt' => '123456',
    ];

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (isset($this->users[$username]) && $this->users[$username] == $password) {
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