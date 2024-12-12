<?php
namespace FoodServiceSimulation\Persons\Employees;

use FoodServiceSimulation\Persons\Employees\Base\Employee;
use FoodServiceSimulation\FoodOrders\FoodOrder;
use FoodServiceSimulation\FoodOrders\Invoice;
use FoodServiceSimulation\Restaurants\Restaurant;

class Cashier extends Employee {
    public function generateOrder(array $categories, Restaurant $restaurant): FoodOrder {
        $items = [];
        foreach ($categories as $category => $quantity) {
            foreach ($restaurant->getMenu() as $item) {
                if ($item::getCategory() === $category) {
                    for ($i = 0; $i < $quantity; $i++) {
                        $items[] = $item;
                    }
                }
            }
        }
        return new FoodOrder($items);
    }

    public function generateInvoice(FoodOrder $order): Invoice {
        $totalPrice = 0;
        foreach ($order->getItems() as $item) {
            $totalPrice += $item->getPrice();
        }
        
        $invoice = new Invoice($totalPrice, $order->getOrderTime(), 30);
        
        echo "Date: " . $order->getOrderTime()->format('Y/m/d H:i:s') . "\n";
        echo "Final Price: $" . number_format($totalPrice, 2) . "\n";
        
        return $invoice;
    }
}