<?php

use App\Repository\JuiceRepository;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as PHPUnit;

class FeatureContext implements Context
{
    private $ret = [];

    /**
     * @Transform "^([\d](?:,[\d])*)$"
     */
    public function toArray(string $value): array
    {
        return explode(',', $value);
    }

    /**
     * @Given Create :category minus :ingredient
     */
    public function createOnlyMinus($category, $minus = null)
    {
        return $this->createPlusAndMinus($category, null, $minus);
    }

    /**
     * @Given Create All :params
     */
    public function createAll($params)
    {
        $params = str_replace(', ', ',', $params);
        $arrayParams = explode(',', $params);
        $category = $arrayParams[0];
        unset($arrayParams[0]);
        $this->createPlusAndMinus($category, implode(',', $arrayParams));
    }

    /**
     * @Given Create :category
     * @Given Create :category plus :ingredient
     * @Given Create :category plus :ingredient minus :minus
     */
    public function createPlusAndMinus($category, $plus = null, $minus = null)
    {
        $repo = new JuiceRepository;
        $arrayPlus = explode(',', str_replace(', ', ',', $plus ?: "")) ?: [];
        $arrayMinus = explode(',', str_replace(', ', ',', $minus ?: "")) ?: [];
        foreach ($arrayMinus as $k => $v) {
            if (substr($minus ?: "", 0, 1) !== '-') {
                $arrayMinus[$k] = '-' . $arrayMinus[$k];
            }
        }
        $arraySearch = [];

        if ($plus && $arrayPlus) {
            $arraySearch = array_merge($arraySearch, $arrayPlus);
        }

        if ($minus && $arrayMinus) {
            $arraySearch = array_merge($arraySearch, $arrayMinus);
        }

        $this->ret = $repo->filter($category, $arraySearch);
    }

    /**
     * @When I shouldBe :ingredients
     */
    public function iShouldBe($ingredients)
    {
        if ($ingredients == '[]') {
            PHPUnit::assertCount(0, $this->ret);
            return true;
        }

        $ingredients = str_replace(['[', '"', "'", ']'], '', $ingredients);
        $ingredients = str_replace(', ', ',', $ingredients);
        $ingredients = explode(',', $ingredients);
        asort($ingredients);
        try {
            PHPUnit::assertEquals(array_values($ingredients), $this->ret);
            return true;
        } catch (Throwable $e) {
            var_dump([array_values($ingredients), $this->ret]);
            throw $e;
        }
    }
}
