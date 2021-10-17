<?php

namespace app\models;

class Users extends Model
{
    public $id;
    public $login;
    public $pass;
    public $hash;

    protected $tableName = 'users';

}