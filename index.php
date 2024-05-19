<?php

    session_start();
    
    if (isset($_SESSION['userInfo'])){
        header('Location: /dashboard.php');
        exit();
    }else{
        require_once "views/index.view.php";
    }