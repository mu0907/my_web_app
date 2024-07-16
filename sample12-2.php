<?php

session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>セッションデータの確認</title>
</head>
<body>
    <h1>セッションデータの確認</h1>

    <?php
    if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
        echo "<p>ユーザー名: " . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . "</p>";
        echo "<p>メールアドレス: " . htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') . "</p>";
    } else {
        echo "<p>セッションデータが見つかりません。</p>";
    }
    ?>

    <a href="set_session.php">セッションデータを設定する</a>
</body>
</html>
