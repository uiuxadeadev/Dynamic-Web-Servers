<?php
// main.php
// require_once __DIR__ . '/vendor/autoload.php';  // Composerを使用する場合

use FoodServiceSimulation\FoodItems\CheeseBurger;
use FoodServiceSimulation\FoodItems\Fettuccine;
use FoodServiceSimulation\FoodItems\HawaiianPizza;
use FoodServiceSimulation\FoodItems\Spaghetti;
use FoodServiceSimulation\Persons\Employees\Chef;
use FoodServiceSimulation\Persons\Employees\Cashier;
use FoodServiceSimulation\Persons\Customer;
use FoodServiceSimulation\Restaurants\Restaurant;

// Composerを使用しない場合は以下のオートローダーを使用
spl_autoload_register(function ($class) {
    $prefix = 'FoodServiceSimulation\\';
    $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Create food items
$cheeseBurger = new CheeseBurger();
$fettuccine = new Fettuccine();
$hawaiianPizza = new HawaiianPizza();
$spaghetti = new Spaghetti();

// Create employees
$inayah = new Chef("Inayah Lozano", 40, "Osaka", 1, 30);
$nadia = new Cashier("Nadia Valentine", 21, "Tokyo", 1, 20);

// Create restaurant
$restaurant = new Restaurant(
    [
        $cheeseBurger,
        $fettuccine,
        $hawaiianPizza,
        $spaghetti
    ],
    [
        $inayah,
        $nadia
    ]
);

// Create customer with interested categories
$interestedCategories = [
    "burger" => 1,
    "pasta" => 1
];

$customer = new Customer("Tom", 20, "Saitama", $interestedCategories);

// Get orderable categories from menu
$orderableCategories = $customer->interestedCategories($restaurant);

// Place order and get invoice
$invoice = $customer->order($restaurant, $orderableCategories);