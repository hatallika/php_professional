<?php

namespace app\models;
use app\engine\Db;

abstract class DBModel extends Model
{
    abstract static function getTableName();
    public $id;

    public function insert(){
        $params =[];
        $columns=[];

        $tablename = static::getTableName();

        foreach ($this->props as $key => $value) {
            if ($key=='id'){continue;}
            $params[$key] = $this->$key;
        }
        var_dump($params);
        $columns = " (`".implode("`, `", array_keys($params))."`)";
        $values = "(:".implode(", :", array_keys($params)).")";

        $sql = "INSERT INTO {$tablename} {$columns} VALUES {$values}";

        Db::getInstance()->execute($sql,$params);
        $this->id = DB::getInstance()->lastInsertId();
        return $this; //для дальнейших цепочек в index

        //INSERT INTO products(name, description, price, image) VALUES (:name, :description, :price, :image)
        //params = ['name'=> 'Пицца', ...]
    }

    public function update(){
        $tablename = static::getTableName();
        $sql = "";

        //UPDATE `products` SET `name`=[:name],`description`=[:description],... WHERE id = :id
        foreach ($this->props as $key => $value) {

            if (!($value)){continue;}
            $params[$key] = $this->$key;
            $sql .= "`$key`=:$key, ";
        }
        $params['id']=$this->id;
        $sql = "UPDATE $tablename SET " . substr($sql,0,-2) . " WHERE id = :id";
        Db::getInstance()->execute($sql,$params);
        return $this;
    }

    public function save(){
        return (is_null($this->id)) ? $this->insert() : $this->update();
    }

    public function delete(){
        $tablename = static::getTableName();
        $sql = "DELETE FROM $tablename WHERE id = :id";
        return Db::getInstance()->execute($sql,['id'=> $this->id]);
    }

    public static function getOne($id){
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE id = :id";
        //return Db::getInstance()->queryOne($sql,['id'=> $id]);
        return (Db::getInstance()->queryOneObject($sql,['id'=> $id], static::class)); //или get_called_class // вернет объект с данными из базы
    }

    public static function getAll(){
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($limit){

        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename} LIMIT ?,  ?";
        return Db::getInstance()->queryLimit($sql, $limit);
    }

    public static function getCount(){
        $tablename = static::getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return Db::getInstance()->execute($sql);
    }



}