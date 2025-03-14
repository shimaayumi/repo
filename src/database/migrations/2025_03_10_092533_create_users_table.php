<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();

            $table->timestamp('email_verified_at')->nullable();  // ここでemail_verified_atを追加
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');  // usersテーブル全体を削除
    }
};
