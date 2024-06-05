<?php
    
    session_start();
    $UserID = $_SESSION['userInfo'] -> UserID;
    require_once dirname(__DIR__) . "/database/connection.php" ;
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $BlogID = file_get_contents('php://input');

        if ($BlogID) {

            try {
                $query = 'SELECT * FROM Comments NATURAL JOIN Users WHERE BlogID = :BlogID ORDER BY CommentDate DESC;';
                $db -> query($query);
                $db -> bind(':BlogID', $BlogID);
                $db -> execute();
                $allComments = $db -> resultSet();

                foreach ($allComments as $comment) {
                    if(property_exists($comment,'Password')) {
                        unset($comment-> Password);
                    }
                    if(property_exists($comment,'Email')) {
                        unset($comment->Email);
                    }
                    $comment -> forMe = false;
                    if($comment -> UserID == $UserID ) {
                        $comment -> forMe = true;
                    }
                }

                $response = json_encode($allComments);
                echo $response;

            } catch (Exception $e) {
                echo 'The is an error in the API getComments : '. $e -> getMessage();
            }

        }
    }