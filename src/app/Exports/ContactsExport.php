<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    protected $contacts;

    // コンストラクタでデータを受け取る
    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }

    // コレクションのデータを返す
    public function collection()
    {
        return $this->contacts->map(function ($contact) {
            return [
                '名前' => $contact->last_name . ' ' . $contact->first_name,
                'メールアドレス' => $contact->email,
                '性別' => $this->getGender($contact->gender),
                'カテゴリー' => $contact->category ? $contact->category->content : '未設定',
                '電話番号' => $contact->tel,
                '住所' => $contact->address,
                '建物名' => $contact->building,
                'お問合せ内容' => $contact->detail,
                '作成日' => $contact->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    // CSVのヘッダー行を設定
    public function headings(): array
    {
        return [
            '名前',
            'メールアドレス',
            '性別',
            'カテゴリー',
            '電話番号',
            '住所',
            '建物名',
            'お問合せ内容',
            '作成日'
        ];
    }

    // 性別を日本語で表示するためのヘルパーメソッド
    private function getGender($gender)
    {
        switch ($gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '未設定';
        }
    }
}
