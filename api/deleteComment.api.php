<?php

require_once dirname(__DIR__) . "/database/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = [
        'status' => false,
    ];

    $rowData = file_get_contents('php://input');
    $data = json_decode($rowData, true);

    if (isset($data['CommentID'])) {
        $CommentID = $data['CommentID'];

        try {
            $db = new Database();
            $query = 'DELETE FROM Comments WHERE CommentID = :CommentID';
            $db->query($query);
            $db->bind(':CommentID', $CommentID);
            $db->execute();
            $response['status'] = true;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    } else {
        http_response_code(400);
        $response['error'] = 'CommentID not provided';
    }

    echo json_encode($response);
}
