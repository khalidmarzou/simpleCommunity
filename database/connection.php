<?php

class Database {
    private $host = 'localhost';
    private $dbName = 'sm_community';
    private $username = 'root';
    private $password = 'khalid0000';
    private $pdo;
    private $error;
    private $stmt;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $options = [
            PDO::ATTR_PERSISTENT => true, // to keep the connection open after we use db
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // for handling errors
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql) {
        $this->stmt = $this->pdo->prepare($sql);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    // Transaction functions
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function endTransaction() {
        return $this->pdo->commit();
    }

    public function cancelTransaction() {
        return $this->pdo->rollBack();
    }
}
