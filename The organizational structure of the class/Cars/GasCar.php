<?php
namespace Cars;

use Engines\GasolineEngine;

class GasCar extends Car {
    public function __construct(string $make) {
        parent::__construct($make, new GasolineEngine());
    }

    public function drive(): string {
        return "Driving the gas car...";
    }
}