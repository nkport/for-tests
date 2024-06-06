<?php
/**
 * dbconn.php
 *
 * データベース接続
 *
 * @create 2024/01/18
 *
 **/

// テストモードON/OFF
$testmode = true;

if ($testmode == true) {
    $dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
    $user = 'root';
    $password = '';
} else {
    $dsn = 'mysql:dbname=transmitnk_db;host=localhost;charset=utf8mb4';
    $user = 'transmitnk_tmnk1';
    $password = 'Q9tslczYuVqI';
}
