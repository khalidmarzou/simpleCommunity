<?php

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $UserID = $_SESSION['userInfo'] -> UserID;
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        try {
            $db -> query('INSERT INTO `Blogs`(`UserID`, `Title`, `Content`, `Category`) VALUES (:UserID, :Title, :Content, :Category)');
            $db -> bind(':UserID', $UserID);
            $db -> bind(':Title', $title);
            $db -> bind(':Content', $content);
            $db -> bind(':Category', $category);
            $db -> execute();

            header('Location: /dashboard');
        } catch (Exception $e) {
            echo  $e -> getMessage();
            die();
        }
        
    }

    require_once dirname(__DIR__) . "/views/newBlog.view.php";