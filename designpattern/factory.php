<?php

interface animals
{
    public function animal();
}

class Cat implements animals
{
    public function animal()
    {
        return 'Cat';
    }
}

class Dog implements animals
{
    public function animal()
    {
        return 'Dog';
    }
}


class Factory
{
    public static function createAnimal($param)
    {
        $result = null;
        switch($param)
        {
            case 'cat':
                $result = new Cat();
                break;
            case 'dog';
                $result = new Dog();
                break;
        }
        return $result;
    }
}

echo Factory::createAnimal('cat')->animal();