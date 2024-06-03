<?php

    function crypt_password($password) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        return $hashedPassword;
    }

    function verify_crypting($password, $hashedPassword) {

        return password_verify($password, $hashedPassword);
    }
