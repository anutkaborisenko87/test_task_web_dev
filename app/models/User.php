<?php

namespace TestWebDev\app\models;

use TestWebDev\src\DB\QueryBuilder;
use TestWebDev\src\Model;

class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'last_name',
        'position_id',
    ];

    public function withPositions()
    {
        return (new QueryBuilder())
            ->table($this->table)
            ->select("$this->table.id, $this->table.name, $this->table.last_name, positions.id AS position_id, positions.title AS position_title")
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->get();
    }

}