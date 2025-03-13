<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // /admin ルート用のインデックスメソッド
    public function index(Request $request)
    {
        // 検索条件がなければ、全てのユーザーを取得
        $query = User::query();

        // 検索条件があれば、それに基づいて絞り込む
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', 'like', '%' . $request->inquiry_type . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', '=', $request->date);
        }

        // ユーザーのデータを取得し、ページネーションを適用
        $users = $query->paginate(7);

        // ビューにデータを渡す
        return view('admin', compact('users'));
    }
    public function search(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $genderValue = $request->gender == 'male' ? 0 : ($request->gender == 'female' ? 1 : 2);
            $query->whereHas('contacts', function ($q) use ($genderValue) {
                $q->where('gender', $genderValue);
            });
        }
        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', 'like', '%' . $request->inquiry_type . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', '=', $request->date);
        }

        // ページネーション
        $users = $query->paginate(7);

        return view('admin', compact('users'));
    }
}