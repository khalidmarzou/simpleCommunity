<?php

    $dsn = "mysql:host=localhost;port=3306;dbname=simpleComminuty;charset=utf8";

    try{

        $pdo = new PDO($dsn, 'root', 'khalid0000');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }