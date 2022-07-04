<?php

namespace Tests\Unit\app\Repository;

use App\Repository\JuiceRepository;
use PHPUnit\Framework\TestCase;

class JuiceRepositoryTest extends TestCase
{
    public function testCreateClassicPlusChocolate()
    {
        $ret = $this->getRepo()->filter('Classic', ["+chocolate"]);
        $this->assertEquals([
            "banana",
            "chocolate",
            "honey",
            "ice",
            "mango",
            "peach",
            "pineapple",
            "strawberry",
            "yogurt",
        ], $ret);
    }

    public function testCreateClassicPlusChocolateMinusStrawberry()
    {
        $ret = $this->getRepo()->filter('Classic', ["+chocolate", "-strawberry"]);
        $this->assertEquals([
            "banana",
            "chocolate",
            "honey",
            "ice",
            "mango",
            "peach",
            "pineapple",
            "yogurt",
        ], $ret);
    }

    public function testCreateClassicSmoothie()
    {
        $ret = $this->getRepo()->filter('Classic');
        $this->assertEquals([
            "banana",
            "honey",
            "ice",
            "mango",
            "peach",
            "pineapple",
            "strawberry",
            "yogurt",
        ], $ret);
    }

    public function testCreateClassicMinusStrawberry()
    {
        $ret = $this->getRepo()->filter('Classic', ["-strawberry"]);
        $this->assertEquals([
            "banana",
            "honey",
            "ice",
            "mango",
            "peach",
            "pineapple",
            "yogurt",
        ], $ret);
    }

    public function testCreateJustDessertsSmoothie()
    {
        $ret = $this->getRepo()->filter('Just Desserts');
        $this->assertEquals([
            "banana",
            "cherry",
            "chocolate",
            "ice cream",
            "peanut",
        ], $ret);
    }

    public function testCreateJustDessertsWithoutIceScreamAndPeanut()
    {
        $ret = $this->getRepo()->filter('Just Desserts', ['-ice cream', '-peanut']);
        $this->assertEquals([
            "banana",
            "cherry",
            "chocolate",
        ], $ret);
    }

    public function testCreateJustDessertsWithoutIngredients()
    {
        $ret = $this->getRepo()->filter('Just Desserts', '-banana,-cherry,-chocolate,-ice cream,-peanut');
        $this->assertEquals([], $ret);
    }

    private function getRepo()
    {
        return new JuiceRepository;
    }
}
