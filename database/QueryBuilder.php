<?php

namespace Database;

class QueryBuilder extends QueryRaw
{
    private static $instance;
    private static $table = null;

    private $fields = ['*'];
    private $conditions = [];
    private $limit = null;

    public static function instance() {
        if (!self::$instance) {
            self::$table = static::$table;
            self::$instance = new QueryBuilder();
        }
        return self::$instance;
    }

    public function select(array $fields = ['*']) {
        $this->fields = $fields;
        return $this;
    }

    public function where($arg0, $arg1, $arg2 = null) {
        $condition = (object)[
            'field' => $arg0,
            'operator' => $arg2 === null ? '=' : $arg1,
            'value' => $arg2 === null ? $arg1 : $arg2
        ];
        self::createParamFromCondition($condition);
        array_push($this->conditions, "$condition->field $condition->operator :$condition->field");
        return $this;
    }

    public function first(int $limit) {
        if ($limit > 0) $this->limit = $limit;
        return $this;
    }

    public function get($fetchAsObject = false) {
        $where = $this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $this->conditions);
        $this->query = 'SELECT ' . implode(', ', $this->fields)
            . ' FROM ' . self::$table
            . $where;

        if ($this->limit) $this->query .= ' LIMIT '.$this->limit;
        return self::fetch($fetchAsObject);
    }

    public function createParamFromCondition($condition) {
        array_push($this->params,
            array($condition->field, $condition->value, is_numeric($condition->value) ? self::PARAM_INT : self::PARAM_STR)
        );
    }

}
