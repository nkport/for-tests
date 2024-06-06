<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel基礎</title>
</head>

<body>
    <h1>仕入先登録</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendors.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>仕入先コード</th>
                <td>
                    <input type="number" name="vendor_code">
                </td>
            </tr>
            <tr>
                <th>仕入先名</th>
                <td>
                    <input type="text" name="vendor_name">
                </td>
            </tr>
        </table>
        <input type="submit" value="登録">
    </form>
</body>

</html>
