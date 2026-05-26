<?php
    session_start();
    require_once '../app/core/Controller.php';
    
    require_once '../app/middleware.php';
    $middleware = new middleware();
    $middleware -> checklogin();
    $app = new App();

?>