<?php
namespace FoodServiceSimulation\FoodOrders;

use DateTime;

class FoodOrder {
    private array $items;
    private DateTime $orderTime;

    public function __construct(array $items) {
        $this->items = $items;
        $this->orderTime = new DateTime();
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getOrderTime(): DateTime {
        return $this->orderTime;
    }
}