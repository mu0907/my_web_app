<?php
session_start();

try {
    $db = new PDO('sqlite:users.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY,
        username TEXT UNIQUE,
        password TEXT
    )");
} catch (PDOException $e) {
    die("データベース接続に失敗しました: " . $e->getMessage());
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);
        echo "登録が完了しました！";
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "ログインに失敗しました。";
    }
}

// ログアウト処理
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログインシステム</title>
</head>
<body>
<?php if (isset($_SESSION['user_id'])): ?>
    <p>ログイン中: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <a href="?logout=1">ログアウト</a>
<?php else: ?>
    <h2>登録フォーム</h2>
    <form method="POST">
        <label>ユーザー名:</label>
        <input type="text" name="username" required>
        <br>
        <label>パスワード:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="register">登録</button>
    </form>

    <h2>ログインフォーム</h2>
    <form method="POST">
        <label>ユーザー名:</label>
        <input type="text" name="username" required>
        <br>
        <label>パスワード:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="login">ログイン</button>
    </form>
<?php endif; ?>
</body>
</html>
