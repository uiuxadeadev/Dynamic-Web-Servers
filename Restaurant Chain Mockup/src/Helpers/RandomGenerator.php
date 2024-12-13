<?php
namespace Helpers;

use DateTime;
use Faker\Factory;
use Models\Company;
use Models\Employee;
use Models\RestaurantChain;
use Models\RestaurantLocation;
use Models\User;

class RandomGenerator {
    private static $faker;

    private static function getFaker() {
        if (!self::$faker) {
            self::$faker = Factory::create();
        }
        return self::$faker;
    }

    public static function user(): User {
        $faker = self::getFaker();

        return new User(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor'])
        );
    }

    public static function employee(): Employee {
        $faker = self::getFaker();
        
        $jobTitles = ['Manager', 'Chef', 'Server', 'Host', 'Bartender', 'Kitchen Staff'];
        $awards = ['Employee of the Month', 'Best Customer Service', 'Safety Award', 'Leadership Award'];
        
        return new Employee(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            'employee',
            $faker->randomElement($jobTitles),
            $faker->numberBetween(30000, 80000),
            $faker->dateTimeBetween('-5 years', 'now'),
            $faker->randomElements($awards, $faker->numberBetween(0, 3))
        );
    }

    public static function restaurantLocation(): RestaurantLocation {
        $faker = self::getFaker();
        
        $employees = [];
        $numEmployees = $faker->numberBetween(5, 15);
        for ($i = 0; $i < $numEmployees; $i++) {
            $employees[] = self::employee();
        }
        
        return new RestaurantLocation(
            $faker->company,
            $faker->streetAddress,
            $faker->city,
            $faker->state,
            $faker->postcode,
            $employees,
            $faker->boolean(90) // 90% chance of being open
        );
    }

    public static function restaurantChain(): RestaurantChain {
        $faker = self::getFaker();
        
        $cuisineTypes = ['Italian', 'American', 'Mexican', 'Chinese', 'Japanese', 'Indian', 'French'];
        
        $chain = new RestaurantChain(
            $faker->randomNumber(),
            $faker->company,
            $faker->numberBetween(1950, 2020),
            $faker->paragraph,
            $faker->url,
            $faker->phoneNumber,
            'Restaurant/Hospitality',
            $faker->name,
            $faker->boolean(30), // 30% chance of being publicly traded
            $faker->randomElement($cuisineTypes),
            $faker->boolean(70), // 70% chance of having drive-thru
            $faker->boolean(20) ? $faker->company : '' // 20% chance of having parent company
        );
        
        $numLocations = $faker->numberBetween(3, 10);
        for ($i = 0; $i < $numLocations; $i++) {
            $chain->addLocation(self::restaurantLocation());
        }
        
        return $chain;
    }

    public static function generateMultiple(string $type, int $count): array {
        $items = [];
        for ($i = 0; $i < $count; $i++) {
            switch ($type) {
                case 'user':
                    $items[] = self::user();
                    break;
                case 'employee':
                    $items[] = self::employee();
                    break;
                case 'restaurantLocation':
                    $items[] = self::restaurantLocation();
                    break;
                case 'restaurantChain':
                    $items[] = self::restaurantChain();
                    break;
            }
        }
        return $items;
    }
}