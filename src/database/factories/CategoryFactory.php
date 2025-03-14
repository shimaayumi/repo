<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // カテゴリーIDを1から5まで定義
        Category::create(['id' => 1, 'content' => '商品のお届けについて']);
        Category::create(['id' => 2, 'content' => '商品の交換について']);
        Category::create(['id' => 3, 'content' => '商品トラブル']);
        Category::create(['id' => 4, 'content' => 'ショップへのお問い合わせ']);
        Category::create(['id' => 5, 'content' => 'その他']);
    }
}