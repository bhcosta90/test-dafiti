<?php

namespace Tests\Unit;

use App\Repository\CategoryRepository;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{
    public function testCreateClassicPlusChocolate()
    {
        $ret = $this->getRepo()->filter('Classic', ["+chocolate"]);
        $this->assertEquals([
            "strawberry",
            "banana",
            "pineapple",
            "mango",
            "peach",
            "honey",
            "ice",
            "yogurt",
            "chocolate"
        ], $ret);
    }

    public function testCreateClassicPlusChocolateMinusStrawberry()
    {
        $ret = $this->getRepo()->filter('Classic', ["+chocolate", "-strawberry"]);
        $this->assertEquals([
            "banana",
            "pineapple",
            "mango",
            "peach",
            "honey",
            "ice",
            "yogurt",
            "chocolate"
        ], $ret);
    }

    public function testCreateClassicSmoothie()
    {
        $ret = $this->getRepo()->filter('Classic');
        $this->assertEquals([
            "strawberry",
            "banana",
            "pineapple",
            "mango",
            "peach",
            "honey",
            "ice",
            "yogurt"
        ], $ret);
    }

    public function testCreateClassicMinusStrawberry()
    {
        $ret = $this->getRepo()->filter('Classic', ["-strawberry"]);
        $this->assertEquals([
            "banana",
            "pineapple",
            "mango",
            "peach",
            "honey",
            "ice",
            "yogurt"
        ], $ret);
    }

    public function testCreateJustDessertsSmoothie()
    {
        $ret = $this->getRepo()->filter('Just Desserts');
        $this->assertEquals([
            "banana",
            "ice cream",
            "chocolate",
            "peanut",
            "cherry"
        ], $ret);
    }

    public function testCreateJustDessertsWithoutIceScreamAndPeanut()
    {
        $ret = $this->getRepo()->filter('Just Desserts', ['-ice cream', '-peanut']);
        $this->assertEquals([
            "banana",
            "chocolate",
            "cherry"
        ], $ret);
    }

    public function testCreateJustDessertsWithoutIngredients()
    {
        $ret = $this->getRepo()->filter('Just Desserts', '-banana,-cherry,-chocolate,-ice cream,-peanut');
        $this->assertEquals([], $ret);
    }

    private function getRepo()
    {
        return new CategoryRepository;
    }
}
