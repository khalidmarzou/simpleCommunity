<?php
    require_once dirname(__DIR__) . "/database/connection.php";
    $db =  new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $rowData = file_get_contents('php://input');
        $data = json_decode($rowData, true);
        $CommentID = $data['CommentID'];
        $response = array(
            'status'=> false,
        );
        try {
            $query = 'DELETE FROM Comments WHERE CommentID = :CommentID';
            $db -> query($query);
            $db -> bind(':CommentID', $CommentID);
            $db -> execute();
            $response['status'] = true;

        } catch (Exception $e) {

            echo $e->getMessage();
        }

        $response = json_encode($response);
        echo $response;
    }