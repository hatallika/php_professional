<?php

namespace app\models;
use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    abstract function getTableName();

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function getOne($id){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE id = {$id}";
        return (new Db())->queryOne($sql); //

    }

    public function getAll(){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return (new Db())->queryAll($sql);
    }

}