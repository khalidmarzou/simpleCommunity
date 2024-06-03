<?php

    require_once dirname(__DIR__ ) . "/database/connection.php";
    require_once dirname(__DIR__) . "/controllers/sendEmail.php";
    require_once dirname(__DIR__) . "/cryptage/cryptage.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = crypt_password( $password );
        $db = new Database();
        $db -> query('UPDATE Users SET Password = :pwd WHERE Email = :email');
        $db -> bind(':email', $email);
        $db -> bind(':pwd', $password);
        $db -> execute();
        sendEmail($email, "You change your passwor on simple community with success");
        header("Location: /login");
        exit();

    }

    require_once dirname(__DIR__) . "/views/forgetPassword.view.php";