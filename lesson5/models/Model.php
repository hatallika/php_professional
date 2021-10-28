<?php

namespace app\models;
use app\interfaces\IModel;

abstract class Model implements IModel
{

    public function __set($name, $value){
        $this->props[$name] = true;
        $this->$name = $value;
        //var_dump($this->props);
    }


    public function __get($name){
        return $this->$name;
    }

}