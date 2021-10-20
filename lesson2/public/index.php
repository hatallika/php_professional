<?php
define("DOCUMENT_ROOT", dirname(__DIR__));
use app\engine\Autoload;
use app\engine\Db;
use app\models\{Products, Users, Feedback, Cart};
use app\models\ex\{Rectangle, Circle, Triangle};

include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Products();
$user = new Users();
$feedback = new Feedback();
$cart = new Cart();

$rectangle = new Rectangle(1,2);
echo $rectangle->view();

$circle = new Circle(5);
echo $circle->view();

$triangle = new Triangle(1,2,2);
echo $triangle->view();

echo $product->getOne(2);
echo $product->getAll();

echo $user->getOne(1);
echo $user->getAll();

echo $feedback->getOne(2);
echo $feedback->getAll();

echo $cart->getOne(2);
echo $cart->getAll();

//var_dump($product);