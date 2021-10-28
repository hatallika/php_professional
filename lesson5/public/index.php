<?php

use app\engine\Autoload;
use app\models\{Products, Users, Feedback, Cart, Images};


include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?? 'product';
$actionName = $_GET['a']; //определение по умолчанию в другом месте
$controllerClass = CONTROLLER_NAMESPACE .ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
    $controller = new $controllerClass;
    $controller->runAction($actionName);


} else {
    Die("404");
}













die();
/** @var  Products $product */

$product2 = Products::getOne(4);
$product2->name = "Пицца";
$product2->price = 77;
$product2->save();
var_dump($product2);

$product = new Products("Пицца","Вкусная!",325,"pizza.jpg", 0);
var_dump($product);
$product->save();


//$product = Products::getOne(11);
//$product->delete();
//
//var_dump($product);
//var_dump(get_class_methods($product));









/*$product = new Products("Чай", "Описание", 33, "tea.jpg", 0);
$product->insert();
$product->insert();
$product->delete();

*/







//var_dump($product);
//var_dump(get_class_methods($product));

//$feedback = new Feedback();
//var_dump($feedback->getOne(2));
//var_dump($feedback->getAll());
