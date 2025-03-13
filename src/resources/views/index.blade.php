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
                    <label for="name">お名前</label>
                    <span class="label--required">※</span>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例:山田" required>
                    @error('first_name')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>

                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例:太郎" required>
                    @error('last_name')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="gender">性別</label>
                    <span class="label--required">※</span>

                    <label>
                        <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他
                    </label>
                    @error('gender')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email">メールアドレス</label>
                    <span class="label--required">※</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例:test@example.com" required>
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="tel">電話番号</label>
                    <span class="label--required">※</span>
                    <div>
                        <input type="tel" name="tel1" value="{{ old('tel1') }}" placeholder="090" maxlength="3" style="width: 60px;">
                        -
                        <input type="tel" name="tel2" value="{{ old('tel2') }}" placeholder="1234" maxlength="4" style="width: 80px;">
                        -
                        <input type="tel" name="tel3" value="{{ old('tel3') }}" placeholder="5678" maxlength="4" style="width: 80px;">
                    </div>
                    @error('tel')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="address">住所</label>
                    <span class="label--required">※</span>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label for="building">建物名</label>
                    <input type="text" name="building" value="{{ old('building') }}" placeholder="例:千駄ヶ谷マンション101">
                  
                </div>


                <div>
                    <label for="category_id">お問い合わせの種類</label>
                    <span class="label--required">※</span>
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
                    <span class="label--required">※</span>
                    <textarea name="detail" placeholder="お問合せ内容をご記載ください" required>{{ old('detail') }}</textarea>
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