<?php
namespace app\models\ex;
abstract class Figure
{
    protected $name;

    abstract public function getArea();
    abstract public function getPerimeter();
    abstract public function viewInputData();
    abstract public function view();
}