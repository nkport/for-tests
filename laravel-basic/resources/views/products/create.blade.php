<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel基礎</title>
</head>

<body>
    <h1>商品登録</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <th>商品名</th>
                <td>
                    <input type="text" name="product_name">
                </td>
            </tr>
            <tr>
                <th>価格</th>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>
            <tr>
                <th>仕入先コード</th>
                <td>
                    <select name="vendor_code">
                        <option selected value="">選択してください</option>
                        @foreach ($vendor_codes as $vendor_code)
                            <option value="{{ $vendor_code }}">{{ $vendor_code }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>画像</th>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
        </table>
        <input type="submit" value="登録">
    </form>
</body>

</html>
