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

            <form action="{{ route('store') }}" method="POST" novalidate>
                @csrf

                <div>
                    <!-- お名前 -->
                    <div class="form-group">
                        <label for="name">お名前<span class="label--required">※</span></label>

                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', session('contact_data.first_name')) }}" placeholder="例:山田" required>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', session('contact_data.last_name')) }}" placeholder="例:太郎" required>

                        @error('first_name')<span class="error">{{ $message }}</span>@enderror



                        @error('last_name')<span class="error">{{ $message }}</span>@enderror
                    </div>


                    <!-- 性別 -->
                    <div class="form-group">
                        <label for="gender">性別<span class="label--required">※</span></label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="gender" value="1" {{ old('gender', session('contact_data.gender')) == '1' || old('gender') == null ? 'checked' : '' }}> 男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2" {{ old('gender', session('contact_data.gender')) == '2' ? 'checked' : '' }}> 女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="3" {{ old('gender', session('contact_data.gender')) == '3' ? 'checked' : '' }}> その他
                            </label>
                        </div>
                        @error('gender')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- メールアドレス -->
                    <div class="form-group">
                        <label for="email">メールアドレス<span class="label--required">※</span></label>
                        <input type="email" name="email" value="{{ old('email', session('contact_data.email')) }}" placeholder="例:test@example.com" required>

                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- 電話番号 -->
                    <div class="form-group">
                        <label for="tel">電話番号<span class="label--required">※</span></label>
                        <div class="tel-group">
                            <input type="tel" name="tel1" value="{{ old('tel1', substr(session('contact_data.tel') ?? '', 0, 3)) }}" placeholder="090">
                            -
                            <input type="tel" name="tel2" value="{{ old('tel2', substr(session('contact_data.tel') ?? '', 3, 4)) }}" placeholder="1234">
                            -
                            <input type="tel" name="tel3" value="{{ old('tel3', substr(session('contact_data.tel') ?? '', 7, 4)) }}" placeholder="5678">
                        </div>
                        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                        <span class="error">電話番号を正しく入力してください。</span>
                        @endif
                    </div>

                    <!-- 住所 -->
                    <div class="form-group">
                        <label for="address">住所<span class="label--required">※</span></label>
                        <input type="address" name="address" value="{{ old('address', session('contact_data.address')) }}" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" required>
                        @error('address')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- 建物名 -->
                    <div class="form-group">
                        <label for="building">建物名</label>
                        <input type="building" name="building" value="{{ old('building', session('contact_data.building')) }}" placeholder="例:千駄ヶ谷マンション101">
                    </div>

                    <!-- お問い合わせの種類 -->
                    <div class="form-group">
                        <label for="category_id">お問い合わせの種類<span class="label--required">※</span></label>

                        <select name="category_id" required class="custom-select">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', session('contact_data.category_id')) == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                            @endforeach
                        </select>

                        @error('category_id')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <!-- お問い合わせ内容 -->
                    <div class="form-group">
                        <label for="detail">お問い合わせ内容<span class="label--required">※</span></label>
                        <textarea name="detail" placeholder="お問合せ内容をご記載ください" required>{{ old('detail', session('contact_data.detail')) }}</textarea>
                        @error('detail')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- 確認画面へ進むボタン -->
                    <button type="submit" class="btn btn-primary">確認画面へ</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>