<?php

namespace app\models;
use app\engine\Db as Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }
    abstract function getTableName();

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function getOne($id){
        var_dump($this->db);
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE id = {$id}";
        return ($this->db)->queryOne($sql); //

    }

    public function getAll(){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return ($this->db)->queryAll($sql);
    }

}