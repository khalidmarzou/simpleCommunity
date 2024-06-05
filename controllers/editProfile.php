<?php   

    session_start();

    if (!isset($_SESSION['userInfo'])) {
        header('Location: /');
        exit();
    } else {
        

        require_once dirname(__DIR__) . "/views/editProfile.view.php";
    }