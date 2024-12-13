<?php
/**
 * Restaurant Chain Management System
 * 
 * メインエントリーポイント
 * - オートローディングの設定
 * - 依存関係の読み込み
 * - リクエストの処理
 * - レスポンスの生成
 */

// エラー報告の設定
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Composerのオートローダーの読み込み
require_once __DIR__ . '/vendor/autoload.php';

// 必要なクラスのインポート
use Helpers\RandomGenerator;
use Models\RestaurantChain;

// セッションの開始
session_start();

// リクエストパラメータの取得とサニタイズ
$format = isset($_GET['format']) ? strtolower(trim($_GET['format'])) : 'html';
$action = isset($_GET['action']) ? strtolower(trim($_GET['action'])) : 'view';

try {
    // チェーンの取得もしくは生成
    if ($action === 'generate' || !isset($_SESSION['chain'])) {
        $chain = RandomGenerator::restaurantChain();
        $_SESSION['chain'] = serialize($chain);
    } else {
        $chain = unserialize($_SESSION['chain']);
    }

    // レスポンスの生成
    switch ($format) {
        case 'json':
            // JSONフォーマットでの出力
            header('Content-Type: application/json');
            echo json_encode($chain->toArray(), JSON_PRETTY_PRINT);
            exit;

        case 'markdown':
            // Markdownフォーマットでの出力
            header('Content-Type: text/markdown');
            header('Content-Disposition: attachment; filename="restaurant-chain.md"');
            echo $chain->toMarkdown();
            exit;

        case 'text':
            // プレーンテキストでの出力
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="restaurant-chain.txt"');
            echo $chain->toString();
            exit;

        case 'html':
        default:
            // HTMLでの表示
            // レイアウトに埋め込むコンテンツの生成
            ob_start();
            include __DIR__ . '/src/Views/restaurant-chain.php';
            $content = ob_get_clean();

            // レイアウトの表示
            include __DIR__ . '/src/Views/layout.php';
            break;
    }
} catch (Exception $e) {
    // エラーハンドリング
    $error = "An error occurred: " . $e->getMessage();
    
    if ($format === 'json') {
        header('Content-Type: application/json');
        echo json_encode(['error' => $error]);
        exit;
    } elseif ($format === 'markdown' || $format === 'text') {
        header('Content-Type: text/plain');
        echo $error;
        exit;
    } else {
        // HTMLでのエラー表示
        $content = "<div class='error-message'>{$error}</div>";
        include __DIR__ . '/src/Views/layout.php';
    }
}

/**
 * ユーティリティ関数
 */

/**
 * 安全なHTML出力を行う
 * @param string $text
 * @return string
 */
function h($text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * 現在のURLを生成する
 * @param array $params 追加したいクエリパラメータ
 * @return string
 */
function currentUrl(array $params = []): string {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $query = [];
    if (isset($url['query'])) {
        parse_str($url['query'], $query);
    }
    $query = array_merge($query, $params);
    return $url['path'] . ($query ? '?' . http_build_query($query) : '');
}

/**
 * アクティブなナビゲーションアイテムかどうかを判定する
 * @param string $actionName
 * @return string
 */
function isActiveNav(string $actionName): string {
    global $action;
    return $action === $actionName ? 'active' : '';
}