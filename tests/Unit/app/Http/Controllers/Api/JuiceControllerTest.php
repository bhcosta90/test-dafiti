<?php

namespace Tests\Unit\app\Http\Controllers\Api;

use App\Http\Controllers\Api\JuiceController;
use App\Http\Requests\JuiceRequest;
use App\Repository\Exceptions\JuiceException;
use App\Repository\JuiceRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class JuiceControllerTest extends TestCase
{
    public function testCreateClassicPlusChocolate()
    {
        $ret = $this->controllerAndReturnResource('Classic', ["+chocolate"]);
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
        $ret = $this->controllerAndReturnResource('Classic', ["+chocolate", "-strawberry"]);
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
        $ret = $this->controllerAndReturnResource('Classic');
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
        $ret = $this->controllerAndReturnResource('Classic', ["-strawberry"]);
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
        $ret = $this->controllerAndReturnResource('Just Desserts');
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
        $ret = $this->controllerAndReturnResource('Just Desserts', ['-ice cream', '-peanut']);
        $this->assertEquals([
            "banana",
            "cherry",
            "chocolate",
        ], $ret);
    }

    public function testNotFoundJuice()
    {
        $this->expectException(JuiceException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('test not found');
        $this->controllerAndReturnResource('test');
    }

    private function controllerAndReturnResource(string $juice, array|string|null $filter = null)
    {
        $controller = new JuiceController();
        return $controller->index(
            request: $this->mockRequest($juice, $filter),
            juice: $juice,
            juiceRepository: new JuiceRepository,
        )->resource;
    }

    private function mockRequest(string $juice, array|string|null $filter = null): string|JuiceRequest|Mockery\MockInterface
    {
        /** @var  Mockery\MockInterface */
        $mock = Mockery::mock(JuiceRequest::class);
        $mock->shouldReceive('all')->andReturn([
            'juice' => $juice,
            'filter' => $filter,
        ]);
        return $mock;
    }
}
