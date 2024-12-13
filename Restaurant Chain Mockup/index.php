<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controllers\RestaurantChainController;

session_start();

// リクエストパラメータの取得
$action = $_GET['action'] ?? 'form'; // デフォルトをformに変更
$controller = new RestaurantChainController();

try {
    switch ($action) {
        case 'generate':
            // フォームパラメータを使用してチェーンを生成
            $chain = $controller->generateChain($_GET);
            $_SESSION['chain'] = serialize($chain);
            
            // フォーマットに基づいて出力
            $format = $_GET['format'] ?? 'html';
            switch ($format) {
                case 'json':
                    header('Content-Type: application/json');
                    echo json_encode($chain->toArray(), JSON_PRETTY_PRINT);
                    exit;

                case 'markdown':
                    header('Content-Type: text/markdown');
                    header('Content-Disposition: attachment; filename="restaurant-chain.md"');
                    echo $chain->toMarkdown();
                    exit;

                case 'txt':
                    header('Content-Type: text/plain');
                    header('Content-Disposition: attachment; filename="restaurant-chain.txt"');
                    echo $chain->toString();
                    exit;

                case 'html':
                default:
                    ob_start();
                    include __DIR__ . '/src/Views/restaurant-chain.php';
                    $content = ob_get_clean();
                    break;
            }
            break;

        case 'form':
        default:
            // ジェネレーターフォームを表示
            ob_start();
            include __DIR__ . '/src/Views/generator-form.php';
            $content = ob_get_clean();
            break;
    }

    // レイアウトの表示
    include __DIR__ . '/src/Views/layout.php';

} catch (Exception $e) {
    $error = $e->getMessage();
    $content = "<div class='error-message'>{$error}</div>";
    include __DIR__ . '/src/Views/layout.php';
}