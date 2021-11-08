<?php

use \PHPUnit\Framework\TestCase;

class ShopTest extends TestCase

{
    public function testAdd(){
        $x = 1;
        $y = 2;
        $this->assertEquals(3, $x + $y); // сравнение значений (ожидаемое, вызов функции)
    }

    public function testMult(){
        $x = 3;
        $y = 2;
        $this->assertEquals(6, $x * $y); // сравнение значений (ожидаемое, вызов функции)
    }
}