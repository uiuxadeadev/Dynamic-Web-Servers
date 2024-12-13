<?php
namespace Controllers;

use Helpers\RandomGenerator;
use Models\RestaurantChain;

class RestaurantChainController {
    public function generateChain(array $params = []): RestaurantChain {
        // パラメータの検証と設定
        $config = $this->validateAndProcessParams($params);
        
        // RandomGeneratorの設定を更新
        RandomGenerator::setConfig($config);

        // 新しいチェーンを生成
        return RandomGenerator::restaurantChain();
    }

    private function validateAndProcessParams(array $params): array {
        $config = [];

        // 従業員数の範囲
        if (isset($params['minEmployees']) && isset($params['maxEmployees'])) {
            $min = (int)$params['minEmployees'];
            $max = (int)$params['maxEmployees'];
            if ($min > 0 && $max >= $min) {
                $config['employeeMinCount'] = $min;
                $config['employeeMaxCount'] = $max;
            }
        }

        // 給与範囲
        if (isset($params['minSalary']) && isset($params['maxSalary'])) {
            $min = (int)$params['minSalary'];
            $max = (int)$params['maxSalary'];
            if ($min > 0 && $max >= $min) {
                $config['salaryMin'] = $min;
                $config['salaryMax'] = $max;
            }
        }

        // 場所の数
        if (isset($params['locationCount'])) {
            $count = (int)$params['locationCount'];
            if ($count > 0) {
                $config['locationCount'] = $count;
            }
        }

        // 郵便番号の範囲
        if (isset($params['minZipCode']) && isset($params['maxZipCode'])) {
            $min = str_pad($params['minZipCode'], 5, '0', STR_PAD_LEFT);
            $max = str_pad($params['maxZipCode'], 5, '0', STR_PAD_LEFT);
            if ($min <= $max) {
                $config['zipCodeMin'] = $min;
                $config['zipCodeMax'] = $max;
            }
        }

        return $config;
    }
}