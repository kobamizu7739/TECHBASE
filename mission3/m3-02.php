<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placefoler="名前を入力してください">
        <input type="text" name="str" placefoler="コメントを入力してください">
        <input type="submit" name="submit" value="送信">
    </form>
    <?php
        if (isset($_POST['str']) && isset($_POST['name'])){
            $name = $_POST['name'];
            $str = $_POST['str'];
        }
        if ((isset($str) && !$str == "") && (isset($name) && !$name == "")){
            $filename="mission_3-2.txt";
            $fp = fopen($filename,"a");
            $name= $_POST["name"];
            $str = $_POST["str"];
            $date = date("Y年m月d日H時i分s秒");
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            $lastline = $lines[count($lines)-1];
            $num = $lastline + 1 ;
            $result = "$num<>" . "$name<>" . "$str<>" . "$date<>";
            fwrite($fp, $result.PHP_EOL);
            fclose($fp);
            if(file_exists($filename)){
            $lines = file($filename);
            foreach($lines as $line){
            $comment = explode("<>",$line);
            echo "$comment[0]<br>";
            echo "$comment[1]<br>";
            echo "$comment[2]<br>";
            echo "$comment[3]<br>";
                }
            }
        }
    ?>
</body>
</html>