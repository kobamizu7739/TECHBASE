<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m3-5</title>
</head>
<body>
    
    
    <?php
    $file = "mission3-5.txt";
    //投稿機能
    if ((isset($_POST['comment'])) && (isset($_POST['name'])) &&(isset($_POST['password']))) {
            $name = $_POST['name'];
            $comment = $_POST['comment'];
            $password = $_POST['password'];
            $date = date("Y/m/d H:i:s");
        if(empty($_POST["postnumber"])) {
             // 以下、新規投稿機能
            if (file_exists($file)) {
                $num = count(file($file))+1;
            }else {
                $num = 1;
            }
             //書き込む文字列を組み合わせた変数
            $newdata = $num . "<>" . $name . "<>" . $comment . "<>" . $date . "<>" . $password . "<>";

            //ファイルを追記保存モードでオープンする
            $fp = fopen($file,"a");
            fwrite($fp,$newdata . "\n");
            $lines = file($file);
            foreach($lines as $line) {
                echo $line."<br>";
            }
            fclose($fp);
            
        }else {
            // 以下編集機能
            $edit = $_POST["postnumber"];
            $editlines = file($file);
            $fp = fopen($file,"w");
            foreach($editlines as $str) {
                //explode関数でそれぞれの値を取得
                $data = explode("<>", $str);
                //投稿番号と編集番号が一致したら
                if ($data[0] == $edit) {
                    //編集のフォームから送信された値と差し替えて上書き
                    fwrite($fp, $edit . "<>" . $name . "<>" . $comment . "<>" . $date . "\n");
                } else {
                    //一致しなかったところはそのまま書き込む
                    fwrite($fp, $str);
                }
            }
            fclose($fp);
        }
    }
        
        //削除機能
        if(isset($_POST["delete"]) && isset($_POST["del_password"])){
            $delete = $_POST["delete"];
            $del_password = $_POST["del_password"];
        }
        if(isset($_POST["delete"])) {
            $delete = $_POST["delete"];
            $file = "mission3-5.txt";
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            $fp = fopen($file, "w");
            for($i=0 ; $i<count($lines) ; $i++ ) {
                $line = explode("<>",$lines[$i]);
                $postnum = $line[0];
                if ($delDate[0] == $delete && $delDate[4] == $delete_password){
                    fwrite($fp, "");
                }
                else{
                    fwrite($fp, $lines[$i]);
                }
            }
            fclose($fp);
        }
        //編集機能
        if(isset($_POST["edit"]) && isset($_POST["edit_password"])){
            $edit = $_POST["edit"];
            $edit_password = $_POST["edit_password"];
        }
        if(isset($_POST["edit"])){
            $edit = $_POST["edit"];
            $editCon = file("mission3-5.txt");
            foreach($editCon as $str) {
                $line = explode("<>",$str);
                if($edit == $line[0]) {
                    $editnum = $line[0];
                    $editname = $line[1];
                    $editcomment = $line[2];
                }
            }
        }
    ?>
    
                
                
    <form method="post">
        <input type="text" name="name" placeholder="名前" value="<?php if(isset($editname)) {echo $editname;} ?>"><br>
        <input type="text" name="comment" placeholder="コメント" value="<?php if(isset($editcomment)) {echo $editcomment;} ?>"><br>
        <input type="text" name="postnumber" placeholder="投稿番号" value="<?php if(isset($editnum)) {echo $editnum;} ?>"><br>
        <input type="text" name="password" placeholder="パスワード" ><br>
        <input type="submit" name="submit"><br>
        
    </form><br>
    <form method="post">
        <input type="number" name = "delete" placeholder="削除番号"><br>
        <input type="text" name="del_password" placeholder="パスワード" ><br>
        <input type="submit" name="submit" value="削除"><br>
        
    </form><br>
    <form method="post">
        <input type="number" name = "edit" placeholder="編集番号"><br>
        <input type="text" name="edit_password" placeholder="パスワード" ><br>
        <input type="submit" name="submit" value="編集"><br>
        
    </form>
    
    
</body>
</html>