<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel基礎</title>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $product->product_name }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <th>作成日時</th>
            <td>{{ $product->created_at }}</td>
        </tr>
        <tr>
            <th>更新日時</th>
            <td>{{ $product->updated_at }}</td>
        </tr>
        <tr>
            <th>画像</th>
            <td>
                <img src="{{ asset('/storage/products/' . $product->image_name) }}" alt="アップロードした画像ファイル">
            </td>
        </tr>
    </table>
</body>

</html>
