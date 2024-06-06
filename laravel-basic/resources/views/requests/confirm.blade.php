<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel基礎</title>
</head>

<body>
    <h2>フォームの入力内容</h2>
    <table>
        <tr>
            <th>お名前</th>
            <td>{{ $user_name }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $user_email }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $user_gender }}</td>
        </tr>
        <tr>
            <th>お問い合わせ種別</th>
            <td>{{ $category }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $message }}</td>
        </tr>
    </table>

    <h2>その他のリクエスト情報</h2>
    <table>
        <tr>
            <th>HTTPリクエストメソッド</th>
            <td>{{ $method }}</td>
        </tr>
        <tr>
            <th>パス</th>
            <td>{{ $path }}</td>
        </tr>
        <tr>
            <th>URL</th>
            <td>{{ $url }}</td>
        </tr>
        <tr>
            <th>クライアントのIPアドレス</th>
            <td>{{ $ip }}</td>
        </tr>
    </table>
</body>

</html>
