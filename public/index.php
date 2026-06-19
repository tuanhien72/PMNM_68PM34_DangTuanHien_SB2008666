<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domainName = $_SERVER['HTTP_HOST'];

$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = str_replace('\\', '/', $basePath);
$basePath = rtrim($basePath, '/'); 

define('BASE_URL', $protocol . $domainName . $basePath);

require_once '../app/middleware.php';

$middleware = new middleware();
$middleware->checklogin();

require_once '../app/core/App.php';

$app = new App();

?>