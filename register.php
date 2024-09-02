<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // パスワードをハッシュ化
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // ユーザーをデータベースに挿入
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $email, $passwordHash])) {
        echo "User registered successfully!";
    } else {
        echo "Error: Could not register user.";
    }
}
?>