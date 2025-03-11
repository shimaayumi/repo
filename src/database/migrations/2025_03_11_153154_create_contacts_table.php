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
            $table->id(); // 主キー

            // 外部キー

       

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // 基本情報
            $table->string('first_name');
            $table->string('last_name');
            
            $table->enum('gender', ['male', 'female'])->default('male'); // 性別
            $table->string('email');
            $table->string('tel');
            $table->string('address');
            $table->string('building')->nullable();
            $table->text('detail');

            // タイムスタンプ
            $table->timestamps();

            
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
