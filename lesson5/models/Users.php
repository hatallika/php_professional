<?php

namespace app\models;

class Users extends DBModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $props = [
       'login' => false,
       'pass' => false,
       'hash' => false
    ];

    public function __construct($login, $pass, $hash)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;

    }


    public static function getTableName(){
        return 'users';
    }

}