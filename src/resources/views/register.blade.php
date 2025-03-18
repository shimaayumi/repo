<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
    <header>
        <header class="header">
            <div class="header__inner">
                <a class="header__logo" href="/">
                    FashionablyLate
                </a>
            </div>
            <nav>
                <a href="{{ route('login') }}">Login</a>
            </nav>
        </header>

    </header>
    <main>

        <div class="register-title">
            <h2>Register</h2>


            <div class="register-container">
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div>
                        <label for="name">お名前</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例 山田 太郎">
                        @error('name') <span>{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例 test@example.com">
                        @error('email') <span>{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password">パスワード</label>
                        <input type="password" name="password" id="password" placeholder="例 coachtech1106">
                        @error('password') <span>{{ $message }}</span> @enderror
                    </div>

                    <button type=" submit">登録</button>
                </form>
    </main>
</body>

</html>