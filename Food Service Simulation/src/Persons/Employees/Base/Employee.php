<?php
namespace FoodServiceSimulation\Persons\Employees\Base;

use FoodServiceSimulation\Persons\Base\Person;

abstract class Employee extends Person {
    protected int $employeeId;
    protected float $salary;

    public function __construct(string $name, int $age, string $address, int $employeeId, float $salary) {
        parent::__construct($name, $age, $address);
        $this->employeeId = $employeeId;
        $this->salary = $salary;
    }
}