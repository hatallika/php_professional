<?php

namespace app\traits;
trait TSingleton
{
    private static $instance = null; // храним экземпляр Db (Singleton)

    public static function getInstance(){
        if(is_null(static::$instance)){
            static::$instance = new static(); //new Db
        }
        return static::$instance;
    }
    //Db::getInstance();
    private  function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

}