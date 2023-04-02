<?php

namespace TestWebDev\app\models;

use TestWebDev\src\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
    ];
}