<?php

interface AnimalFactory
{
    public function createCat();
    public function createDog();
}

abstract class Cat
{
    abstract public function getCat();
}

class ForeignCat extends Cat
{
    public function getCat()
    {
        return "外国布偶猫".PHP_EOL;
    }
}

class ChineseCat extends Cat
{
    public function getCat()
    {
        return "华夏猫".PHP_EOL;
    }
}

abstract class Dog
{
    abstract public function getDog();
}

class ForeignDog extends Dog
{
    public function getDog()
    {
        return "外国哈士奇".PHP_EOL;
    }
}

class ChineseDog extends Dog
{
    public function getDog()
    {
        return "中华田园犬".PHP_EOL;
    }
}

class CreateChineseAnimalFactory implements AnimalFactory
{
    public function createCat()
    {
        return new ChineseCat();
    }
    public function createDog()
    {
        return new ChineseDog();
    }
}

class CreateForeignAnimalFactory implements AnimalFactory
{
    public function createCat()
    {
        return new ForeignCat();
    }
    public function createDog()
    {
        return new ForeignDog();
    }
}

$result = new CreateChineseAnimalFactory();
$ForeignCat = $result->createCat();
echo $ForeignCat->getCat();

$ForeignDog = $result->createDog();
echo $ForeignDog->getDog();