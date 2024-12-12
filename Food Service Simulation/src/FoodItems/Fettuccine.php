<?php
namespace FoodServiceSimulation\FoodItems;

use FoodServiceSimulation\FoodItems\Base\FoodItem;

class Fettuccine extends FoodItem {
    private const CATEGORY = "pasta";

    public function __construct() {
        parent::__construct("Fettuccine", "Classic fettuccine pasta", 12.99);
    }

    public static function getCategory(): string {
        return self::CATEGORY;
    }
}