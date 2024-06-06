<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
// MAMPを利用しているMacユーザーの方は、''ではなく'root'を代入してください
$password = '';

// idパラメータの値が存在すれば処理を行う
if (isset($_GET['id'])) {
    try {
        $pdo = new PDO($dsn, $user, $password);

        // idカラムの値をプレースホルダ（:id）に置き換えたSQL文をあらかじめ用意する
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $pdo->prepare($sql);

        // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        // SQL文を実行する
        $stmt->execute();

        // header()関数を使ってusers.phpにリダイレクトさせる
        header('Location: users.php');
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
} else {
    // idパラメータの値が存在しない場合はエラーメッセージを表示して処理を停止する
    exit('idパラメータの値が存在しません。');
}
