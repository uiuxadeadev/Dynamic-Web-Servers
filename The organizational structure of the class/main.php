<?php
// require_once 'Interfaces/Engine.php';
// require_once 'Engines/GasolineEngine.php';
// require_once 'Engines/ElectricEngine.php';
// require_once 'Cars/Car.php';
// require_once 'Cars/GasCar.php';
// require_once 'Cars/ElectricCar.php';
spl_autoload_extensions(".php"); 
spl_autoload_register();

$gasCar = new Cars\GasCar('Toyota');
$electricCar = new Cars\ElectricCar('Tesla');

echo $gasCar->drive(); // Output: Driving the gas car...
echo $gasCar->start(); // Output: Starting the gasoline engine...

echo $electricCar->drive(); // Output: Driving the electric car...
echo $electricCar->start(); // Output: Starting the electric engine...