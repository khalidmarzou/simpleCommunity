<?php

require_once dirname(__DIR__) . "/database/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = [
        "status" => 404,
    ];

    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    if (isset($data['BlogID'])) {
        $BlogID = $data['BlogID'];

        try {
            $db = new Database();
            $query = 'DELETE FROM Blogs WHERE BlogID = :BlogID;';
            $db->query($query);
            $db->bind(':BlogID', $BlogID);
            $db->execute();
            $response['status'] = 1;
        } catch (Exception $e) {
            $response['status'] = 0;
            error_log($e->getMessage());
        }
    } else {
        $response['status'] = 400;
    }

    echo json_encode($response);
}
