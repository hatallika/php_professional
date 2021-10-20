<?php

namespace app\models\ex;

class Circle extends Figure
{
    public $name="круг";
    public $radius;
    const PI = 3.14;


    public function __construct($radius){
        $this->radius = $radius;
    }
    public function getArea()
    {
        return static::PI*pow($this->radius,2);
    }

    public function getPerimeter()
    {
        return 2*static::PI*($this->radius);
    }
    public function viewInputData()
    {
        return "Дан {$this->name}: радиус = {$this->radius}";
    }
    public function view(){
        return ("{$this->viewInputData()}<br>
        Площадь {$this->name}а: {$this->getArea()}<br>
            Длинна окружности {$this->name}а: {$this->getPerimeter()}<br>");
    }
}