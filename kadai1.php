<DOCTYPE html>
<html lang="ja">
<head>
        <meta charset="utf-8">
        <title>WEB開発4回目</title>
    </head>
    <body>
        <div>
            <?php
                $sample = 100 * 2 + 1000 * 1 + 200 * 2;
                $sample1 = (100 + 100 * 0.08) * 2 +(1000 + 1000 * 0.08) + (200 + 200 * 0.08) * 2;
                print('税抜き');
                print $sample;
                print('<br>税込み');
                print $sample1;
            ?>
        </div>
    </body>