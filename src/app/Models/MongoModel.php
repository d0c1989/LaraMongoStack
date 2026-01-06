<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

abstract class MongoModel extends Model
{
    protected $connection = 'mongodb';

    protected $keyType = 'string';
    public $incrementing = false;
}
