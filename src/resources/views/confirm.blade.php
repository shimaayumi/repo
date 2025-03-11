<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>

    <div class="container">
        <h2>確認画面</h2>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <!-- 姓 -->
            <div class="form-group">
                <label for="first_name">姓</label>
                <p>{{ $data['first_name'] }}</p>
            </div>

            <!-- 名 -->
            <div class="form-group">
                <label for="last_name">名</label>
                <p>{{ $data['last_name'] }}</p>
            </div>

            <!-- 性別 -->
            <div class="form-group">
                <label for="gender">性別</label>
                <p>
                    @if($data['gender'] == 'male')
                    男性
                    @elseif($data['gender'] == 'female')
                    女性
                    @else
                    その他
                    @endif
                </p>
            </div>

            <!-- メールアドレス -->
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <p>{{ $data['email'] }}</p>
            </div>

            <!-- 電話番号 -->
            <div class="form-group">
                <label for="tel">電話番号</label>
                <p>{{ $data['tel'] }}</p>
            </div>

            <!-- 住所 -->
            <div class="form-group">
                <label for="address">住所</label>
                <p>{{ $data['address'] }}</p>
            </div>

            <!-- お問い合わせの種類 -->
            <div class="form-group">
                <label for="category_id">お問い合わせの種類</label>
                <p>{{ $categories->find($data['category_id'])->content }}</p>
            </div>

            <!-- お問い合わせ内容 -->
            <div class="form-group">
                <label for="detail">お問い合わせ内容</label>
                <p>{{ $data['detail'] }}</p>
            </div>

            <!-- 送信ボタン -->
            <button type="submit" class="btn btn-primary">送信</button>

            <!-- 戻るボタン -->
            <a href="{{ route('contact.create') }}" class="btn btn-secondary">修正する</a>
        </form>
    </div>
</body>

</html>