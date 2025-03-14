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
        // ユーザーと関連データ (contacts -> category) を一度に取得
        $query = User::with('contacts.category');

        // 検索条件があれば、その条件に応じて絞り込む
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        // 🔍 性別検索
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->whereHas('contacts', function ($q) use ($request) {
                $q->where('gender', (int)$request->gender); // genderをintにキャスト！
            });
        }
        // 🔍 お問い合わせ種類検索
        if ($request->filled('category_id')) {
            $query->whereHas('contacts', function ($q) use ($request) {
                // contacts テーブルの 'category_id' を使ってフィルタリング
                $q->where('category_id', $request->category_id);
            });
        }

          

            
        
        
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション
        $users = $query->paginate(7);

      

        // contacts変数をビューに渡す
        $contacts = Contact::all();

        // ビューにデータを渡す
        return view('admin', compact('users', 'contacts'));  // ここでcontactsもビューに渡す


    }
    // 検索処理
    public function search(Request $request) {
        return $this->index($request); // 検索も index の処理を使い回せる！
    }

}