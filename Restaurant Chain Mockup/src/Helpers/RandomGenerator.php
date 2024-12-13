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
    private static $config = [
        'employeeMinCount' => 5,
        'employeeMaxCount' => 15,
        'salaryMin' => 30000,
        'salaryMax' => 80000,
        'locationCount' => 5,
        'zipCodeMin' => '00000',
        'zipCodeMax' => '99999'
    ];

    private static function getFaker() {
        if (!self::$faker) {
            self::$faker = Factory::create();
        }
        return self::$faker;
    }

    public static function setConfig(array $config): void {
        // 提供された設定のみを更新
        foreach ($config as $key => $value) {
            if (array_key_exists($key, self::$config)) {
                self::$config[$key] = $value;
            }
        }
    }

    // デフォルト設定を取得するメソッドを追加
    public static function getDefaultConfig(): array {
        return self::$config;
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
            $faker->numberBetween(self::$config['salaryMin'], self::$config['salaryMax']),
            $faker->dateTimeBetween('-5 years', 'now'),
            $faker->randomElements($awards, $faker->numberBetween(0, 3))
        );
    }

    public static function restaurantLocation(): RestaurantLocation {
        $faker = self::getFaker();
        
        $employees = [];
        $numEmployees = $faker->numberBetween(
            self::$config['employeeMinCount'],
            self::$config['employeeMaxCount']
        );
        
        for ($i = 0; $i < $numEmployees; $i++) {
            $employees[] = self::employee();
        }
        
        return new RestaurantLocation(
            $faker->company,
            $faker->streetAddress,
            $faker->city,
            $faker->state,
            $faker->numerify(
                str_pad(
                    $faker->numberBetween(
                        (int)self::$config['zipCodeMin'],
                        (int)self::$config['zipCodeMax']
                    ),
                    5,
                    '0',
                    STR_PAD_LEFT
                )
            ),
            $employees,
            $faker->boolean(90)
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
            $faker->boolean(30),
            $faker->randomElement($cuisineTypes),
            $faker->boolean(70),
            $faker->boolean(20) ? $faker->company : ''
        );
        
        for ($i = 0; $i < self::$config['locationCount']; $i++) {
            $chain->addLocation(self::restaurantLocation());
        }
        
        return $chain;
    }
}