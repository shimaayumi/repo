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
            <form action="{{ url('contact/confirm') }}" method="POST">
                @csrf
                <div>
                    <label for="first_name">姓</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                    @error('first_name') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="last_name">名</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
                    @error('last_name') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="gender">性別</label>
                    <select name="gender" id="gender">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>男性</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>女性</option>
                    </select>
                    @error('gender') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}">
                    @error('email') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="tel">電話番号</label>
                    <input type="tel" name="tel" id="tel" value="{{ old('tel') }}">
                    @error('tel') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="address">住所</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                    @error('address') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="category_id">お問い合わせの種類</label>
                    <select name="category_id" id="category_id">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="detail">お問い合わせ内容</label>
                    <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
                    @error('detail') <span>{{ $message }}</span> @enderror
                </div>

                <button type="submit">確認画面</button>
            </form>
        </div>
    </main>

</body>

</html>