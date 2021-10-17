<?php

use app\engine\Autoload;
use app\engine\Db;
use app\models\{Products, Users, Feedback, Cart};
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


$db = new Db();
$product = new Products($db);
$user = new Users($db);
$feedback = new Feedback($db);
$cart = new Cart($db);

echo $product->getOne(2);
echo $product->getAll();

echo $user->getOne(1);
echo $user->getAll();

echo $feedback->getOne(2);
echo $feedback->getAll();

echo $cart->getOne(2);
echo $cart->getAll();

var_dump($product);