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
        Schema::create('tag_tweet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained();
            $table->foreignId('tweet_id')->constrained();
            $table->timestamps(); // タイムスタンプなくてもOK 今回は残しておきます
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_tweet');
    }
};
