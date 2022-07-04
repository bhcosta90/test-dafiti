<?php

namespace App\Repository;

use Illuminate\Http\Response;

class CategoryRepository
{
    private array $data = [];

    public function __construct()
    {
        $this->data = [
            "Classic" => ["strawberry", "banana", "pineapple", "mango", "peach", "honey", "ice", "yogurt"],
            "Forest Berry" => ["strawberry", "raspberry", "blueberry", "honey", "ice", "yogurt"],
            "Freezie" => ["blackberry", "blueberry", "black currant", "grape juice", "frozen yogurt"],
            "Greenie" => ["green apple", "kiwi", "lime", "avocado", "spinach", "ice", "apple juice"],
            "Vegan Delite" => ["strawberry", "passion fruit", "pineapple", "mango", "peach", "ice", "soy milk"],
            "Just Desserts" => ["banana", "ice cream", "chocolate", "peanut", "cherry"]
        ];
    }

    public function filter(string $key, string|array|null $data = null)
    {
        if (gettype($data) === 'string') {
            $data = explode(',', str_replace(', ', ',', $data));
        }
        
        if (empty($this->data[$key])) {
            throw new Exceptions\CategoryException("{$key} not found", Response::HTTP_NOT_FOUND);
        }

        $ret = $this->data[$key];
        asort($ret);
        if (is_array($data)) {
            foreach ($data as $value) {
                $value = str_replace("+ ", "+", $value);
                $value = str_replace("- ", "-", $value);

                if (substr($value, 0, 1) == '-') {
                    $value = substr($value, 1);
                    if (($search = array_search($value, $ret)) !== false) {
                        unset($ret[$search]);
                    }
                } else {
                    $value = substr($value, 0, 1) == '+' ? substr($value, 1) : $value;
                    $ret = array_merge($ret, [$value]);
                }
            }
        }

        $ret = array_unique($ret);
        asort($ret);
        return array_values($ret);
    }
}
