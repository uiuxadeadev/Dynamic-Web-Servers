<?php
/**
 * layout.php - メインレイアウトテンプレート
 * 
 * このファイルはアプリケーション全体の HTML 構造を定義し、
 * 共通のヘッダー、フッター、スタイルシート、JavaScriptを含みます。
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Chain Management System</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1>Restaurant Chain Management System</h1>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/generate">Generate New Chain</a></li>
                    <li><a href="/about">About</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php
        // メインコンテンツを表示
        // restaurant-chain.php などの他のビューファイルの内容がここに挿入されます
        echo $content;
        ?>
    </main>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Restaurant Chain Management System</p>
        </div>
    </footer>

    <script src="/public/js/main.js"></script>
</body>
</html>