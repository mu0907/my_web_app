<?php
// セッションの開始
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>セッションの設定と確認</title>
</head>
<body>
    <h1>セッションの設定と確認</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // フォームから送信されたデータをセッションに保存
        $_SESSION['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $_SESSION['email'] = isset($_POST['email']) ? $_POST['email'] : '';

        echo "セッションにデータが保存されました。<br>";
        echo '<a href="set_session.php?action=check">セッションデータを確認する</a>';
    } elseif (isset($_GET['action']) && $_GET['action'] === 'check') {
        // セッションデータの確認
        if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
            echo "<p>ユーザー名: " . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p>メールアドレス: " . htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') . "</p>";
        } else {
            echo "<p>セッションデータが見つかりません。</p>";
        }
        echo '<a href="set_session.php">セッションデータを再設定する</a>';
    } else {
        // フォームの表示
        echo '
        <form action="set_session.php" method="post">
            <label for="username">ユーザー名:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="email">メールアドレス:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <input type="submit" value="セッションに保存">
        </form>';
    }
    ?>
</body>
</html>
