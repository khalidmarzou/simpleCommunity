<?php

session_start();
require_once dirname(__DIR__) . "/database/connection.php";
$UserID = $_SESSION['userInfo']->UserID;
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rowData = file_get_contents('php://input');
    $data = json_decode($rowData, true);
    $targetFollowID = $data['targetFollow'];
    $action = $data['action'];
    $response = array(
        "status" => 0,
        "countFollowers" => 404,
    );

    try {
        if ($action == 1) {
            $db->query('INSERT INTO Followers (FollowerID, UserID) VALUES (:FollowerID, :UserID);');
            $db->bind(':FollowerID', $UserID);
            $db->bind(':UserID', $targetFollowID);
            $db->execute();
        } else {
            $db->query('DELETE FROM Followers WHERE FollowerID = :FollowerID AND UserID = :UserID;');
            $db->bind(':FollowerID', $UserID);
            $db->bind(':UserID', $targetFollowID);
            $db->execute();
        }

        $db -> query('SELECT * FROM Followers WHERE UserID = :UserID;');
        $db -> bind(':UserID', $targetFollowID);
        $db -> execute();

        $response['countFollowers'] = $db -> rowCount();
        $response['status'] = 1;
    } catch (Exception $e) {
        error_log('Error in follow/unfollow action: ' . $e->getMessage());
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
