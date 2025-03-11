<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('register') }}">register</a>
        </nav>
    </header>

    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- メールアドレス -->
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <!-- パスワード -->
            <div>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember"> ログイン状態を保持する
                </label>
            </div>

            <button type="submit">ログイン</button>
        </form>
    </div>
</body>

</html>