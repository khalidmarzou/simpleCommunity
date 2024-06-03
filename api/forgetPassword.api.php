<?php

    require_once dirname(__DIR__) . "/database/connection.php";
    require_once dirname(__DIR__) . "/controllers/sendEmail.php";

    $db = new Database();
    function generateRandomCode() {
        $randomNumber = mt_rand(100000, 999999);
        
        return $randomNumber;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        if($data) {
            if($data["count"] == 0) {
                $email = $data["email"];
                $db -> query("SELECT * FROM Users WHERE Email = :email");
                $db -> bind(":email", $email);
                $db -> execute();
                $user = $db -> single();
                if ($db -> rowCount() > 0) {
                    $code = generateRandomCode();
                    $db -> query("INSERT INTO ForgetPassword (UserID, Code) VALUES (:UserID, :Code)");
                    $db -> bind(":UserID", $user -> UserID);
                    $db -> bind(":Code", $code);
                    $db -> execute();
                    sendEmail($user -> Email, "This Code For change Your Password on Simple Community : $code, keep it secret !!");

                    $response = array("status"=> 1, "message"=> "Valid Email", "email"=> $email);

                } else {

                    $response = array("status"=> 0,"message"=> "No valid Email", "email"=> $email);
                    
                }

                $response = json_encode($response);
                echo $response;

            } else if ($data["count"] == 1) {
                $email = $data["email"];
                $db -> query("SELECT * FROM Users NATURAL JOIN ForgetPassword WHERE Email = :email");
                $db -> bind(":email", $email);
                $db -> execute();
                $user = $db -> single();

                if ($user -> Code == $data["code"]){
                    $db -> query("DELETE FROM ForgetPassword WHERE UserID = :id");
                    $db -> bind(":id", $user -> UserID);
                    $db -> execute();
                    $response = array("status"=> 1);
                   
                } else {
                    $response = array("status"=> 0);
                }

                $response = json_encode($response);
                echo $response;
            }
        }
    }