<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate - 検索結果</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <nav>
                <a href="{{ route('login') }}">logout</a>
            </nav>
        </div>
    </header>
    <main>
        <div class="login-title">
            <h2>Admin</h2>
        </div>
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
                    <option value="">お問い合わせの種類</option>
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

        <!-- エクスポートボタン -->
        <div class="pagination">
            <div class="export-pagination-container">
                <a href="{{ route('admin.export', request()->query()) }}" class="btn btn-success">エクスポート</a>
                <div class="pagination-container">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>


        <!-- 検索結果のテーブル -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>

                    <th>お問い合わせ種類</th>

                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>

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
                    <td>{{ $contact->email }}</td>
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





        <!-- モーダルウィンドウ -->
        @foreach ($contacts as $contact)
        <div class="modal fade" id="userModal{{ $contact->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $contact->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-row">
                            <div class="modal-label"><strong>お名前</strong></div>
                            <div class="modal-content">{{ $contact->last_name }} {{ $contact->first_name }}</div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>性別</strong></div>
                            <div class="modal-content">
                                @switch($contact->gender)
                                @case(1) 男性 @break
                                @case(2) 女性 @break
                                @case(3) その他 @break
                                @default 未設定
                                @endswitch
                            </div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>メールアドレス</strong></div>
                            <div class="modal-content">{{ $contact->email }}</div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>電話番号</strong></div>
                            <div class="modal-content">{{ $contact->tel }}</div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>住所</strong></div>
                            <div class="modal-content">{{ $contact->address }}</div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>建物名</strong></div>
                            <div class="modal-content">{{ $contact->building }}</div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>お問い合わせ種類</strong></div>
                            <div class="modal-content">
                                @if($contact->category)
                                {{ $contact->category->content }}
                                @else
                                未設定
                                @endif
                            </div>
                        </div>
                        <div class="modal-row">
                            <div class="modal-label"><strong>お問合せ内容</strong></div>
                            <div class="modal-content">{{ $contact->detail }}</div>
                        </div>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>