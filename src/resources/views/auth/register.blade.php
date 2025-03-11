<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('login') }}">Login</a>
        </nav>
    </header>

    <h1>ユーザー登録</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label for="name">お名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password">
            @error('password') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">登録</button>
    </form>
</body>

</html>