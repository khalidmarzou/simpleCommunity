<?php

    session_start();

    if(isset($_SESSION['userInfo'])){
        try {
            require_once 'dataBase/connection.php';
            $query = "SELECT * FROM Blogs";
            $statement = $pdo -> prepare($query);
            $statement -> execute();
            $blogs = $statement -> fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Failed to Get Blogs : " . $e->getMessage());
        }
        // users Infos :

        $firstName = $_SESSION['userInfo']['FirstName'];
        $lastName = $_SESSION['userInfo']['LastName'];
        $email = $_SESSION['userInfo']['Email'];
        $id = $_SESSION['userInfo']['UserID'];

        // count total likes that user have:
        $query = 'SELECT COUNT(*) AS numberLikes FROM Blogs INNER JOIN Likes ON Blogs.BlogID = Likes.BlogID WHERE Blogs.UserID = :id';
        $statement = $pdo -> prepare($query);
        $statement -> execute([
            ':id'=> $id,
        ]);
        $numberLikes = $statement -> fetch(PDO::FETCH_ASSOC);
        $numberLikes = $numberLikes['numberLikes'];

        //count total comments that user have :
        $query = 'SELECT COUNT(*) AS numberComments FROM Blogs INNER JOIN Comments ON Blogs.BlogID = Comments.BlogID WHERE Blogs.UserID = :id';
        $statement = $pdo -> prepare($query);
        $statement -> execute([
            ':id'=> $id,
        ]);
        $numberComments = $statement -> fetch(PDO::FETCH_ASSOC);
        $numberComments = $numberComments['numberComments'];

        //count total blog that user have :
        $query = 'SELECT COUNT(*) AS numberBlogs FROM Blogs WHERE Blogs.UserID = :id';
        $statement = $pdo -> prepare($query);
        $statement -> execute([
            ':id'=> $id,
        ]);
        $numberBlogs = $statement -> fetch(PDO::FETCH_ASSOC);
        $numberBlogs = $numberBlogs['numberBlogs'];

        require_once './views/dashboard.view.php';
        exit();
    }else{
        header('Location: /');
        exit();
    }