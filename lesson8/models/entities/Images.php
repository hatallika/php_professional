<?php

namespace app\models\entities;

//Галлерея
use app\models\Entity;



class Images extends Entity
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

}