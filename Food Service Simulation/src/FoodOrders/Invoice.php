<?php
namespace FoodServiceSimulation\FoodOrders;

use DateTime;

class Invoice {
    private float $finalPrice;
    private DateTime $orderTime;
    private int $estimatedTimeInMinutes;

    public function __construct(float $finalPrice, DateTime $orderTime, int $estimatedTimeInMinutes) {
        $this->finalPrice = $finalPrice;
        $this->orderTime = $orderTime;
        $this->estimatedTimeInMinutes = $estimatedTimeInMinutes;
    }
}