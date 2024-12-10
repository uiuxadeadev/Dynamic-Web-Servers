<?php
namespace Cars;

use Interfaces\Engine;

abstract class Car {
    protected string $make;
    protected Engine $engine;

    public function __construct(string $make, Engine $engine) {
        $this->make = $make;
        $this->engine = $engine;
    }

    abstract public function drive(): string;

    public function start(): string {
        return $this->engine->start();
    }
}