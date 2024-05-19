<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "./dataBase/connection.php";

        try {
            // check if data is correct :
                $query = "SELECT * FROM Users WHERE Email = :email AND Password = :password";
                $statement = $pdo -> prepare($query);
                $statement -> execute([
                    ':email' => $email,
                    ':password' => $password,
                ]);
                $user = $statement -> fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
                die('Error in Check Email User in data Base' . $e->getMessage());
        }
        if($user){
            // get data user and store it in session;
                session_start();
                $_SESSION['userInfo'] = $user;
                header("Location: /dashboard");
                exit();
        }else{
            $infoIncorrect = "Email or password Incorrect.";
            $buttonsHeader = 1;
            require_once "views/login.view.php";
            exit();
        }
    }


    $infoIncorrect = '';
    $buttonsHeader = 2;
    require_once "views/login.view.php";