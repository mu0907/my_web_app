<DOCTYPE html>
<html lang="ja">
<head>
        <meta charset="utf-8">
        <title>WEB開発4回目</title>
    </head>
    <body>
        <div>
            <?php
                for($i = 1; $i <= 100; $i ++){
                    if($i % 2 == 0){
                        print($i. '</br>');
                    }
                }
            ?>
        </div>
    </body>