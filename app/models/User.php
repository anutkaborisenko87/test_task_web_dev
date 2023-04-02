<?php

namespace TestWebDev\app\models;

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

}