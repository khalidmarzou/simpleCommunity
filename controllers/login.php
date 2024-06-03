<?php
    session_start();
    
    if(isset($_SESSION["userInfo"])){
        header("Location: /dashboard");
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once dirname(__DIR__) . "/database/connection.php";

        try {
            // check if data is correct :
                $db = new Database();
                $db -> query("SELECT * FROM Users WHERE Email = :email");
                $db -> bind(':email' , $email);
                $user = $db -> single();

                if ($user){

                    $passwordValid = password_verify($password, $user -> Password);

                    if($passwordValid){

                        // get data user and store it in session;
                            if(property_exists($user,'Password')){
                                unset($user -> Password);
                            }

                            
                            $_SESSION['userInfo'] = $user;
                            header("Location: /dashboard");
                            exit();

                    } else {

                        $infoIncorrect = "Email or password Incorrect.";
                        $buttonsHeader = 1;
                        require_once dirname(__DIR__) . "/views/login.view.php";
                        exit();

                    }
                } else {

                        $infoIncorrect = "Email or password Incorrect.";
                        $buttonsHeader = 1;
                        require_once dirname(__DIR__) . "/views/login.view.php";
                        exit();

                }
        } catch (PDOException $e){

                die('Error in Check Email User in data Base' . $e->getMessage());

        }
    }


    $infoIncorrect = '';
    require_once dirname(__DIR__) . "/views/login.view.php";