<?php
// db_connect.phpの読み込み
require_once('db_connect.php');
// function.phpの読み込み
// 提出ボタンが押された場合
if (!empty($_POST)) {
    // titleとcontentの入力チェック 
    if (empty($_POST["time"])) {
        echo '日付が未入力です。'; 
    } elseif (empty($_POST["content"])) {
        echo 'コンテンツが未入力です。'; 
    } elseif (empty($_POST["income"])) {
        echo '日付が未入力です。';
    }
    if (!empty($_POST["time"]) && !empty($_POST["content"]) && !empty($_POST["income"])) {
        //エスケープ処理
        $time = htmlspecialchars($_POST["time"], ENT_QUOTES); 
        $content = htmlspecialchars($_POST["content"], ENT_QUOTES); 
        $income = htmlspecialchars($_POST["income"], ENT_QUOTES); 
        // PDOのインスタンスを取得 
        $pdo = db_connect();
        try {
            // SQL文の準備
            $sql = "INSERT INTO posts (time, content, income) VALUES (:time, :content, :income)";
            // プリペアドステートメントの準備 
            $stmt = $pdo->prepare($sql);
            // タイトルをバインド
            $stmt->bindParam(':time', $time);
            // 本文をバインド
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':income', $income);
            // 実行
            $stmt->execute();
            // main.phpにリダイレクト
            header("Location: main.php");
            exit;
        } catch (PDOException $e) { 
            // エラーメッセージの出力 
            echo 'Error: ' . $e->getMessage();
            // 終了
            die(); 
        }
    } 
}
?>
<!DOCTYPE html> <html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
</head>
<body>
    <h1>家計簿追加</h1>
    <form method="POST" action="">
        日付:<br>
        <input type="text" name="time" id="time" style="width:200px;height:50px;">
        <br>
        項目:<br>
        <input type="text" name="content" id="content" style="width:200px;height:50px;">
        <br>
        収入/支出:<br>
        <input type="text" name="income" id="income" style="width:200px;height:50px;">
        <br>
        <input type="submit" value="submit" id="post" name="post">
    </form> 
</body>
</html>