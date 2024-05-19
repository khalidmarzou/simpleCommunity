<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "./dataBase/connection.php";

        try {
            // check if user already exest :
                $query = "SELECT * FROM Users WHERE Email = :email";
                $statement = $pdo -> prepare($query);
                $statement -> execute([
                    ':email' => $email,
                ]);
                $user = $statement -> fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e){
                die('Error in Check Email User in data Base' . $e->getMessage());
            }
        
        if(!$user){
           try { 
                $query1 = "INSERT INTO Users (FirstName,LastName,Email,Password) value (:firstName,:lastName,:email,:password)";
                $statement1 = $pdo -> prepare($query1);
                $statement1 -> execute([
                    ':firstName' => $firstName,
                    ':lastName' => $lastName,
                    ':email' => $email,
                    ':password' => $password,
                ]);

                
                // get data user and store it in session;
                session_start();
                $query = "SELECT * FROM Users WHERE Email = :email";
                $statement = $pdo -> prepare($query);
                $statement -> execute([
                    ':email' => $email,
                ]);
                $user = $statement -> fetch(PDO::FETCH_ASSOC);

                $_SESSION['userInfo'] = $user;
                header("Location: /dashboard");
                exit();

            } catch (PDOException $e) {
                die('Error in Insertion data in data base' . $e->getMessage());
            }
        }else{
            $emailExist = 'Email already Exist try to Login.';
            $buttonsHeader = 1;
            require_once "views/register.view.php";
            exit();
        }
    };

    $emailExist = '';
    $buttonsHeader = 1;
    require_once "views/register.view.php";
    exit();