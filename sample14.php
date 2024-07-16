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

    // フォームからのデータがPOSTされた場合
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];

        // データの挿入
        $stmt = $pdo->prepare('INSERT INTO products (id, product_name) VALUES (:id, :product_name)');
        $stmt->execute([':id' => $id, ':product_name' => $product_name]);

        echo 'New product added successfully.<br>';
    }

    // SQLクエリの準備と実行
    $stmt = $pdo->query('SELECT * FROM products');

    // 結果を取得
    $products = $stmt->fetchAll();

    // データを表示
    if ($products) {
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Product Name</th></tr>';
        foreach ($products as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') . '</td>';
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

<!-- 新しい商品を追加するフォーム -->
<h2>Add New Product</h2>
<form method="post">
    <label for="id">ID:</label>
    <input type="number" id="id" name="id" required><br>
    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" required><br>
    <input type="submit" value="Add Product">
</form>
