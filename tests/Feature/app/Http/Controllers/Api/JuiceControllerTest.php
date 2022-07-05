<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use App\Repository\Exceptions\JuiceException;
use Tests\TestCase;

class JuiceControllerTest extends TestCase
{
    public function testCreateClassicPlusChocolate()
    {
        $ret = $this->executeResponse('Classic', ["+chocolate"]);
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
        $ret = $this->executeResponse('Classic', ["+chocolate", "-strawberry"]);
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
        $ret = $this->executeResponse('Classic');
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
        $ret = $this->executeResponse('Classic', ["-strawberry"]);
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
        $ret = $this->executeResponse('Just Desserts');
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
        $ret = $this->executeResponse('Just Desserts', ['-ice cream', '-peanut']);
        $this->assertEquals([
            "banana",
            "cherry",
            "chocolate",
        ], $ret);
    }

    public function testNotFoundJuice()
    {
        $ret = $this->getJson('/v1/api/juice/test');

        $ret->assertStatus(404)->assertJson([
            'message' => 'test not found'
        ]);
    }

    private function executeResponse(string $juice, array|string|null $filter = null)
    {
        if (is_array($filter) && count($filter)) {
            $filter = implode(',', $filter);
        }
        $ret = $this->getJson('/v1/api/juice/' . $juice . ($filter ? ',' . $filter : ''));
        return $ret->json('data');
    }
}
