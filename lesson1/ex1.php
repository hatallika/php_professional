<?php
/*Придумать класс, который описывает любую сущность из предметной области интернет-магазинов:
продукт, ценник, посылка и т.п. или любой другой области. Опишите свойства и методы, придумайте наследника, расширяющего функционал родителя.
Приведите пример использования. ВАЖНОЕ.*/

$productItem = [// данные о товаре которые могут быть переданы из вне
    [
        'id'=>1,
        'name' => 'Чай черный Azercay Buket, 1 кг',
        'description' => 'Чёрный байховый крупнолистовой',
        'image' => 'tea.png',
        'price' => '23.00',
    ],
    [
        'id'=>2,
        'name' => 'Пицца с ветчиной и грибами, 30см',
        'description' => 'Аппетитная пицца с ветчиной, грибами, сыром Чеддер',
        'image' => 'pizza.jpg',
        'price' => '255.00'
    ],
    [
        'id'=>3,
        'name' => 'Кофе Чиббо, 150г',
        'description' => 'Растворимый кофе Чиббо',
        'image' => 'coffee.png',
        'price' => '240.00'
    ],

];

class Product {
    const IMG = 'img/';// директория изображений
    public $id;
    private $name;
    private $description;
    private $image;
    public $price;
    function __construct($id, $name, $description, $image, $price){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }
    function view(){
         return "<div class='product'><h2>$this->name</h2><img width='100' src='" . self::IMG . $this->image ."'>
                <p>$this->description</p><span class='price'>$this->price</span></div>";
    }
}
class Catalog {
    //private $id;
    //public $category;
    public $arrProduct;// массив принимающий данные для формирования объектов продукты
    public $arrCart;

    function __construct($arrProduct){
        $this->arrProduct = $arrProduct;
    }
    function render(){
        $str ='<ul calss="catalog_items clearfix">'."\n";
        foreach ($this->arrProduct as $item) {
            $itemObj = new Product($item['id'], $item['name'], $item['description'], $item['image'], $item['price']);
            $str.= '<li class="catalog_item">'.$itemObj->view() . '
            <button>Добавить в корзину</button></li>'."\n";
        }
        $str.='</ul>';
        return $str;
    }

    function addToCart($id_product)
    {//
        $arr = $this->arrCart;
        // используем такое добавление товара в корзину только для текущего примера
        $this->arrCart[] = $this->arrProduct[$id_product - 1];


    }
    function getCart(){
        $arr = $this->arrCart;
        return new Cart($arr);
    }

}

//Корзина - наследник класса Каталог: здесь переопределим view (другой интерфейс)
// и расширим своими функциями (посчитать количество товаров в корзине, стоимость корзины)
class Cart extends Catalog{

    function render(){
        $str ='<ul class="cart_items clearfix">'."\n";
        foreach ($this->arrProduct as $item) {
            $itemObj = new Product($item['id'], $item['name'], $item['description'], $item['image'], $item['price']);
            $str.= '<li class="cart_item">'.$itemObj->view() . '
            <button>Удалить из корзины</button></li><hr>'."\n";
        }
        $str.='</ul>'."\n";
        return $str;
    }
    function deleteToCart($id_product){}
    function TotalPrice(){}
    function Quantity(){}
}
//Примеры создания объектов если бы принимали сразу объекты
/*$arrProduct[1] = new Product(1,'Чай черный Azercay Buket, 1 кг','Чёрный байховый крупнолистовой',
'tea.jpg', '23.00');
$arrProduct[2] = new Product(2,'Пицца с ветчиной и грибами, 30см','Аппетитная пицца с ветчиной, грибами, сыром Чеддер',
    'pizza.jpg', '255.00');
$arrProduct[3] = new Product(3,'Кофе Чиббо, 150г','Растворимый кофе Чиббо',
    'coffee.jpg', '240.00');*/

$catalog = new Catalog($productItem);
$getCatalog = $catalog->render();
$catalog->addToCart(2);// добавим вручную товар в корзину
$catalog->addToCart(3);// еще товар
$cart = $catalog->getCart();
$getCart= $cart->render();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<h2>Каталог</h2>
<div>
    <?=$getCatalog?>
</div>

<h3>Корзина</h3>
<div>
    <?=$getCart?>
</div>

</body>
</html>


