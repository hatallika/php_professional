<?php

use app\models\entities\Products;
use app\models\repositories\ProductRepository;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    protected $fixture;

    protected function setUp(): void
    {
        $this->fixture = new Products("Чай", "Описание", 200, "22.jpg", 0);
    }

    protected function tearDown(): void
    {
        $this->fixture = NULL;
    }

    public function testProduct(){
        $name = "Чай";
        $product = new Products($name);
        $this->assertEquals($name, $product->name); //тестируем так же магический getter
    }

    /**
     * @dataProvider providerConstructorProducts
     */

    public function testConstructorProducts($a, $b){

        $this->assertEquals($b, $this->fixture->$a);
    }

    public function providerConstructorProducts()
    {
        return  [
            ['name', "Чай"],
            ['description', "Описание"],
            ['price', 200],
            ['image', "22.jpg"],
            ['likes', 0]
        ];
    }

    // проверка proops значения массива при создании продукта в конструкторе на false
    /**
     * @dataProvider providerTestProps
     */
    public function testProps($a){

        $this->assertFalse($this->fixture->props[$a]);
    }


    public function providerTestProps()
    {
        return  [
            ['name'],
            ['description'],
            ['price'],
            ['image'],
            ['likes'],
        ];
    }

    // Проверка props setter на true
    public function testPropsSave(){

        $product = (new ProductRepository())->getOne(1);
        $product->name = "Пицца";
        $this->assertTrue($product->props['name']);
    }
}



