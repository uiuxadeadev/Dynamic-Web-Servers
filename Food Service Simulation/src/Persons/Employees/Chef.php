<?php
namespace FoodServiceSimulation\Persons\Employees;

use FoodServiceSimulation\Persons\Employees\Base\Employee;
use FoodServiceSimulation\FoodOrders\FoodOrder;

class Chef extends Employee {
    public function prepareFood(FoodOrder $order): string {
        $items = $order->getItems();
        $output = "";
        foreach ($items as $item) {
            $output .= "{$this->name} was cooking {$item->getName()}.\n";
        }
        return $output;
    }
}