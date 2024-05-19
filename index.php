<?php 
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];

    if ($uri === "/") {

        require 'controllers/index.php';
    }else if ($uri === "/register"){

        require 'controllers/register.php';
    }else if ($uri === "/login"){

        require "controllers/login.php";
    }else if ($uri === "/dashboard"){

        require "controllers/dashboard.php";
    }else{

        require "controllers/logOut.php";
    }