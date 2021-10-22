<?php

namespace app\models;
use app\engine\Db as Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{
    public $id;

    abstract function getTableName();

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
        return $this->$name;
    }


    public function getOne($id){

        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE id = :id";
        //return Db::getInstance()->queryOne($sql,['id'=> $id]); //
        return (Db::getInstance()->queryOneObject($sql,['id'=> $id], static::class)); //или get_called_class // вернет объект с данными из базы

    }

    public function getAll(){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert(){

        $tablename = $this->getTableName();
        foreach ($this as $key => $value) {
            if ($key=='id'||$key=='likes'){continue;}
            //var_dump($key . "=>" . $value);
            $params[$key] = $value;
        }
        $sql = "INSERT INTO $tablename";
        $sql .= " (`".implode("`, `", array_keys($params))."`)";
        $sql .= " VALUES (:".implode(", :", array_keys($params)).")";
        Db::getInstance()->execute($sql,$params);
        $this->id = DB::getInstance()->lastInsertId();
        return $this;

        //INSERT INTO products(name, description, price, image) VALUES (:name, :description, :price, :image)

        //params = ['name'=> 'Пицца', ...]

        //Db::getInstance()->execute($sql,$params);
        //$this->id = DB::getInstance()->lastInsertId();
        //return $this для дальнейших цепочек в index
    }

    public function update($id){
        $tablename = $this->getTableName();
        $sql = "UPDATE $tablename SET ";
        //UPDATE `products` SET `name`=[:name],`description`=[:description],... WHERE id = :id
        foreach ($this as $key => $value) {
            if ($key=='id'||$key=='likes'){continue;}
            $params[$key] = $value;
            $sql .= "`$key`=:$key, ";
        }
        $params['id']=$id;
        $sql = substr($sql,0,-2) . " WHERE id = :id";

        return Db::getInstance()->execute($sql,$params); // пока не поняла что именно обновляем ->update(id) или ->update([name=>'...', ...])
        //return $this;
    }

    public function delete(){
        $tablename = $this->getTableName();
        $id = $this->id;
        $sql = "DELETE FROM $tablename WHERE id = :id";
        Db::getInstance()->execute($sql,['id'=> $id]);
    }

}