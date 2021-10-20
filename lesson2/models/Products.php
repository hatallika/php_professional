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

    public function getTableName(){
        return 'products';
    }

}