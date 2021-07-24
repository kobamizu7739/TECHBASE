<?php
	$dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = "CREATE TABLE IF NOT EXISTS post (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(32) NOT NULL,
		contents TEXT
	)";
	$stmt = $pdo->query($sql);
	$sql = 'SHOW TABLES';
	$stmt = $pdo->prepare("SELECT * FROM post");
	$stmt->execute();
?>


<!DOCTYPE html>
<meta charset="UTF-8">
<title>掲示板</title>
<h1>掲示板</h1>
<section>
    <h2>新規投稿</h2>
    <form action="m5-02.php" method="post">
        名前 : <input type="text" name="name" value=""><br>
        投稿内容: <input type="text" name="contents" value=""><br>
        <button type="submit">投稿</button>
    </form>
</section>
<section>
	<h2>投稿内容一覧</h2>
		<?php if ($stmt) foreach($stmt as $loop):?>
			<div>No：<?php echo $loop['id']?></div>
			<div>名前：<?php echo $loop['name']?></div>
			<div>投稿内容：<?php echo $loop['contents']?></div>
			<div>------------------------------------------</div>
		<?php endforeach;?>
</section>