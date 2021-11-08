<?php

use PHPUnit\Framework\TestCase;

class MathClass{
    public function factorial($n){
        if ($n == 0)
            return 1;
        else
            return $n * $this->factorial($n - 1);
    }
}


class MathClassTest extends TestCase
{
    protected $fixture;

    protected function setUp(): void
    {
        $this->fixture = new MathClass();
    }

    protected function tearDown(): void
    {
        $this->fixture = NULL;
    }

    /**
     * @dataProvider providerFactorial
     */

    public function testFactorial($a,$b)
    {


        $this->assertEquals($b, $this->fixture->factorial($a));
    }

    public function providerFactorial()
    {
        return array (
            array(0,1),
            array(2,2),
            array(5,120)
        );
    }
}

