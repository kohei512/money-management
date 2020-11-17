<?php
// db_connect.phpの読み込み
require_once('db_connect.php');

$id = $_GET['id'];

if (empty($id)) {
    header("Location: main.php");
    exit; 
}
// PDOのインスタンスを取得 
$pdo = db_connect();
try {
    // SQL文の準備
    $sql = "DELETE FROM posts WHERE id = :id"; 
    // プリペアドステートメントの作成 
    $stmt = $pdo->prepare($sql);
    // idのバインド
    $stmt->bindParam('id', $id);
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