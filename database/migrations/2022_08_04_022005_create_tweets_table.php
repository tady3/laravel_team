<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id(); // Auto Increment の id カラムを作ってくれる
            $table->string('message'); // 追記部分 VARCHAR(255) が作成される
            $table->foreignId('user_id')->constrained();

            // <!-- 多田追記 -->

            // $table->foreignId('card_type_id')->nullable(); // 追記部分 VARCHAR(255) が作成される
            $table->string('bywho')->nullable(); // 追記部分 VARCHAR(255) が作成される
            $table->string('source')->nullable(); // 追記部分 VARCHAR(255) が作成される
            $table->string('when')->nullable(); // 追記部分 VARCHAR(255) が作成される
            $table->string('url')->nullable(); // 追記部分 VARCHAR(255) が作成される
            $table->string('story')->nullable(); // 追記部分 VARCHAR(255) が作成される
            $table->integer('rate')->nullable(); 
            $table->string('img')->nullable();
            $table->boolean('published')->nullable(); 
            $table->foreignId('card_type_id')->constrained(); 
            // <!-- 多田追記終了 -->
            $table->timestamps(); // created_at と updated_at カラムを作ってくれる

        });
    }


    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
