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
            <form action="{{ route('contact.store') }}" method="POST" novalidate>
                @csrf

                <div>
                    <!-- お名前（姓） -->
                    <div class="form-group">
                        <label for="first_name">お名前（姓）</label>
                        <span class="label--required">※</span>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', session('contact_data.first_name')) }}" placeholder="例:山田" required>
                        @error('first_name')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- お名前（名） -->
                    <div class="form-group">
                        <label for="last_name">お名前（名）</label>
                        <span class="label--required">※</span>
                        <input type="text" name="last_name" value="{{ old('last_name', session('contact_data.last_name')) }}" placeholder="例:太郎" required>
                        @error('last_name')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- 性別 -->
                    <div class="form-group">
                        <label for="gender">性別</label>
                        <span class="label--required">※</span>
                        <label>
                            <input type="radio" name="gender" value="1" {{ old('gender', session('contact_data.gender')) == '1' ? 'checked' : '' }}> 男性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="2" {{ old('gender', session('contact_data.gender')) == '2' ? 'checked' : '' }}> 女性
                        </label>
                        <label>
                            <input type="radio" name="gender" value="3" {{ old('gender', session('contact_data.gender')) == '3' ? 'checked' : '' }}> その他
                        </label>
                        @error('gender')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- メールアドレス -->
                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <span class="label--required">※</span>
                        <input type="email" name="email" value="{{ old('email', session('contact_data.email')) }}" placeholder="例:test@example.com" required>
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="tel">電話番号</label>
                        <span class="label--required">※</span>
                        <div>
                            <input type="tel" name="tel1" value="{{ old('tel1', substr(session('contact_data.tel') ?? '', 0, 3)) }}" placeholder="090" maxlength="3" style="width: 60px;">
                            -
                            <input type="tel" name="tel2" value="{{ old('tel2', substr(session('contact_data.tel') ?? '', 3, 4)) }}" placeholder="1234" maxlength="4" style="width: 80px;">
                            -
                            <input type="tel" name="tel3" value="{{ old('tel3', substr(session('contact_data.tel') ?? '', 7, 4)) }}" placeholder="5678" maxlength="4" style="width: 80px;">
                        </div>
                        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                        <span class="error">電話番号を正しく入力してください。</span>
                        @endif
                    </div>

                    <!-- 住所 -->
                    <div class="form-group">
                        <label for="address">住所</label>
                        <span class="label--required">※</span>
                        <input type="text" name="address" value="{{ old('address', session('contact_data.address')) }}" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" required>
                        @error('address')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <!-- 建物名 -->
                    <div class="form-group">
                        <label for="building">建物名</label>
                        <input type="text" name="building" value="{{ old('building', session('contact_data.building')) }}" placeholder="例:千駄ヶ谷マンション101">
                    </div>

                    <!-- お問い合わせの種類 -->
                    <div class="form-group">
                        <label for="category_id">お問い合わせの種類</label>
                        <span class="label--required">※</span>
                        <select name="category_id" required>
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
                        <label for="detail">お問い合わせ内容</label>
                        <span class="label--required">※</span>
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