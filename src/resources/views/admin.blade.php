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
            <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
            <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}">

            <!-- 性別選択 -->
            <select name="gender">
                <option value="">全て</option>
                <option value="1" {{ (int)request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ (int)request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ (int)request('gender') == 3 ? 'selected' : '' }}>その他</option>
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


            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->contacts->isNotEmpty())
                    @php $contact = $user->contacts->first(); @endphp
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
                    @else
                    未設定
                    @endif
                </td>
                <td>
                    @if($user->contacts->isNotEmpty())
                    {{ $user->contacts->first()->category->content }} <!-- 最初のcontactのcategoryのcontentを表示 -->
                    @else
                    未設定
                    @endif
                </td>

                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">
                        詳細
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    <!-- エクスポートボタン -->
    <a href="{{ route('admin.export') }}" class="btn btn-success">エクスポート</a>

    <!-- モーダルウィンドウ -->
    @foreach ($users as $user)
    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">詳細: {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <p>お名前 {{ $user->name }}</p>



                    @if($user->contacts->isNotEmpty())
                    @php $contact = $user->contacts->first(); @endphp
                    <p>性別
                        @if($contact->gender === 1)
                        男性
                        @elseif($contact->gender === 2)
                        女性
                        @elseif($contact->gender === 3)
                        その他
                        @else
                        未設定
                        @endif
                    </p>

                    <p>メールアドレス {{ $user->email }}</p>
                    <p>電話番号 {{ $contact->tel }}</p>
                    <p>住所 {{ $contact->address }}</p>
                    <p>建物名 {{ $contact->building_name }}</p>
                    <p>お問い合わせ種類 {{ $contact->inquiry_type }}</p>
                    <p>お問合せ内容 {{ $contact->inquiry_content }}</p>
                    @else
                    <p>連絡先情報がありません。</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.delete', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>

                    </form>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>