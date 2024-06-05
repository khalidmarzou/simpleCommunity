<?php
    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();
    $UserID = $_SESSION['userInfo'] -> UserID;

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['UserID'])) {
        $profileUserID = $_GET['UserID'];
    } else {
        $profileUserID = $UserID;
    }

    try {
        $query = 'SELECT * FROM Users WHERE UserID = :UserID;';
        $db -> query($query);
        $db -> bind(':UserID', $profileUserID);
        $db -> execute();
        $User = $db -> single();

    } catch (Exception $e) {
        echo 'There is an error in getting User Info , page Profile : '. $e -> getMessage() .'';
        die();
    }

    try {
        $query = 'SELECT * FROM Blogs WHERE UserID = :UserID;';
        $db -> query($query);
        $db -> bind(':UserID', $profileUserID);
        $db -> execute();
        $Blogs = $db -> resultSet();

        $db -> query('SELECT * FROM Followers WHERE FollowerID = :FollowerID AND UserID = :UserID;');
        $db -> bind(':UserID', $profileUserID);
        $db -> bind(':FollowerID', $UserID);
        $db -> execute();
        $followerORnot = $db -> rowCount() > 0 ? true : false;

    } catch (Exception $e) {
        echo 'Ther is an error in getting blogs for user in page profile : '. $e -> getMessage() .'';
        die();
    }


    require_once dirname(__DIR__) . "/views/profile.view.php";