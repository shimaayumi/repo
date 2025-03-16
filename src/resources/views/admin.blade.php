<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate - 検索結果</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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
    <form method="GET" action="{{ route('admin') }}">
        <div class="search-form">

            <!-- 名前とメールアドレスを一つにまとめる -->
            <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" value="{{ request('search') }}">

            <select name="gender" class="form-control">
                <option value="">性別</option>
                <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id" class="form-control" id="category_id">
                <option value="">お問い合わせの種類を選択</option>
                <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>1.商品のお届けについて</option>
                <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>2.商品の交換について</option>
                <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>3.商品トラブル</option>
                <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>4.ショップへのお問い合わせ</option>
                <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>5.その他</option>
            </select>
            <input type="date" name="date" value="{{ request('date') }}">

            <button type="submit" class="btn btn-primary">検索</button>
            <button type="button" onclick="resetForm()" class="btn btn-secondary">リセット</button>
        </div>
    </form>

    <script>
        function resetForm() {
            // フォームをリセット
            document.querySelector('form').reset();

            // リセット後にURLを初期状態にリダイレクト
            window.location.href = "{{ route('admin') }}";
        }
    </script>

    <!-- 検索結果のテーブル -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>お問い合わせ種類</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                    @switch($contact->gender)
                    @case(1)
                    男性
                    @break
                    @case(2)
                    女性
                    @break
                    @case(3)
                    その他
                    @break
                    @default
                    未設定
                    @endswitch
                </td>
                <td>
                    @if($contact->category)
                    {{ $contact->category->content }} <!-- contactのcategoryのcontentを表示 -->
                    @else
                    未設定
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#userModal{{ $contact->id }}">
                        詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}

    <!-- エクスポートボタン -->
    <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-success">エクスポート</a>

    <!-- モーダルウィンドウ -->
    @foreach ($contacts as $contact)
    <div class="modal fade" id="userModal{{ $contact->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $contact->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel{{ $contact->id }}">詳細: {{ $contact->last_name }} {{ $contact->first_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <p>お名前: {{ $contact->last_name }} {{ $contact->first_name }}</p>
                    <p>性別:
                        @switch($contact->gender)
                        @case(1)
                        男性
                        @break
                        @case(2)
                        女性
                        @break
                        @case(3)
                        その他
                        @break
                        @default
                        未設定
                        @endswitch
                    </p>

                    <p>メールアドレス: {{ $contact->email }}</p>
                    <p>電話番号: {{ $contact->tel }}</p>
                    <p>住所: {{ $contact->address }}</p>
                    <p>建物名: {{ $contact->building }}</p>

                    @if($contact->category)
                    <p>お問い合わせ種類: {{ $contact->category->content }}</p>
                    @else
                    <p>お問い合わせ種類: 未設定</p>
                    @endif

                    <p>お問合せ内容: {{ $contact->detail }}</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.delete-contact', $contact->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>