<?php

namespace TestWebDev\src\DB;

use PDO;

class QueryBuilder extends DataBase
{
    /**
     * @var string
     */
    protected $table;
    /**
     * @var string
     */
    protected $select = '*';
    /**
     * @var array
     */
    protected $where = [];
    /**
     * @var array
     */
    protected $bindParams = [];
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var array
     */
    protected $join = [];


    /**
     * @param $columns
     * @return $this
     */

    public function select($columns = '*'): self
    {
        $this->select = $columns;

        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return $this
     */

    public function where($column, $operator, $value): QueryBuilder
    {
        $this->where[] = ["column" => $column, "operator" => $operator, "value" => $value];

        return $this;
    }

    /**
     * @param $column
     * @return array|false
     */
    public function whereNull($column)
    {
        $query = "SELECT {$this->select} FROM {$this->table}";
        $query .= ' WHERE ' . $column . ' is NULL';
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array|false
     */

    public function get()
    {
        $query = "SELECT {$this->select} FROM {$this->table}";

        $joinClause = $this->buildJoinClause();
        if (!empty($joinClause)) {
            $query .= $joinClause;
        }

        if (!empty($this->where)) {
            $query .= ' WHERE ' . implode(" AND ", array_map(function ($where) {
                    return "{$where['column']} {$where['operator']} ?";
                }, $this->where));
            $this->bindParams = array_column($this->where, 'value');
        }
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute($this->bindParams);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table
     * @return $this
     */

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param $data
     * @return false|string
     */

    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $values = array_values($data);
        $this->query($query, $values);
        return $this->lastInsertId();
    }

    public function lastInsertId()
    {
        return $this->getPdo()->lastInsertId();
    }

    /**
     * @param $data
     * @return int
     */
    public function update($data): int
    {
        $query = "UPDATE {$this->table} SET ";
        $values = [];

        foreach ($data as $column => $value) {
            $query .= "{$column} = ?, ";
            $values[] = $value;
        }
        $query = rtrim($query, ', ');

        if (!empty($this->where)) {
            $query .= " WHERE ";
            foreach ($this->where as $i => $where) {
                $operator = $i == 0 ? "" : "AND";
                $query .= "{$operator} {$where['column']} {$where['operator']} ?";
                $values[] = $where['value'];
            }
        }
        return $this->query($query, $values)->rowCount();
    }

    /**
     * @return int
     */
    public function delete(): int
    {
        $query = "DELETE FROM {$this->table}";
        if (!empty($this->where)) {
            $query .= " WHERE ";
            $values = [];
            foreach ($this->where as $i => $where) {
                $operator = $i == 0 ? "" : "AND";
                $query .= "{$operator} {$where['column']} {$where['operator']} ?";
                $values[] = $where['value'];
            }
            return $this->query($query, $values)->rowCount();
        }
        return 0;
    }

    /**
     * @param string $table
     * @param string $firstColumn
     * @param string $operator
     * @param string $secondColumn
     * @return $this
     */
    public function join(string $table, string $firstColumn, string $operator, string $secondColumn): self
    {
        $this->join[] = ["type" => "LEFT JOIN", "table" => $table, "first_column" => $firstColumn, "operator" => $operator, "second_column" => $secondColumn];
        return $this;
    }
    /**
     * @return string
     */
    protected function buildJoinClause(): string
    {
        $joinClause = '';
        foreach ($this->join as $join) {
            $joinClause .= " {$join['type']} {$join['table']} ON {$join['first_column']} {$join['operator']} {$join['second_column']}";
        }
        return $joinClause;
    }
}