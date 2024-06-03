<?php

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();

    if(!isset($_SESSION["userInfo"])){
        header("Location: /");
        exit();
    } else {
        $name = $_SESSION["userInfo"] -> FirstName . ' ' . $_SESSION["userInfo"] -> LastName;
        $email = $_SESSION["userInfo"] -> Email;
        $picture = $_SESSION["userInfo"] -> Profile;
        $UserID = $_SESSION["userInfo"] -> UserID;

        $db -> query("SELECT * FROM Likes WHERE BlogID IN (SELECT BlogID FROM Blogs WHERE UserID = :id)");
        $db -> bind(":id" , $UserID);
        $db -> execute();
        $likesNB = $db -> rowCount();


        $db -> query("SELECT * FROM Blogs WHERE UserID = :id");
        $db -> bind(":id", $UserID);
        $db -> execute();
        $blogsNB = $db -> rowCount();

        $db -> query("SELECT * FROM Blogs");
        $db -> execute();
        $allNB = $db -> rowCount();

        $db -> query("SELECT * FROM Blogs WHERE Category = 'Technology'");
        $db -> execute();
        $techNB = $db -> rowCount();

        $db -> query("SELECT * FROM Blogs WHERE Category = 'Sport'");
        $db -> execute();
        $sportNB = $db -> rowCount();

        $db -> query("SELECT * FROM Blogs WHERE Category = 'Science'");
        $db -> execute();
        $scienceNB = $db -> rowCount();

        $db -> query("SELECT * FROM Blogs NATURAL JOIN Users");
        $db -> execute();
        $allBlogs = array_reverse($db -> resultSet());

        $db -> query("SELECT * FROM Followers WHERE UserID = :UserID");
        $db -> bind(":UserID", $UserID);
        $db -> execute();
        $followersNB = $db -> rowCount();
        
        require_once dirname(__DIR__) . "/views/dashboard.view.php";
    }