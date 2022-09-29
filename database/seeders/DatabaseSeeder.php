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
                    'name' => '雑誌'
                ]);
                \App\Models\Tag::create([
                    'name' => '映画'
                ]);
                \App\Models\Tag::create([
                    'name' => 'TV'
                ]);
                \App\Models\Tag::create([
                    'name' => '歌'
                ]);
                \App\Models\Tag::create([
                    'name' => 'ネット'
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
                    'img' =>'スクリーンショット 2022-09-16 1.34.10.png',

                ]);

                \App\Models\User::create([
                    'name' => 'Enoki',
                    'nickname' => 'enoeno',
                    'email' => 'enoki@example.com',
                    'password' => bcrypt('password'),
                    'search_id' => 'enoki_id',
                    'gender' => 1,
                    'age' => 4,
                    'img' =>'IMG_2815.jpg',
                ]);

                \App\Models\User::create([
                    'name' => 'Shige',
                    'nickname' => 'oshige',
                    'email' => 'shige@example.com',
                    'password' => bcrypt('password'),
                    'search_id' => 'shige_id',
                    'gender' => 1,
                    'age' => 5,
                    'img' =>'horyu_yakisoba.jpeg'
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
                    'published'=>1,
                    'card_type_id' => 1,
                    'img' =>'スクリーンショット 2022-09-01 16.46.12.png',

                    
                    
                ]);

                \App\Models\Tweet::create([
                    'message' => '感情を捨てよ。',
                    'user_id' => 1,
                    'bywho' => '杉村太郎',
                    'source' => 'アツイコトバ',
                    'url' => 'https://www.amazon.co.jp/%E3%82%A2%E3%83%84%E3%82%A4%E3%82%B3%E3%83%88%E3%83%90-%E6%9D%89%E6%9D%91-%E5%A4%AA%E9%83%8E/dp/4806121207',
                    'when' => '20代',
                    'story' => '故・杉村太郎さんの著書「アツイコトバ」。その中で20代に一番刺さった言葉',
                    'rate' => 4,
                    'published'=>1,
                    'card_type_id' => 1,
                    
                ]);

                \App\Models\Tweet::create([
                    'message' => 'だんだんめん。',
                    'user_id' => 1,
                    'withwho' => 1,
                    'source' => 'はしご',
                    'location' => '新富町',
                    'url' => 'https://tabelog.com/imgview/original?id=r659603336304',
                    'when' => '30代',
                    'story' => '+ライス、餃子、ビールで最高の背徳感！！',
                    'rate' => 4,
                    'published'=>0,
                    'card_type_id' => 2,
                    'img' =>'hashigo_dandan 2022-07-25 150713.png',
                    
                ]);


                

                \App\Models\Tweet::create([
                    'message' => 'ポチッとな',
                    'user_id' => 2,
                    'bywho' => 'ボヤッキー',
                    'source' => 'ヤッターマン',
                    'rate' => 3,
                    'card_type_id' => 1,
                    'published'=>1,

                ]);


                \App\Models\Tweet::create([
                    'message' => 'やられてもやられてもなんでもなーいない',
                    'user_id' => 2,
                    'bywho' => 'ドロンボ一味',
                    'source' => 'ヤッターマン',
                    'rate' => 3,
                    'card_type_id' => 1,
                    'published'=>0,

                ]);


                // 追記終了



    }
}
