<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PHP+DB</title>
</head>

<body>
    <p>
        <?php
        $dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
        $user = 'root';
        $password = '';

        try {
            //  データベースの接続を試行する
            $pdo = new PDO($dsn, $user, $password);

            // データベースの接続に成功した場合の処理
            echo 'データベースの接続に成功しました。';
        } catch (PDOException $e) {
            // データベースの接続に失敗した場合の処理
            exit('データベースの接続に失敗しました。' . $e->getMessage());
        }
        ?>
    </p>
</body>

</html>