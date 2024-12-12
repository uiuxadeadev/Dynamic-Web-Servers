<?php
namespace FoodServiceSimulation\FoodItems;

use FoodServiceSimulation\FoodItems\Base\FoodItem;

class HawaiianPizza extends FoodItem {
    private const CATEGORY = "pizza";

    public function __construct() {
        parent::__construct("HawaiianPizza", "Pizza with pineapple and ham", 15.99);
    }

    public static function getCategory(): string {
        return self::CATEGORY;
    }
}