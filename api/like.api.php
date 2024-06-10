<?php

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $response = array(
            "status" => 404,
            "reactionNB" => 404,
            "likeNB"=> 404,
        );
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        $BlogID = $data['BlogID'];
        $action = $data['action'];
        $UserID = $_SESSION['userInfo'] -> UserID;


        if ($action == 1) {
            try {
                $db -> beginTransaction();
                $db -> query('INSERT INTO Likes (UserID, BlogID) VALUES (:UserID, :BlogID)');
                $db -> bind(':UserID', $UserID);
                $db -> bind(':BlogID', $BlogID);
                $db -> execute();

                $db -> query('DELETE FROM Dislikes WHERE UserID = :UserID AND BlogID = :BlogID');
                $db -> bind(':UserID', $UserID);
                $db -> bind(':BlogID', $BlogID);
                $db -> execute();
                $db -> commitTransaction();
                $response["status"] = 1;
            
            } catch (Exception $e) {
                $db -> cancelTransaction();
                $response["status"] = 0;
            }
            

        } else {
            try {

                $db -> query('DELETE FROM Likes WHERE UserID = :UserID AND BlogID = :BlogID');
                $db -> bind(':UserID', $UserID);
                $db -> bind(':BlogID', $BlogID);
                $db -> execute();
                $response["status"] = 1;
               
            } catch (Exception $e) {

                $response["status"] = 0;
            }
        }
        try {   
                $db -> beginTransaction();
                $db -> query('SELECT * FROM Likes WHERE BlogID = :BlogID');
                $db -> bind(':BlogID', $BlogID);
                $db -> execute();
                $likesBlogNB = $db -> rowCount();

                $db -> query('SELECT * FROM Dislikes WHERE BlogID = :BlogID');
                $db -> bind(':BlogID', $BlogID);
                $db -> execute();
                $dislikesNB = $db -> rowCount();

                $db -> query("SELECT * FROM Likes WHERE BlogID IN (SELECT BlogID FROM Blogs WHERE UserID = :UserID)");
                $db -> bind(':UserID', $UserID);
                $db -> execute();
                $likeNB = $db -> rowCount();

                $db -> commitTransaction();
                $reactionNB = $likesBlogNB - $dislikesNB;
                $response["reactionNB"] = $reactionNB;
                $response["likeNB"] = $likeNB;
            
        } catch (Exception $e) {
                $db -> cancelTransaction();
                $response["reactionNB"] = 404;
        }

        $response = json_encode($response);
        echo $response;
    }