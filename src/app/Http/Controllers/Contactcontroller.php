<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    // 一覧表示
    public function index()
    {
        $contacts = Contact::with(['category', 'user'])->get();
        return view('contacts.index', compact('contacts'));
    }

    // 入力フォームを表示
    public function create()
    {
        $categories = Category::all();
        return view('contact.create', compact('categories'));
    }

    // データを保存
    public function store(ContactFormRequest $request)
    {
        $data = $request->validated();
        session()->put('contact_data', $data);  // セッションにデータを保存
        return redirect()->route('contact.confirm');  // 確認画面にリダイレクト
    }

    // 確認画面を表示
    public function confirm()
    {
        $data = session('contact_data'); // セッションからデータを取得
        return view('contact.confirm', compact('data'));
    }

    // 送信処理
    public function submit(ContactFormRequest $request)
    {
        $data = session('contact_data'); // セッションからデータを取得
        Contact::create($data); // フォームデータを保存
        session()->forget('contact_data'); // セッションからデータを削除
        return redirect()->route('contact.thanks'); // 送信完了画面へリダイレクト
    }
}
