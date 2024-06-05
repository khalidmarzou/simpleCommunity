<?php

    session_start();
    require_once dirname(__DIR__) . '/database/connection.php';
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $rowData = file_get_contents('php://input');
        $data = json_decode($rowData, true);

        $BlogID = $data['BlogID'];
        $Comment = $data['Comment'];
        $UserID = $_SESSION['userInfo'] -> UserID;
        try {
            $query = 'INSERT INTO `Comments`(`UserID`, `BlogID`, `CommentText`) VALUES (:UserID, :BlogID, :Comment)';
            $db -> query($query);
            $db -> bind(':BlogID', $BlogID);
            $db -> bind(':UserID', $UserID);
            $db -> bind(':Comment', $Comment);
            if ($db -> execute()) {
                $response = array(
                    'status'=> 'success',
                );
            } else {
                $response = array(
                    'status'=> 'error',
                );
            }

        } catch (Exception $e) {
            
            echo $e -> getMessage();
        }

        $response = json_encode($response);
        echo $response;

    }