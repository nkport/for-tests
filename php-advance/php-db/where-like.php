<?php
$dsn = 'mysql:dbname=php_db;host=localhost;charset=utf8mb4';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);

    // keywordパラメータの値が存在すれば（「検索」ボタンを押したとき）、その値を変数$keywordに代入する
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    } else {
        $keyword = NULL;
    }

    // 動的に変わる値をプレースホルダに置き換えたSELECT文をあらかじめ用意する
    $sql = 'SELECT name, furigana FROM users WHERE furigana LIKE :keyword';
    $stmt = $pdo->prepare($sql);

    // SQLのLIKE句で使うため、変数$keyword（検索ワード）の前後を%で囲む（部分一致）
    // 補足：partial match＝部分一致
    $partial_match = "%{$keyword}%";

    // bindValue()メソッドを使って実際の値をプレースホルダにバインドする（割り当てる）
    $stmt->bindValue(':keyword', $partial_match, PDO::PARAM_STR);

    // SQL文を実行する
    $stmt->execute();

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
    <form action="where-like.php" method="get" class="search-form">
        <input type="text" placeholder="ふりがなで検索" name="keyword">
        <input type="submit" value="検索">
    </form>
    <table>
        <tr>
            <th>氏名</th>
            <th>ふりがな</th>
        </tr>
        <?php
        foreach ($results as $result) {
            echo "<tr><td>{$result['name']}</td><td>{$result['furigana']}</td></tr>";
        }
        ?>
    </table>
</body>

</html>