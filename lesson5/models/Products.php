<?php

namespace app\models;


class Products extends DBModel
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $image;
    protected $likes;

    protected $props = [
        'name' => false,
        'description' => false,
        'price'=> false,
        'image' => false,
        'likes' => false
    ];


    function __construct($name = null, $description = null, $price = null, $image = null, $likes = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->likes = $likes;

    }


    public static function getTableName(){
        return 'products';
    }

}