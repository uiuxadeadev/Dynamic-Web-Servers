<?php
namespace Engines;

use Interfaces\Engine;

class GasolineEngine implements Engine {
    public function start(): string {
        return "Starting the gasoline engine...";
    }
}