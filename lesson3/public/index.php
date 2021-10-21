<?php

use app\engine\Autoload;
use app\engine\Db;
use app\models\{Products, Users, Feedback, Cart};
use app\models\ex\{Rectangle, Circle, Triangle};

include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


/*$product = new Products("Пицца","Описание",125,"pizza.jpg");
$product->insert();
$product->delete();*/

$product = new Products();
var_dump($product->getOne(18));
$product->delete();



var_dump($product);
var_dump(get_class_methods($product));


//var_dump($feedback->getOne(2));
//var_dump($feedback->getAll());



/*$rectangle = new Rectangle(1,2);
echo $rectangle->view();

$circle = new Circle(5);
echo $circle->view();

$triangle = new Triangle(1,2,2);
echo $triangle->view();
*/