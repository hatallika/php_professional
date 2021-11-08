<?php

namespace app\models;


abstract class Entity
{

    public function __set($name, $value){
        $this->props[$name] = true;
        $this->$name = $value;
    }


    public function __get($name){
        return $this->$name;
    }

    public function __isset($name) {

        return isset($this->$name);
    }

}