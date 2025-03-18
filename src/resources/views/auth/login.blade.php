<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
        <nav>
            <a href="{{ route('register') }}">register</a>
        </nav>
    </header>

    <main>

        <div class="login-title">
            <h2>Login</h2>

            <div class="login-container">
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <!-- メールアドレス -->
                    <div>
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例 test@example.com">
                        @error('email')
                        <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- パスワード -->
                    <div>
                        <label for="password">パスワード</label>
                        <input type="password" name="password" id="password" placeholder="例 coachtech1106">
                        @error('password')
                        <span>{{ $message }}</span>
                        @enderror
                    </div>



                    <button type="submit">ログイン</button>
                </form>
            </div>
    </main>
</body>

</html>