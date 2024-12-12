<?php
namespace FoodServiceSimulation\FoodItems;

use FoodServiceSimulation\FoodItems\Base\FoodItem;

class Spaghetti extends FoodItem {
    private const CATEGORY = "pasta";

    public function __construct() {
        parent::__construct("Spaghetti", "Classic spaghetti with tomato sauce", 10.99);
    }

    public static function getCategory(): string {
        return self::CATEGORY;
    }
}