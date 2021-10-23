<?php

namespace app\models;

//Галлерея
class Images extends Model
{
    public $id;
    public $name;
    public $size;
    public $views;


    public function __construct($name = null, $size = null)
    {
        $this->name = $name;
        $this->size = $size;
    }


    public function getTableName(){
        return 'images';
    }

}