<?php
session_start();

use app\engine\App;

require_once '../vendor/autoload.php';

$config = include "../config/config.php";

try {
    App::call()->run($config);


} catch (\PDOException $e){
    var_dump($e->getMessage());
} catch (\Exception $e){
    echo $e->getMessage();
}