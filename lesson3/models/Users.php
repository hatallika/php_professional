<?php

namespace app\models;

class Users extends Model
{
    public $id;
    public $login;
    public $pass;
    public $hash;

    public function __construct($login, $pass, $hash)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }


    public function getTableName(){
        return 'users';
    }

}