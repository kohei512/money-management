<?php
// db_connect.phpの読み込み
require_once('db_connect.php');

session_start();

// PDOのインスタンスを取得
$pdo = db_connect();
try {
    // SQL文の準備
    $sql = "SELECT * FROM posts ORDER BY id ASC"; 
    // プリペアドステートメントの作成 
    $stmt = $pdo->prepare($sql); 
    // 実行
    $stmt->execute();
} catch (PDOException $e) { 
    // エラーメッセージの出力 
    echo 'Error: ' . $e->getMessage();
    // 終了
    die();
}
?>
    
</body>
</html>
<!doctype html> 
<html>
<head>
    <meta charset="UTF-8">
    <title>家計簿</title> 
    <link rel="stylesheet" href="sample.css">
</head>
<body>
    <div class="heading">
        <h2>家計簿</h2>
        <a href="create_post.php">追加!</a><br />
        </div>
    <table>
        <tr>
            <td>日付</td>
            <td>項目</td> 
            <td>収入/支出</td>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['time']; ?></td> 
                <td><?php echo $row['content']; ?></td> 
                <td><?php echo $row['income']; ?></td>
                <td><a href="delete_post.php?id=<?php echo $row['id']; ?>">削除</a></td>
            </tr>
        <?php } ?> 
    </table>
</body> 
</html>