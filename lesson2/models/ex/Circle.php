<?php

namespace app\models\ex;

class Circle extends Figure
{
    public $name="круг";
    public $radius;
    public const Pi = 3.14;


    public function __construct($radius){
        $this->radius = $radius;
    }
    public function getArea()
    {
        return static::Pi*pow($this->radius,2);
    }

    public function getPerimeter()
    {
        return 2*static::Pi*($this->radius);
    }
    public function viewInputData()
    {
        return "Дан {$this->name}: радиус = {$this->radius}";
    }
}