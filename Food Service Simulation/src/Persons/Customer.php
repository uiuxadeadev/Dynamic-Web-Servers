<?php
namespace FoodServiceSimulation\Persons;

use FoodServiceSimulation\Persons\Base\Person;
use FoodServiceSimulation\Restaurants\Restaurant;
use FoodServiceSimulation\FoodOrders\Invoice;

class Customer extends Person {
    private array $interestedCategories;

    public function __construct(string $name, int $age, string $address, array $interestedCategories) {
        parent::__construct($name, $age, $address);
        $this->interestedCategories = $interestedCategories;
    }

    public function order(Restaurant $restaurant, array $categories): Invoice {
        return $restaurant->order($categories);
    }

    public function interestedCategories(Restaurant $restaurant): array {
        // Filter menu categories by customer interests
        $orderableCategories = [];
        
        foreach ($restaurant->getMenu() as $menuItem) {
            $category = $menuItem::getCategory();
            if (array_key_exists($category, $this->interestedCategories)) {
                $orderableCategories[$category] = $this->interestedCategories[$category];
            }
        }
        
        return $orderableCategories;
    }
}