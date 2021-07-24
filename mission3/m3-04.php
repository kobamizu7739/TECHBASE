<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-4</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前を入力してください" value="<?php if(isset($ediname)) {echo $ediname;} ?>"><br>
        <input type="text" name="str" placeholder="コメントを入力してください" value="<?php if(isset($edicomment)) {echo $edicomment;} ?>"><br>
        <input type="text" name="postnumber" placeholder="番号を入力してください" value="<?php if(isset($edinum)) {echo $edinum;} ?>"><br>
        <input type="submit" name="submit" value="送信"><br>
        <input type="text" name="num" placeholder="番号を入力してください"><br>
        <input type="submit" name="delete" value="削除"><br>
        <input type="text" name="num2" placeholder="編集を入力してください"><br>
        <input type="submit" name="edit" value="編集"><br>
    </form>
    <?php
        if (isset($_POST['str']) && isset($_POST['name'])){
            $name = $_POST['name'];
            $str = $_POST['str'];
        }
        if(isset($_POST['num'])){
            $num = $_POST['num'];
        }
        if(isset($_POST["num2"])){
            $editnum = $_POST["num2"];
        }
        if ((isset($str) && !$str == "") && (isset($name) && !$name == "")){
            $filename="mission_3-4.txt";
            $fp = fopen($filename,"a");
            $name= $_POST["name"];
            $str = $_POST["str"];
            $date = date("Y年m月d日H時i分s秒");
            $linenumber = file($filename, FILE_IGNORE_NEW_LINES);
            $lastline = $linenumber[count($linenumber) - 1];
            $lastnumber = explode("<>",$lastline);
            $lastnum = 1;
            $lastnum = $lastnumber[0] + 1;
            $result = "$lastnum<>" . "$name<>" . "$str<>" . "$date<>";
            fwrite($fp, $result.PHP_EOL);
            fclose($fp);
            
            $line = file($filename, FILE_IGNORE_NEW_LINES);
            foreach($line as $text){
                $comment = explode("<>",$text);
                echo "$comment[0] ";
                echo "$comment[1] ";
                echo "$comment[2] ";
                echo "$comment[3]<br>";
            }
        }
        if (isset($_POST["num"]) && !$num == "") {
            $delete = $_POST["num"];
            $delCon = file("mission_3-4.txt");
            $lines = file($delCon,FILE_IGNORE_NEW_LINES);
            $fp = fopen("mission_3-4.txt", "w");
            for ($j = 0; $j < count($lines); $j++){
                $line = explode("<>", $lines[$j]);
                $postnum = $line[0];
                if ($postnum != $delete){
                    fwrite($fp, $lines[$j].PHP_EOL);
                    $line = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach($line as $text){
                    $comment = explode("<>",$text);
                    echo "$comment[0] ";
                    echo "$comment[1] ";
                    echo "$comment[2] ";
                    echo "$comment[3]<br>";
                    }
                }
                else{
                    fwrite($fp, "");
                    fclose($fp);
                    $line = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach($line as $text){
                    $comment = explode("<>",$text);
                    echo "$comment[0] ";
                    echo "$comment[1] ";
                    echo "$comment[2] ";
                    echo "$comment[3]<br>";
                    }
                }
            }
        }
        if(isset($editnum) && !$editnum == ""){
            $edifile = file("mission3-4.txt");
            $lines = file($edifile,FILE_IGNORE_NEW_LINES);
            $fp = fopen("mission_3-4.txt", "w");
            for ($j = 0; $j < count($lines); $j++){
                $line = explode("<>", $lines[$j]);
                $postnum = $line[0];
                if ($postnum == $edinum){
                    fwrite($fp, $lines[$j].PHP_EOL);
                    $line = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach($line as $text){
                    $comment = explode("<>",$text);
                    $edinum = $comment[0];
                    $ediname = $comment[1];
                    $edicomment = $comment[2];
                    }
                }
            }
        }
    ?>
</body>
</html>
