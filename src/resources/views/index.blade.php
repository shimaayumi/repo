<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
        <div class="FashionablyLate__content">
            <div class="FashionablyLate__heading">
                <h2>Contact</h2>
            </div>

            <!-- フォーム開始 -->
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div>
                    <label for="first_name">姓</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="last_name">名</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="gender">性別</label>

                    <label>
                        <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他
                    </label>
                    </select>
                    @error('gender')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="tel">電話番号</label>
                    <input type="tel" name="tel" value="{{ old('tel') }}">
                    @error('tel')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="address">住所</label>
                    <input type="text" name="address" value="{{ old('address') }}">
                    @error('address')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="category_id">お問い合わせの種類</label>
                    <select name="category_id" required>
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="detail">お問い合わせ内容</label>
                    <textarea name="detail" required>{{ old('detail') }}</textarea>
                    @error('detail')<span class="error">{{ $message }}</span>@enderror
                </div>

                <!-- 確認画面へ進むボタン -->
                <form action="{{ route('contact.submit') }}" method="POST">
                    <button type="submit">確認画面へ</button>
                </form>
        </div>
    </main>
</body>

</html>