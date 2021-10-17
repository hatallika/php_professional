<?php

namespace app\models;
use app\engine\Db;

abstract class Model
{
    protected $db;
    protected $tableName = '';


    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function getOne($id){
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function getAll(){
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->db->queryAll($sql);
    }

}