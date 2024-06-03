<?php
    
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];

    $routes = [

        "/" => "controllers/index.php",

        "/dashboard" => "controllers/dashboard.php",

        "/logout" => "controllers/logout.php",

        "/register" => "controllers/register.php",

        "/login" => "controllers/login.php",

        "/forgetPassword" => "controllers/forgetPassword.php",

        "/terms" => "terms_conditions/terms.html",

        "/newBlog" => "controllers/newBlog.php",

        "/blog" => "controllers/blog.php",
        
    ];

    if(array_key_exists($uri, $routes)) {

        require $routes[$uri];

    } else {

        require "views/page404.php";

        die();
    }