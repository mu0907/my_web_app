<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像アップロード</title>
</head>
<body>
    <h1>画像アップロードフォーム</h1>

    <?php
    // POST メソッドでフォームが送信されたときの処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // ファイルの基本情報
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        // アップロードディレクトリを指定（適宜変更してください）
        $uploadDir = 'uploads/';

        // エラーチェック
        if ($fileError !== UPLOAD_ERR_OK) {
            die("アップロードエラーが発生しました。エラーコード: $fileError");
        }

        // ファイルをアップロードディレクトリに移動
        $uploadPath = $uploadDir . basename($fileName);

        if (!move_uploaded_file($fileTmpName, $uploadPath)) {
            die("ファイルのアップロードに失敗しました。");
        }

        // アップロード成功時の情報表示
        echo "<h2>アップロードされた画像情報</h2>";
        echo "<p>ファイル名: " . htmlspecialchars($fileName) . "</p>";
        echo "<p>ファイルタイプ: " . htmlspecialchars($fileType) . "</p>";
        echo "<p>ファイルサイズ: " . htmlspecialchars($fileSize) . " bytes</p>";
        echo "<img src='" . htmlspecialchars($uploadPath) . "' alt='Uploaded Image'>";
    }
    ?>

    <!-- アップロードフォーム -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="file">画像を選択:</label>
        <input type="file" name="file" id="file">
        <input type="submit" value="アップロード">
    </form>
</body>
</html>
