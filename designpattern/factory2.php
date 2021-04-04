<?php
// 工厂方法
abstract class animals
{
    abstract public function animal();
}

class Cat extends animals
{
    public function animal()
    {
        return 'Cat';
    }
}

class Dog extends animals
{
    public function animal()
    {
        return 'Dog';
    }
}

interface Factory
{
    public function create();
}

class CatFactory implements Factory
{
    public function create()
    {
        return new Cat();
    }
}

class DogFactory implements Factory
{
    public function create()
    {
        return new Dog();
    }
}

class Client
{
    public function test()
    {
        $catResult = new CatFactory();
        echo $catResult->create()->animal(), PHP_EOL;

        $dogResult = new DogFactory();
        echo $dogResult->create()->animal(), PHP_EOL;
    }
}

$a = new Client();
$a->test();