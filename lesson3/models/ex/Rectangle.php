<?php

namespace app\models\ex;

class Rectangle extends Figure
{
    protected $name="прямоугольник";
    public $sideA;
    public $sideB;

    public function __construct($sideA, $sideB){
        $this->sideA = $sideA;
        $this->sideB = $sideB;
    }
    public function getArea()
    {
        return $this->sideA*$this->sideB;
    }

    public function getPerimeter()
    {
        return 2*($this->sideA+$this->sideB);
    }
    public function viewInputData()
    {
        return "Дан {$this->name}: сторона a = {$this->sideA}, сторона b = {$this->sideB}";
    }
    public function view(){
        return ("{$this->viewInputData()}<br>
        Площадь {$this->name}а: {$this->getArea()}<br>
            Периметр {$this->name}а : {$this->getPerimeter()}<br>");
    }
}