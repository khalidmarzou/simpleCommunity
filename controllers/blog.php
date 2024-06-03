<?php

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['BlogID'])) {
        $BlogID = $_GET['BlogID'];
        $UserID = $_SESSION['userInfo'] -> UserID;
        $db -> query('SELECT * FROM Blogs NATURAL JOIN Users WHERE BlogID = :BlogID;');
        $db -> bind(':BlogID', $BlogID);
        $db -> execute();
        $blog = $db -> single();
        
        $db -> query('SELECT * FROM Comments WHERE BlogID = :BlogID');
        $db -> bind(':BlogID', $blog->BlogID);
        $db -> execute();
        $commentsNB = $db -> rowCount();

        $db -> query('SELECT * FROM Likes WHERE BlogID = :BlogID');
        $db -> bind(':BlogID', $blog->BlogID);
        $db -> execute();
        $likesBlogNB = $db -> rowCount();

        $db -> query('SELECT * FROM Dislikes WHERE BlogID = :BlogID');
        $db -> bind(':BlogID', $blog->BlogID);
        $db -> execute();
        $dislikesNB = $db -> rowCount();

        $reactionNB = $likesBlogNB - $dislikesNB;

        $db -> query('SELECT * FROM Likes WHERE UserID = :UserID AND BlogID = :BlogID');
        $db -> bind(':BlogID', $blog -> BlogID);
        $db -> bind(':UserID', $UserID);
        $db -> execute();
        $likeit =  $db -> rowCount();

        $db -> query('SELECT * FROM Dislikes WHERE UserID = :UserID AND BlogID = :BlogID');
        $db -> bind(':BlogID', $blog -> BlogID);
        $db -> bind(':UserID', $UserID);
        $db -> execute();
        $dislikeit =  $db -> rowCount() > 0;

        $db -> query('SELECT * FROM Followers WHERE FollowerID = :FollowerID AND UserID = :UserID;');
        $db -> bind(':UserID', $blog -> UserID);
        $db -> bind(':FollowerID', $UserID);
        $db -> execute();
        $followerORnot = $db -> rowCount() > 0;

        require_once dirname(__DIR__) . "/views/blog.view.php";
        
    } else {
        header("Location: /404");
        exit();
    }