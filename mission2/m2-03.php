<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-03</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" placefoler="文章を入力してください">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        $str = $_POST["str"];
        $filename="mission_2-3.txt";
        $fp = fopen($filename,"a");
        fwrite($fp, $str.PHP_EOL);
        fclose($fp);
    ?>
</body>
</html>