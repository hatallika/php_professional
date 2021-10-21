<?php

namespace app\models;

class Products extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $likes;


    public function __construct($name = null, $description = null, $price = null, $image = null, $likes = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->likes = $likes;

    }


    public function getTableName(){
        return 'products';
    }

}