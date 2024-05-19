<?php

    session_start();
    
    if (isset($_SESSION['userInfo'])){
        header('Location: /dashboard');
        exit();
    }else{
        require_once "views/index.view.php";
    }