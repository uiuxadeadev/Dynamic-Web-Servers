<?php
namespace Cars;

use Engines\ElectricEngine;

class ElectricCar extends Car {
    public function __construct(string $make) {
        parent::__construct($make, new ElectricEngine());
    }

    public function drive(): string {
        return "Driving the electric car...";
    }
}