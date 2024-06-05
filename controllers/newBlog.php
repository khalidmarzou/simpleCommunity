<?php

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["BlogID"])) {
            $BlogID = $_POST['BlogID'];
            $query = 'SELECT * FROM Blogs WHERE BlogID = :BlogID;';
            $db -> query($query);
            $db -> bind(':BlogID', $BlogID);
            $db -> execute();
            $blogSelected = $db -> single();

        } else {
            $UserID = $_SESSION['userInfo'] -> UserID;
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            
            if (isset($_POST['BlogIDEdited'])) {
                try {
                    $query = 'UPDATE Blogs SET Title = :Title, Content = :Content WHERE BlogID = :BlogID;';
                    $db -> query($query);
                    $db -> bind(':BlogID', $_POST['BlogIDEdited']);
                    $db -> bind(':Title', $title);
                    $db -> bind(':Content', $content);
                    $db -> execute();

                    header("Location: /blog?BlogID=" . $_POST['BlogIDEdited']);
                    exit();
                } catch (Exception $e) {
                    echo  $e -> getMessage();
                    die();
                }
            } else {
                try {
                    $db -> query('INSERT INTO `Blogs`(`UserID`, `Title`, `Content`, `Category`) VALUES (:UserID, :Title, :Content, :Category)');
                    $db -> bind(':UserID', $UserID);
                    $db -> bind(':Title', $title);
                    $db -> bind(':Content', $content);
                    $db -> bind(':Category', $category);
                    $db -> execute();
        
                    header('Location: /dashboard');
                    exit();
                } catch (Exception $e) {
                    echo  $e -> getMessage();
                    die();
                }
            }
        }
        
    }

    require_once dirname(__DIR__) . "/views/newBlog.view.php";