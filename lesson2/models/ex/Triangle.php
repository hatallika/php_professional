<?php

namespace app\models\ex;

class Triangle extends Figure
{
    public $name="треугольник";
    public $sideA;
    public $sideB;
    public $sideC;

    public function __construct($sideA,$sideB,$sideC){
        $this->sideA = $sideA;
        $this->sideB = $sideB;
        $this->sideC = $sideC;
    }
    public function getArea()
    {
        $p = $this->getPerimeter()/2;
        //вычисление площади по трем сторонам треугольника
        return sqrt($p*($p-$this->sideA)*($p-$this->sideB)*($p-$this->sideC));
    }

    public function getPerimeter()
    {
        return $this->sideA+$this->sideB+$this->sideC;
    }
    public function viewInputData()
    {
        return "Дан {$this->name}: сторона a = {$this->sideA}, сторона b = {$this->sideB}, сторона с = {$this->sideC}";
    }
    public function view(){
        return ("{$this->viewInputData()}<br>
        Площадь {$this->name}а: {$this->getArea()}<br>
            Периметр {$this->name}а : {$this->getPerimeter()}<br>");
    }
}