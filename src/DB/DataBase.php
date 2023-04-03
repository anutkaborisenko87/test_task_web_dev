<?php

namespace TestWebDev\src\DB;

use PDO;
use PDOStatement;

class DataBase extends Connection
{
    /**
     * @var PDO
     */
    protected $pdo;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->getPdo();
    }

    /**
     * @param string $sql
     * @param array $params
     * @return false|PDOStatement
     */
    public function query(string $sql, array $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function tableExists($table): bool
    {
        $result = $this->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = '$table'");
        return $result->fetchColumn() == 1;
    }
}