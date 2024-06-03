<?php

    session_start();
        
    if(isset($_SESSION["userInfo"])){
        header("Location: /dashboard");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // cryptage password :
        require_once dirname(__DIR__) . "/cryptage/cryptage.php";
        $password = crypt_password($password);

        require_once dirname(__DIR__) . "/database/connection.php";

        try {
            // check if user already exest :
                $db = new Database();
                $db -> query("SELECT * FROM Users WHERE Email = :email");
                $db -> bind(':email' , $email);
                $db -> execute();
                $user = $db -> single();

            } catch (PDOException $e){
                die('Error in Check Email User in data Base' . $e->getMessage());
            }
        
        if(!$user){
           try { 
                $db -> query("INSERT INTO Users (LastName,FirstName,Email,Password) value (:lastName,:firstName,:email,:password)");
                
                $db -> bind(':lastName', $lastName);
                $db -> bind(':firstName', $firstName);
                $db -> bind(':email', $email);
                $db -> bind(':password', $password);
                $db -> execute();

                
                
                if (!empty($_FILES["profile"]))    {
                    $profile_pic = $_FILES["profile"]["name"];
                    $profile_temp_path = $_FILES["profile"]["tmp_name"];
                    $profile_target_path = dirname(__DIR__) . "/images/profiles/" . basename($profile_pic);
                    $picData = "/images/profiles/" . basename($profile_pic);
                    move_uploaded_file($profile_temp_path, $profile_target_path);

                    $db -> query("UPDATE Users SET Profile = :profile WHERE Email = :email");
                    $db -> bind(':email', $email);
                    $db -> bind(':profile', $picData);
                    $db -> execute();
                }

                require_once dirname(__DIR__) . "/controllers/sendEmail.php";
                sendEmail($email, "Welcome $firstName to Simple Community, Write Freely in Our Community and Enjoy With Others Blogs.\n\nFor any Question : www.github.com/khalidmarzou\n\nSimple_Community.");
                header("Location: /login");
                exit();

            } catch (PDOException $e) {

                die('Error in Insertion data in data base' . $e->getMessage());

            }
        }else{

            $emailExist = 'Email already Exist try to Login.';
            $buttonsHeader = 1;
            require_once dirname(__DIR__) . "/views/register.view.php";
            exit();

        }
    };

    $emailExist = '';
    require_once dirname(__DIR__) . "/views/register.view.php";
    exit();