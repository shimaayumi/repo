<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport; // ここでインポート


class AdminController extends Controller
{
    // /admin ルート用のインデックスメソッド
    public function index(Request $request)
    {
        // Contactモデルを基にクエリビルダーを構築
        $query = Contact::query()->with('category'); // contacts テーブルと category リレーションを一度に取得

        // 名前やメールアドレスで検索
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Contact テーブルの first_name と last_name を検索対象にする
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // 🔍 性別検索（全ての場合はフィルタしない）
        if ($request->filled('gender') && $request->gender !== '0') {
            $query->where('gender', $request->gender);
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

    public function destroy(Contact $contact)
    {
        // お問い合わせを削除
        $contact->delete();

        // 削除後に管理画面にリダイレクト
        return redirect()->route('admin')->with('success', 'お問い合わせが削除されました。');
    }

   




   
       public function export(Request $request)
    {
        // フォームから送信された検索条件を取得
        $search = $request->input('search');
        $gender = $request->input('gender');
        $category_id = $request->input('category_id');
        $date = $request->input('date');

        // データベースから条件に一致するデータを絞り込み
        $contacts = Contact::query();

        // 名前やメールアドレスによる検索
        if ($search) {
            $contacts->where(function($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 性別でフィルタリング
        if ($gender !== null) {
            $contacts->where('gender', $gender);
        }

        // カテゴリーでフィルタリング
        if ($category_id) {
            $contacts->where('category_id', $category_id);
        }

        // 日付でフィルタリング
        if ($date) {
            $contacts->whereDate('created_at', $date);
        }

        // 絞り込んだデータを取得
        $contacts = $contacts->get();

        // エクスポート
        return Excel::download(new ContactsExport($contacts), 'contacts.csv');
    }
}

 
   
