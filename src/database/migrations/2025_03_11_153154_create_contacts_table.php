<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // 自動インクリメントの主キー
            $table->bigInteger('category_id')->unsigned(); // カテゴリID (外部キー)
            $table->string('first_name', 255); // 姓
            $table->string('last_name', 255); // 名
            $table->tinyInteger('gender'); // 性別
            $table->string('email', 255); // メールアドレス
            $table->string('tel', 255); // 1つの電話番号
            $table->string('address', 255); // 住所
            $table->string('building', 255)->nullable(); // 建物名（任意）
            $table->text('detail'); // お問い合わせ内容
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約を追加
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
