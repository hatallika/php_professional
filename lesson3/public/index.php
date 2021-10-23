<?php

use app\engine\Autoload;
use app\models\{Products, Users, Feedback, Cart};


include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


/*$product = new Products("Чай", "Описание", 33, "tea.jpg", 0);
$product->insert();
$product->insert();
$product->delete();

*/
/*$product2 = new Products();
var_dump($product2->getOne(3));
($product2->getOne(3))->delete(); // возвращает экземпляр Product и удаляет по его данным из БД*/

//UPDATE
$product3 = new Products("Пицца!","Вкусная",125,"pizza.jpg", 0);
$product3->insert();
$product3->name = "Вкусная пицца";
$product3->update();



//var_dump($product);
//var_dump(get_class_methods($product));

//$feedback = new Feedback();
//var_dump($feedback->getOne(2));
//var_dump($feedback->getAll());
