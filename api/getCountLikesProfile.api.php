<?php
require_once dirname(__DIR__) . '/database/connection.php';
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        $BlogID = $data['BlogID'];
        $response = array(
            "countLikes" => 404,
            "countDislikes" => 404,
        );


        $query = 'SELECT UserID FROM Blogs WHERE BlogID = :BlogID;';
        $db->query($query);
        $db->bind(':BlogID', $BlogID);
        $db->execute();
        $result = $db->single();

        $UserID = $result->UserID;

        $query = 'SELECT * FROM Likes WHERE BlogID IN (SELECT BlogID FROM Blogs WHERE UserID = :UserID);';
        $db->query($query);
        $db->bind(':UserID', $UserID);
        $db->execute();
        $countLikes = $db->rowCount();

        $query = 'SELECT * FROM Dislikes WHERE BlogID IN (SELECT BlogID FROM Blogs WHERE UserID = :UserID);';
        $db->query($query);
        $db->bind(':UserID', $UserID);
        $db->execute();
        $countDislikes = $db->rowCount();

        $response['countLikes'] = $countLikes;
        $response['countDislikes'] = $countDislikes;

        echo json_encode($response);

    } catch (Exception $e) {
        $response = array(
            'error' => true,
            'message' => $e->getMessage()
        );
        echo json_encode($response);
    }
}