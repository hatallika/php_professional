<?php

namespace app\engine;
class Autoload
{
    public function loadClass($className){

        $className= str_replace('\\','/',str_replace('app\\','',$className));
            $filename = "../{$className}.php";
            include $filename;
    }
}