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



    public function store(ContactFormRequest $request)
    {
        $data = $request->validated();
      
        // 性別デフォルト設定 (未選択時)
        if (empty($data['gender'])) {
            $data['gender'] = 1;  // デフォルトは "男性"
        }

        return redirect()->route('contact.confirm')->withInput($data);
    }

    public function confirm(Request $request)
    {
        $data = $request->old();

        // category_id からカテゴリ名を取得
        $category = Category::find($data['category_id']);
        $categoryName = $category ? $category->content : '未選択';

        // 性別変換 (1=男性, 2=女性, 3=その他)
        $genderLabels = ['1' => '男性', '2' => '女性', '3' => 'その他'];
        $data['gender'] = $genderLabels[$data['gender']] ?? '不明';

        return view('confirm', compact('categoryName', 'data'));
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

        // genderが文字列（例：女性）の場合、整数に変換
        $genderMap = [
            '男性' => 1,
            '女性' => 2,
            'その他' => 3,
        ];

        if (isset($data['gender']) && array_key_exists($data['gender'], $genderMap)) {
            $data['gender'] = $genderMap[$data['gender']];
        }
       
        
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
