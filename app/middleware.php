<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class middleware
{
    public function checklogin()
    {
        $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $isPublicPage = str_contains($currentUrl, '/home/login') || 
                        str_contains($currentUrl, '/auth/login') || 
                        str_contains($currentUrl, '/auth/logout');

        if (!isset($_SESSION['username']) && !$isPublicPage) {
            header('Location: ' . BASE_URL . '/home/login');
            exit();
        }

        if (isset($_SESSION['username']) && (str_contains($currentUrl, '/home/login') || str_contains($currentUrl, '/auth/login'))) {
            header('Location: ' . BASE_URL . '/home/index');
            exit();
        }
    }
}