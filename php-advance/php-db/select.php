<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);

    // usersテーブルからidカラムとnameカラムのデータを取得するためのSQL文を変数$sqlに代入する
    $sql = 'SELECT id, name FROM users';

    // SQL文を実行する
    $stmt = $pdo->query($sql);

    // SQL文の実行結果を配列で取得する
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP+DB</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>氏名</th>
        </tr>
        <?php
        foreach ($results as $result) {
            echo "<tr><td>{$result['id']}</td><td>{$result['name']}</td></tr>";
        }
        ?>
    </table>
</body>

</html>