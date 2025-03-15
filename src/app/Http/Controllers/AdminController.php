<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // /admin ルート用のインデックスメソッド
    public function index(Request $request)
    {
        // Contactモデルを基にクエリビルダーを構築
        $query = Contact::query()->with('category'); // contacts テーブルと category リレーションを一度に取得

        // 検索条件があれば、その条件に応じて絞り込む
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        // 🔍 性別検索
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', (int) $request->gender); // genderをintにキャスト
        }
        // 🔍 お問い合わせ種類検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        // 🔍 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーションの結果を取得
        $contacts = $query->paginate(7);  // 7件ずつページネート

        // ビューにデータを渡す
        return view('admin', compact('contacts'));  // contacts 変数をビューに渡す
    }

    // 検索処理
    public function search(Request $request)
    {
        return $this->index($request); // 検索も index の処理を使い回せる！
    }

    // ユーザー削除処理
    public function destroy(User $user)
    {
        // ユーザー削除
        $user->delete();

        // 削除後に管理画面にリダイレクト
        return redirect()->route('admin')->with('success', 'ユーザーが削除されました。');
    }
}