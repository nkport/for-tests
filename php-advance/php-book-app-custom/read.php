<?php
require_once './dbconn.php';

try {
    $pdo = new PDO($dsn, $user, $password);

    // 並び替えボタンを押したとき変数$orderに代入する
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = NULL;
    }

    // 並び替えボタンを押したとき変数$valueに代入する
    if (isset($_GET['value'])) {
        $value = $_GET['value'];
    } else {
        $value = NULL;
    }

    // キーワード検索
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    } else {
        $keyword = NULL;
    }

    $sql = 'SELECT * FROM books WHERE book_name LIKE :keyword ';

    // where 条件用 初期化
    $orderby = '';

    // orderパラメータの値によってSQL文を変更する
    // if ($order === 'asc') {
    //     $orderby = 'ORDER BY id ASC';
    // } else {
    //     $orderby = 'ORDER BY id DESC';
    // }

    switch ($order) {
        case "id":
            if ($value === 'asc') {
                $orderby = 'ORDER BY id ASC';
            } else {
                $orderby = 'ORDER BY id DESC';
            }
            break;
        case "book_code":
            if ($value === 'asc') {
                $orderby = 'ORDER BY book_code ASC';
            } else {
                $orderby = 'ORDER BY book_code DESC';
            }
            break;
        case "book_name":
            if ($value === 'asc') {
                $orderby = 'ORDER BY book_name ASC';
            } else {
                $orderby = 'ORDER BY book_name DESC';
            }
            break;
        case "price":
            if ($value === 'asc') {
                $orderby = 'ORDER BY price ASC';
            } else {
                $orderby = 'ORDER BY price DESC';
            }
            break;
        case "tax_price":
            if ($value === 'asc') {
                $orderby = 'ORDER BY price ASC';
            } else {
                $orderby = 'ORDER BY price DESC';
            }
            break;
        case "stock_quantity":
            if ($value === 'asc') {
                $orderby = 'ORDER BY stock_quantity ASC';
            } else {
                $orderby = 'ORDER BY stock_quantity DESC';
            }
            break;
        case "genre_code":
            if ($value === 'asc') {
                $orderby = 'ORDER BY genre_code ASC';
            } else {
                $orderby = 'ORDER BY genre_code DESC';
            }
            break;
    }

    $sql = $sql . $orderby;
    $stmt = $pdo->prepare($sql);

    $partial_match = "%{$keyword}%";
    $stmt->bindValue(':keyword', $partial_match, PDO::PARAM_STR);

    // 件数取得
    $id = "SELECT * FROM books";
    $sth = $pdo->query($id);
    $count = $sth->rowCount();

    // ページング
    $perPage = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;
    $query = "SELECT * FROM books LIMIT $perPage OFFSET $offset";


    // SQL文を実行
    $stmt->execute();

    // fetchAll()メソッドの戻り値
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
    <title>書籍管理アプリ</title>
    <link rel="stylesheet" href="css/style.css?20240121_3">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/21cb561351.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <a href="read.php">書籍管理アプリ</a>
            <form action="read.php" method="get" class="search-form">
                <input type="hidden" name="order" value="<?= $order ?>">
                <input type="text" class="search-box" placeholder="書籍名を検索" name="keyword" value="<?= $keyword ?>"
                    autocomplete="off">
                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                </button>
            </form>
        </nav>
    </header>
    <main>
        <article class="products">
            <?php
            // 登録・削除完了メッセージ
            if (isset($_GET['message'])) {
                echo "<p class='success'>{$_GET['message']}</p>";
            }
            ?>
            <div class="app-ui">
                <p class="data-count">
                    登録データ件数：全
                    <?= $count ?> 件
                </p>
                <button type="button" class="btn" onclick="location.href='create.php'">
                    <i class="fa-solid fa-circle-plus"></i> 書籍を登録
                </button>
            </div>
            <table class="products-table">
                <tr>
                    <th>
                        <a
                            href="read.php?order=id&value=<?= $order === 'id' && $value === 'asc' ? 'desc' : 'asc' ?>&keyword=<?= $keyword ?>">
                            登録順
                            <span class="sort-icon">
                                <?= $order === 'id' && $value === 'asc' ? '▲' : '▼' ?>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a
                            href="read.php?order=book_code&value=<?= $order === 'book_code' && $value === 'asc' ? 'desc' : 'asc' ?>&keyword=<?= $keyword ?>">
                            書籍コード
                            <span class="sort-icon">
                                <?= $order === 'book_code' && $value === 'asc' ? '▲' : '▼' ?>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a
                            href="read.php?order=book_name&value=<?= $order === 'book_name' && $value === 'asc' ? 'desc' : 'asc' ?>&keyword=<?= $keyword ?>">
                            書籍名
                            <span class="sort-icon">
                                <?= $order === 'book_name' && $value === 'asc' ? '▲' : '▼' ?>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a
                            href="read.php?order=price&value=<?= $order === 'price' && $value === 'asc' ? 'desc' : 'asc' ?>&keyword=<?= $keyword ?>">
                            価格
                            <span class="sort-icon">
                                <?= $order === 'price' && $value === 'asc' ? '▲' : '▼' ?>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a
                            href="read.php?order=stock_quantity&value=<?= $order === 'stock_quantity' && $value === 'asc' ? 'desc' : 'asc' ?>&keyword=<?= $keyword ?>">
                            在庫数
                            <span class="sort-icon">
                                <?= $order === 'stock_quantity' && $value === 'asc' ? '▲' : '▼' ?>
                            </span>
                        </a>
                    </th>
                    <th>
                        <a
                            href="read.php?order=genre_code&value=<?= $order === 'genre_code' && $value === 'asc' ? 'desc' : 'asc' ?>&keyword=<?= $keyword ?>">
                            ジャンルコード
                            <span class="sort-icon">
                                <?= $order === 'genre_code' && $value === 'asc' ? '▲' : '▼' ?>
                            </span>
                        </a>
                    </th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                <?php

                // 消費税 10% 計算用
                $tax = 1.10;

                foreach ($results as $result) {

                    /* DBから取得した単価に消費税を加算 */
                    $total = $result['price'] * $tax;

                    $table_row = "
                        <tr>
                        <td>{$result['id']}</td>
                        <td>{$result['book_code']}</td>
                        <td>{$result['book_name']}</td>
                        <td>
                        <strong>{$total}</strong><br>
                        <span style='font-size: .8rem;'>{$result['price']}</span>
                        </td>
                        <td>{$result['stock_quantity']}</td>
                        <td>{$result['genre_code']}</td>
                        <td><a href='update.php?id={$result['id']}'><img src='images/edit.png' alt='編集' class='edit-icon'></a></td>
                        <td><a href='delete.php?id={$result['id']}'><img src='images/delete.png' alt='削除' class='delete-icon'></a></td>
                        </tr>
                    ";
                    echo $table_row;
                }
                ?>
            </table>
        </article>
    </main>
    <footer>
        <p class="copyright">&copy; <a href="index.php">書籍管理アプリ</a> All rights reserved.</p>
    </footer>

    <script>
        // 削除確認アラート
        // https://detail.chiebukuro.yahoo.co.jp/qa/question_detail/q11267806746
        const deleteAlert = document.querySelectorAll('.delete-icon');
        for (let i = 0; i < deleteAlert.length; i++) {
            deleteAlert[i].addEventListener('click', (e) => {
                if (!confirm('本当に削除しますか？')) e.preventDefault();
            });
        }
    </script>

</body>

</html>