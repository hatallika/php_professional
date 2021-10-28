<?php

namespace app\models;

//Галлерея
class Images extends DBModel
{
    protected $id;
    protected $name;
    protected $size;
    protected $views;

    protected $props = [
        'name' => false,
        'size' => false,
        'views'=> false
    ];


    public function __construct($name = null, $size = null, $views = null)
    {
        $this->name = $name;
        $this->size = $size;
        $this->views = $views;
    }


    public static function getTableName(){
        return 'images';
    }

}