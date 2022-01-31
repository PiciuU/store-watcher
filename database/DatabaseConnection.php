<?php

namespace Database;

use PDO;

class DatabaseConnection {
    private $host;
    private $port;
    private $login;
    private $pass;
    private $db_name;

    private $pdo;
    private $connected = false;

    private $err_msg;
    private $lastInsertId;

    public function __construct() {
        $this->host = MYSQL_HOST;
        $this->port = MYSQL_PORT;
        $this->login = MYSQL_LOGIN;
        $this->pass = MYSQL_PASS;
        $this->db_name = MYSQL_DB;

        $this->connect();
    }

    public function connect() {
        try {
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name.';port='.$this->port.';charset=utf8', $this->login, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
            return true;
        } catch(PDOException $e) {
            $this->err_msg = $e->getMessage();
            return false;
        }
    }

    public function getErrMsg() {
        return $this->err_msg;
    }

    public function getLastInsertId() {
        return $this->lastInsertId;
    }

    public function execute($query, $params = null) {
        $number = 0;

        try {
            if ($params) {
                $stmt = $this->pdo->prepare($query);

                foreach ($params as $param) {
                    $stmt->bindValue(':'.$param[0], $param[1], $param[2]);
                }

                $number = $stmt->execute();
            } else {
                $number = $this->pdo->exec($query);
            }

            $this->lastInsertId = $this->pdo->lastInsertId();
        } catch(PDOException $e) {
            $this->err_msg = $e->getMessage();
            print_r($e->getMessage());
            return false;
        }

        if ($number > 0) return $number;
        else return 0;
    }

    public function fetch($query, $params = null, $object = false) {
        $result = null;

        try {
            if ($params) {
                $stmt = $this->pdo->prepare($query);

                foreach ($params as $param) {
                    $stmt->bindValue(':'.$param[0], $param[1], $param[2]);
                }

                $stmt->execute();

                if ($object) $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                else $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt->closeCursor();
            } else {
                $stmt = $this->pdo->query($query);

                if ($object) $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                else $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt->closeCursor();
            }
        } catch(\PDOException $e) {
            $this->err_msg = $e->getMessage();
            return false;
        }

        return $result;
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollback() {
        return $this->pdo->rollback();
    }
}