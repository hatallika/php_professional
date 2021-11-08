<?php

namespace app\engine;

class Storage
{
    protected $items = [];// ['Session' => new Session()]

    /*
    public function set($key, $obj) {
        $this->items[$key] = $obj;
    }
    */

    public function get($key){
        if(!isset($this->items[$key])) { // key  - имя компонента Session Request
            $this->items[$key] = App::call()->createComponent($key);
        }
        return $this->items[$key];
    }


}