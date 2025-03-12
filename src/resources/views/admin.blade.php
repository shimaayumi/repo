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



    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('admin.search') }}">
        <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
        <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}">
        <select name="gender">
            <option value="all">性別</option>
            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
            <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
        </select>
        <input type="text" name="inquiry_type" placeholder="お問い合わせ種類" value="{{ request('inquiry_type') }}">
        <input type="date" name="date" value="{{ request('date') }}">
        <button type="submit">検索</button>
        <button type="reset" onclick="this.form.reset();">リセット</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>お問い合わせ種類</th>
                <th>日付</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->inquiry_type }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <button data-toggle="modal" data-target="#userModal{{ $user->id }}">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    <!-- モーダルウィンドウ -->
    @foreach ($users as $user)
    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">詳細: {{ $user->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>名前: {{ $user->name }}</p>
                    <p>メールアドレス: {{ $user->email }}</p>
                    <p>性別: {{ $user->gender }}</p>
                    <p>お問い合わせ種類: {{ $user->inquiry_type }}</p>
                    <p>日付: {{ $user->created_at->format('Y-m-d') }}</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.delete', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>

                   
                    
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- 必要なJavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <a href="{{ route('admin.export') }}" class="btn btn-primary">エクスポート</a>
</body>

</html>