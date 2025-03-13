<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
</head>

<body>
    <h2>確認画面</h2>

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <div>
            <label>姓:</label>
            <p>{{ $data['first_name'] }}</p>
            <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
        </div>

        <div>
            <label>名:</label>
            <p>{{ $data['last_name'] }}</p>
            <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
        </div>

        <div>
            <label>性別:</label>
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <p>
                @if (old('gender') == '1')
                男性
                @elseif (old('gender') == '2')
                女性
                @elseif (old('gender') == '3')
                その他
                @else
                不明
                @endif
            </p>
        </div>

        <div>
            <label>メールアドレス:</label>
            <p>{{ $data['email'] }}</p>
            <input type="hidden" name="email" value="{{ $data['email'] }}">
        </div>

        <div>
            <label>電話番号:</label>
            <p>{{ $data['tel'] }}</p>
            <input type="hidden" name="tel" value="{{ $data['tel'] }}">
        </div>

        <div>
            <label>住所:</label>
            <p>{{ $data['address'] }}</p>
            <input type="hidden" name="address" value="{{ $data['address'] }}">
        </div>

        <div>
            <label>お問い合わせの種類:</label>
            <p>{{ $categoryName }}</p>
            <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
        </div>

        <div>
            <label>お問い合わせ内容:</label>
            <p>{{ $data['detail'] }}</p>
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">
        </div>

        <button type="submit">送信</button>
        <a href="{{ route('contact.index') }}">修正する</a>
    </form>

</body>

</html>