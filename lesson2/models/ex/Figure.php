<?php
namespace app\models\ex;
abstract class Figure
{
    protected $name;

    abstract public function getArea();
    abstract public function getPerimeter();
    abstract public function viewInputData();
    public function view(){
    return ("{$this->viewInputData()}<br>
        Площадь {$this->name}а: {$this->getArea()}<br>" .
        (($this->name == 'круг')?"Длинна окружности": "Периметр {$this->name}а") .": {$this->getPerimeter()}<br>");
    }
}