<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{
    // 入力フォームを表示
    public function index()
    {
        // カテゴリーデータを取得してビューに渡す
        $categories = Category::all();
        return view('index', compact('categories'));

   
    }

   

    // データをバリデーションして確認画面へ
    public function store(ContactFormRequest $request)
    {
        $data = $request->validated();  // 入力データをバリデーション

        // バリデーション済みデータをそのまま確認画面に渡す
        return redirect()->route('contact.confirm')->withInput($data);
    }

    // 確認画面を表示
    public function confirm(Request $request)
    {


        // 入力データをそのまま受け取る
        $data = $request->old();

        // フォームから送信された category_id を取得
        $categoryId = $data['category_id'];


        // category_id に対応するカテゴリ名を取得
        $category = Category::find($categoryId);

        // category_id に対応するカテゴリ名を取得
        
        $categoryName = $category->content;

      

        // ビューに渡す
        return view('confirm', [
            'categoryName' => $categoryName,
            'data' => $data,
        ]);
      

       


    }

    // 送信処理
    public function submit(Request $request)
    {
        // 確認画面からhiddenデータを受け取る
        $data = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'category_id',
            'detail'
        ]);
       
        // フォームデータを保存
        Contact::create($data);

        // 送信完了画面へリダイレクト
        return redirect()->route('contact.thanks');
    }

   

    // 送信完了画面を表示
    public function thanks()
    {
        return view('thanks');
    }

    // 検索機能
    public function search(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', 'like', '%' . $request->inquiry_type . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $results = $query->paginate(7);

        // ビューにresultsを渡す
        return view('admin.contacts', compact('results'));
    }

}
