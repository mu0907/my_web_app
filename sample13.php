<?php
// データベース接続情報
$dsn = 'mysql:host=localhost;port=8889;dbname=mydb;charset=utf8';
$username = 'root';
$password = '';  // もしくは 'root'
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // PDOインスタンスの作成
    $pdo = new PDO($dsn, $username, $password, $options);

    // SQLクエリの準備と実行
    $stmt = $pdo->query('SELECT * FROM users');

    // 結果を取得
    $users = $stmt->fetchAll();

    // データを表示
    if ($users) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Email</th></tr>';
        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No data found.';
    }
} catch (PDOException $e) {
    // エラーメッセージを表示
    echo 'Database error: ' . $e->getMessage();
}
?>
