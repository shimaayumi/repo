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

    <main>
        <h2>Confirm</h2>

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <table>
                <tr>
                    <th>お名前</th>
                    
                    <td>{{$data['fullName']}}</td>
                    </td>
                </tr>

                <tr>
                    <th>性別</th>
                    <td>
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
                    </td>
                </tr>

                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $data['email'] }}</td>
                    <input type="hidden" name="email" value="{{ $data['email'] }}">
                </tr>

                <tr>
                    <th>電話番号</th>
                    <td>{{ $data['tel'] }}</td>
                    <input type="hidden" name="tel" value="{{ $data['tel'] }}">
                </tr>

                <tr>
                    <th>住所</th>
                    <td>{{ $data['address'] }}</td>
                    <input type="hidden" name="address" value="{{ $data['address'] }}">
                </tr>

                <tr>
                    <th>建物名</th>
                    <td>{{ $data['building'] ?? '未入力' }}</td>
                    <input type="hidden" name="building" value="{{ $data['building'] ?? '' }}">
                </tr>

                <tr>
                    <th>お問い合わせの種類</th>
                    <td>{{ $categoryName ?? '未選択' }}</td>
                    <input type="hidden" name="category_id" value="{{ $data['category_id'] ?? '' }}">

                </tr>

                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{{ $data['detail'] }}</td>
                    <input type="hidden" name="detail" value="{{ $data['detail'] }}">
                </tr>
            </table>

            <div>
                <button type="submit">送信</button>
                <a href="{{ route('index') }}" class="btn btn-secondary">修正</a>
            </div>
        </form>
    </main>
</body>

</html>