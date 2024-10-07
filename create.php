<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブログ記事一覧</title>
</head>
<body>
    <h1>ブログ記事一覧</h1>
    <a href="create.php">新規記事作成</a>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <a href="show.php?id=<?= $post['id'] ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>
                - <?= $post['created_at'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>