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
            <p>お名前: {{ $data['fullName'] }}</p>
        </div>

        <div>
            <p>性別:
                @switch($data['gender'])
                @case(1)
                男性
                @break
                @case(2)
                女性
                @break
                @case(3)
                その他
                @break
                @default
                不明
                @endswitch
            </p>
        </div>

        <div>
            <label>メールアドレス</label>
            <p>{{ $data['email'] }}</p>
            <input type="hidden" name="email" value="{{ $data['email'] }}">
        </div>

        <div>
            <label>電話番号</label>
            <p>{{ $data['tel'] }}</p>
            <input type="hidden" name="tel" value="{{ $data['tel'] }}">
        </div>

        <div>
            <label>住所</label>
            <p>{{ $data['address'] }}</p>
            <input type="hidden" name="address" value="{{ $data['address'] }}">
        </div>

        <div>
            <label for="building">建物名</label>
            <p>{{ $data['building'] ?? '未入力' }}</p> <!-- 確認画面で表示用 -->
            <input type="hidden" name="building" value="{{ $data['building'] ?? '' }}"> <!-- データ送信用 -->
        </div>

        <div>
            <label>お問い合わせの種類</label>
            <p>{{ $categoryName ?? '未選択' }}</p> <!-- 未選択の場合も表示 -->
            <input type="hidden" name="category_id" value="{{ $data['category_id'] ?? '' }}"> <!-- データ送信用 -->
        </div>

        <div>
            <label>お問い合わせ内容:</label>
            <p>{{ $data['detail'] }}</p>
            <input type="hidden" name="detail" value="{{ $data['detail'] }}">
        </div>

        <button type="submit">送信</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">修正</a>
    </form>

</body>

</html>