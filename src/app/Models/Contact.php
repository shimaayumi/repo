<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // テーブル名を指定（デフォルトではモデル名の複数形がテーブル名になるが、明示的に指定する場合）
    protected $table = 'contacts';

    // マスアサインメント（大量割り当て）を許可する属性
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    // 日付を管理する属性（created_at, updated_at は自動的に管理されます）
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // キャスト（データ型変換）設定
    protected $casts = [
        'gender' => 'integer', // gender は整数として扱う
        'created_at' => 'datetime', // created_at は日付として扱う
        'updated_at' => 'datetime', // updated_at は日付として扱う
    ];

    // 外部キーの関連を定義する（categoriesテーブルとのリレーション）
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
