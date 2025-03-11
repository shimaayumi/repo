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
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps(); // created_at, updated_atカラムを追加
            $table->timestamp('email_verified_at')->nullable();
          
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
