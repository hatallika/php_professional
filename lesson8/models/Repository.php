<?php

namespace app\models;
use app\engine\Db;
use app\models\entities\Feedback;
use app\engine\App;


abstract class Repository
{
    //protected $id;
    abstract protected function getTableName();
    abstract protected function getEntityClass();

    public function insert(Entity $entity){
        $params =[];
        $columns=[];

        $tablename = $this->getTableName();

        foreach ($entity->props as $key => $value) {
            $params[$key] = $entity->$key;
        }

        $columns = " (`".implode("`, `", array_keys($params))."`)";
        $values = "(:".implode(", :", array_keys($params)).")";

        $sql = "INSERT INTO {$tablename} {$columns} VALUES {$values}";

        App::call()->db->execute($sql,$params);
        $entity->id = App::call()->db->lastInsertId();
        return $this; //для дальнейших цепочек в index

        //INSERT INTO products(name, description, price, image) VALUES (:name, :description, :price, :image)
        //params = ['name'=> 'Пицца', ...]
    }

    public function update(Entity $entity){
        $params = [];
        $columns = [];

        //UPDATE `products` SET `name`=[:name],`description`=[:description],... WHERE id = :id
        foreach ($entity->props as $key => $value) {

            if (!$value){continue;}
            $params[$key] = $entity->$key;
            $columns[] .= "`$key`=:$key";
            $entity->props[$key] = false;
        }
        $columns = implode(", ",$columns);
        $params['id']=$entity->id;
        $tablename = $this->getTableName();

        $sql = "UPDATE {$tablename} SET {$columns} WHERE id = :id";

        App::call()->db->execute($sql,$params);
        return $this;
    }

    public function save(Entity $entity){
        return (is_null($entity->id)) ? $this->insert($entity) : $this->update($entity);
    }

    public function delete(Entity $entity){
        $tablename = $this->getTableName();
        $sql = "DELETE FROM $tablename WHERE id = :id";
        return App::call()->db->execute($sql,['id'=> $entity->id]);
    }

    public function deleteWhere(Entity $entity, $name, $value){
        $tablename = $this->getTableName();
        $sql = "DELETE FROM $tablename WHERE {$name} = :{$name} AND id = :id ";

        return App::call()->db->execute($sql,[$name => $value, 'id' => $entity->id]);
    }


    public function getOne($id){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE id = :id";
        //return Db::getInstance()->queryOne($sql,['id'=> $id]);
        return (App::call()->db->queryOneObject($sql,['id'=> $id], $this->getEntityClass())); //или get_called_class // вернет объект с данными из базы
    }

    public function getOneWhere($nameColumn, $value){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE {$nameColumn} = :{$nameColumn}";
        return (App::call()->db->queryOneObject($sql,[$nameColumn => $value], $this->getEntityClass())); //или get_called_class // вернет объект с данными из базы
    }


    public function getAll(){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return App::call()->db->queryAll($sql);
    }

    public function getAllWhere($nameColumn, $value){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} WHERE {$nameColumn} = :{$nameColumn}";
        return App::call()->db->queryAll($sql, [$nameColumn => $value]);
    }

    public function getLimit($limit){

        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename} LIMIT ?,  ?";
        return App::call()->db->queryLimit($sql, $limit);
    }

    public function getCount(){
        $tablename = $this->getTableName();
        $sql = "SELECT * FROM {$tablename}";
        return App::call()->db->execute($sql);
    }

    //WHERE session_id = '111' return 5
    public function getCountWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function getSumColumn($name_column,$session_id){
        $tablename = $this->getTableName();
        $sql = "SELECT SUM($name_column) as count FROM $tablename WHERE session_id = :session_id";
        return App::call()->db->queryOne($sql,['session_id' => $session_id])['count'];
    }

    public function getLastInsertId(){
        return App::call()->db->lastInsertId();
    }




}