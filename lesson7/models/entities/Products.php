<?php

namespace app\models\entities;
use app\models\Entity;


class Products extends Entity
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


}