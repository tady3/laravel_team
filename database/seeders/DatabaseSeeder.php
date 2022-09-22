<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Middleware\TrustProxies;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // \App\Models\User::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // CardType 追記開始
				\App\Models\CardType::create([
                    'type' => 'コトバ'
                ]);
        
                \App\Models\CardType::create([
                    'type' => 'Food & Drinks'
                ]);
        
        // CardType追記終了




         // Tag 追記開始
				\App\Models\Tag::create([
                    'name' => '漫画'
                ]);
        
                \App\Models\Tag::create([
                    'name' => '本'
                ]);
        
                \App\Models\Tag::create([
                    'name' => '映画'
                ]);
                \App\Models\Tag::create([
                    'name' => '歌'
                ]);
                \App\Models\Tag::create([
                    'name' => 'web'
                ]);
                \App\Models\Tag::create([
                    'name' => '会話'
                ]);
                \App\Models\Tag::create([
                    'name' => '他'
                ]);
        // Tag追記終了


        // 追記開始 :User と　Tweet
                \App\Models\User::create([
                    'name' => 'tada',
                    'nickname' => 'tah3',
                    'search_id' => 'id_tah3',
                    'email' => 'test@example.com',
                    'password' => bcrypt('password'),
                    'gender' => 1,
                    'age' => 5,
                    'img' =>'IMG_6896.JPG'

                ]);

                \App\Models\User::create([
                    'name' => 'ぼやき太郎',
                    'nickname' => 'ボヤッキー',
                    'email' => 'boyaki@example.com',
                    'password' => bcrypt('password'),
                    'search_id' => 'boyaboya',
                    'gender' => 1,
                    'age' => 4,
                    'img' =>'スクリーンショット 2022-09-16 1.34.10.png'

                ]);

                \App\Models\User::create([
                    'name' => 'Enoki',
                    'nickname' => 'enoeno',
                    'email' => 'enoki@example.com',
                    'password' => bcrypt('password'),
                    'search_id' => 'enoki_id',
                    'gender' => 1,
                    'age' => 4,
                    'img' =>'IMG_2815.jpg'

                ]);
    




                
                \App\Models\Tweet::create([
                    'message' => 'よかった。病人はいねえのか。オレがダマされただけか。',
                    'user_id' => 1,
                    'bywho' => 'ドクターヒルルク',
                    'source' => 'ワンピース',
                    'url' => 'https://meigen-onepiece.com/0145-02/',
                    'when' => '20代',
                    'story' => '学生時代、合コンまでの時間潰しの漫喫で、ヒルルク辞世の語りに一人で涙止まらんくなった。以来、ワンピースにハマって20年以上、今では子供と一緒に読んでる (^^;;',
                    'rate' => 4,
                    'card_type_id' => 1
                    
                ]);

                \App\Models\Tweet::create([
                    'message' => 'ボチッとな',
                    'user_id' => 2,
                    'rate' => 3,
                    'card_type_id' => 1

                ]);

                // 追記終了



    }
}
