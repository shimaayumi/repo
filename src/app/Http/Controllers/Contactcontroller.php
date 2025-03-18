<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // 新規お問い合わせフォームの表示
    public function index()
    {
        // カテゴリーデータを取得
        $categories = Category::all();

        // セッションからデータを取得
        $contactData = session('contact_data', []); // セッションからデータを取得、なければ空配列を返す

        return view('index', [
            'first_name' => $contactData['first_name'] ?? '', // セッションにデータがあれば取得
            'last_name' => $contactData['last_name'] ?? '',
            'email' => $contactData['email'] ?? '',
            'tel' => $contactData['tel'] ?? '',
            'address' => $contactData['address'] ?? '',
            'categories' => $categories, // カテゴリーデータもビューに渡す
        ]);
    }

    public function store(ContactRequest $request)
    {
        // 3つの電話番号を結合
        $tel = $request->tel1 . $request->tel2 . $request->tel3;

        // 姓と名を結合してフルネームを作成
        $name = $request->first_name . ' ' . $request->last_name;

        // カテゴリー名を取得
        $categoryName = Category::find($request->category_id)->content ?? '未選択';

        // データを保存
        $contact = Contact::create([
            'category_id' => $request->category_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $tel, // 結合した電話番号を保存
            'address' => $request->address,
            'building' => $request->building,
            'detail' => $request->detail,
        ]);

        // セッションにデータを保存
        session([
            'contact_data' => [
                'first_name' => $request->first_name,   // first_name を保存
                'last_name' => $request->last_name,     // last_name を保存
                'fullName' => $name,                    // fullName を保存
                'tel' => $tel,
                'gender' => $request->gender,
                'email' => $request->email,
                'address' => $request->address,
                'building' => $request->building, // セッションに保存
                'category_id' => $request->category_id,
                'detail' => $request->detail,
            ]
        ]);


   
        // 確認画面にリダイレクト
        return redirect()->route('confirm');
    }

    public function confirm()
    {
        // セッションからデータを取得
        $data = session('contact_data');

        

        // カテゴリ名を取得
        $categoryName = Category::find($data['category_id'])->content ?? '不明';

        // ビューにデータを渡す
        return view('confirm', compact('data', 'categoryName'));
        
    }

    // 送信処理
    public function submit(Request $request)
    {
        // 送信完了画面へリダイレクト
        return redirect()->route('thanks');
    }

    // 送信完了画面を表示
    public function thanks()
    {

        // データが正常に保存された後、セッションデータを削除
        session()->forget('contact_data');
        return view('thanks');
    }

    // 検索機能
    public function search(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $results = $query->paginate(7);

        // ビューにresultsを渡す
        return view('admin.contacts', compact('results'));
    }


}
