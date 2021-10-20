<?php

namespace app\engine;
class Autoload
{
    public function loadClass($className){

        $className= str_replace('\\','/',str_replace('app\\','',$className));
        $filename = DOCUMENT_ROOT . "/{$className}.php";
        if (file_exists($filename)){
            include $filename;
        }
    }
}