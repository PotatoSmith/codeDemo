<?php

class Single {
    private static $_instance = null;
    public $name = null;

    private function __construct($name)
    {
        $this->name = $name;
    }

    private function __clone()
    {

    }

    public function getInstance($name)
    {
        if (!(self::$_instance instanceof Single)) {
            self::$_instance = new Single($name);
        }
        return self::$_instance;
    }
}

$single = Single::getInstance('Potato');
echo $single->name, PHP_EOL;