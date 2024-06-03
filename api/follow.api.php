<?php

    session_start();
    require_once dirname(__DIR__) . "/database/connection.php";
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $response = array(
            "status" => 404,
            "followersNB" => 404
        );

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        $BlogID = $data['BlogID'];
        $db -> query('SELECT UserID FROM Blogs WHERE BlogID = :BlogID');
        $db -> bind(':BlogID', $BlogID);
        $db -> execute();
        $followTarget = $db -> single();


        $followTarget = $followTarget -> UserID;

        $action = $data['action'];
        $UserID = $_SESSION['userInfo'] -> UserID;

        if ($action == 1) {
            try {

                $db -> query('INSERT INTO Followers (FollowerID, UserID) VALUES (:FollowerID, :UserID)');
                $db -> bind(':FollowerID', $UserID);
                $db -> bind(':UserID', $followTarget);
                $db -> execute();

                $response["status"] = 1;
            
            } catch (Exception $e) {

                $response["status"] = 0;
            }
            

        } else {
            try {

                $db -> query('DELETE FROM Followers WHERE FollowerID = :FollowerID AND UserID = :UserID');
                $db -> bind(':FollowerID', $UserID);
                $db -> bind(':UserID', $followTarget);
                $db -> execute();
                $response["status"] = 1;
               
            } catch (Exception $e) {

                $response["status"] = 0;
            }
        }

        try {
            $db -> query("SELECT * FROM Followers WHERE UserID = :UserID");
            $db -> bind(":UserID", $UserID);
            $db -> execute();
            $followersNB = $db -> rowCount();

            $response["followersNB"] = $followersNB;
        } catch (Exception $e) {

            $response["followersNB"] = 404;
        }

        $response = json_encode($response);
        echo $response;
    }