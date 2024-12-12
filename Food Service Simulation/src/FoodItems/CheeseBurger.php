<?php
namespace FoodServiceSimulation\FoodItems;

use FoodServiceSimulation\FoodItems\Base\FoodItem;

class CheeseBurger extends FoodItem {
    private const CATEGORY = "burger";

    public function __construct() {
        parent::__construct("CheeseBurger", "Juicy beef patty with cheese", 8.99);
    }

    public static function getCategory(): string {
        return self::CATEGORY;
    }
}