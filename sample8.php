<DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>WEB開発5回目</title>
</head>
<body>
    <div>
        <?php
            $kudamono = [
                'apple' => 'りんご',
                'lemon' => 'レモン',
                'grape' => 'ぶどう',
                'tomato' => 'トマト'
            ];
            foreach ($kudamono as $key => $value){
                print('英語:'.$key . "<br>");
                print('日本語:'.$value . "<br>");
            }
        ?>
    </div>
</body>
</html>