<?php

namespace Database;

class QueryBuilder
{
    const PARAM_INT = 1;
    const PARAM_STR = 2;

    private $db = null;

    private $params = array();

    private $query = null;


    public function params(array ...$params) {
        $this->params = $params;
        return $this;
    }

    public function query(string $query) {
        $this->query = $query;
        return $this;
    }

    public function fetch($fetchAsObject = false) {
        $db = new DatabaseConnection();
        $db_result = $db->fetch($this->query, $this->params, $fetchAsObject);

        if ($db_result === false) {
            echo "Błąd fetch: ".$db->getErrMsg();
        }

        return $db_result;
    }

    public function execute() {
        $db = new DatabaseConnection();
        $db_result = $db->execute($this->query, $this->params);

        if ($db_result === false) {
            echo "Błąd execute: ".$db->getErrMsg();
        }

        return $db_result;
    }
}
