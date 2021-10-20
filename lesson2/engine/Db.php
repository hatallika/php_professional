<?php

namespace app\engine;
class Db
{
    //WHERE id = 1
    public function queryOne($sql){
        return $sql . "<br>"; //return [];
    }

    //SELECT all
    public function queryAll($sql){
        return $sql . "<br>"; //return [];
    }
}