<?php
namespace FoodServiceSimulation\Restaurants;

use FoodServiceSimulation\Persons\Employees\Base\Employee;
use FoodServiceSimulation\Persons\Employees\Cashier;
use FoodServiceSimulation\Persons\Employees\Chef;
use FoodServiceSimulation\FoodOrders\Invoice;
use Exception;

class Restaurant {
    private array $menu;
    private array $employees;

    public function __construct(array $menu, array $employees) {
        $this->menu = $menu;
        $this->employees = $employees;
    }

    public function getMenu(): array {
        return $this->menu;
    }

    public function order(array $categories): Invoice {
        /** @var Cashier $cashier */
        $cashier = $this->findEmployee(Cashier::class);
        /** @var Chef $chef */
        $chef = $this->findEmployee(Chef::class);
        
        $order = $cashier->generateOrder($categories, $this);
        echo $chef->prepareFood($order);
        
        $invoice = $cashier->generateInvoice($order);
        echo "{$cashier->getName()} made the invoice.\n";
        
        return $invoice;
    }

    private function findEmployee(string $className): Employee {
        if (!class_exists($className)) {
            throw new Exception("Class $className does not exist");
        }
        
        foreach ($this->employees as $employee) {
            if (get_class($employee) === $className) {
                return $employee;
            }
        }
        throw new Exception("Employee of type $className not found");
    }
}