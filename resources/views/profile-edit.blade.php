<!DOCTYPE html>
<html lang="en">

<x-app-layout>

  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile Edit</title>
  <link
  href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
  rel="stylesheet"
/>

</head>
<body>
  

<div class="h-full">
 
  
      <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
  
        <div class="w-full p-8 mx-2 flex justify-center" >
          @if(isset($user->img))
          <img id="showImage" class="max-w-xs w-32 items-center border" src="{{'/storage/'. $user['img']}}" alt="">
      @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>
      @endif
        </div>
      



          <form action="/profile/{{$user->id}}" method="POST">
            @csrf
            @method('PUT')


          <div class="mb-6">
            <label for="base-input" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">名前</label>
            <input type="text" id="base-input" name="name" value="{{$user->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">ユーザー名</label>
            <input type="text" id="base-input" name="nickname" value="{{$user->nickname}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">サーチID</label>
            <input type="text" id="base-input" name="search_id" value="{{$user->search_id}}" placeholder="友達検索用のIDを入力" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
            <input type="text" id="base-input" name="email" value="{{$user->email}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">性別</label>
            <select id="base-input" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="{{$user->gender}}"> @if($user->gender === 1)<p>男性</p>@elseif($user->gender === 2)
                  <p>女性</p>@else<p>設定なし</p>@endif</option>
                
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">設定なし</option>
              
            </select>

            <label for="base-input" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">年齢</label>
            <select  id="base-input" name="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
               <option value="{{$user->age}}">
                    @if($user->age === 1)<p>10歳未満</p>@endif
                    @if($user->age === 2)<p>10代</p>@endif
                    @if($user->age === 3)<p>20代</p>@endif
                    @if($user->age === 4)<p>30代</p>@endif
                    @if($user->age === 5)<p>40代</p>@endif
                    @if($user->age === 6)<p>50代</p>@endif
                    @if($user->age === 7)<p>60代</p>@endif
                    @if($user->age === 8)<p>70代</p>@endif
                    @if($user->age === 9)<p>80代以上</p>@endif
                </option>
                <option value="1">10歳未満</option>
                <option value="2">10代</option>
                <option value="3">20代</option>
                <option value="4">30代</option> 
                <option value="5">40代</option>
                <option value="6">50代</option>
                <option value="7">60代</option>
                <option value="8">70代</option>
                <option value="9">80代以上</option>
            </select>

            <label for="base-input" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">職種
            </label>
            <select  id="base-input" name="job" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
               <option value="{{$user->job}}">
                    @if($user->job === 0)<p>その他/該当なし</p>@endif
                    @if($user->job === 1)<p>学生</p>@endif
                    @if($user->job === 2)<p>ビジネスオペレーション</p>@endif
                    @if($user->job === 3)<p>ビジネスサービス</p>@endif
                    @if($user->job === 4)<p>セールス</p>@endif
                    @if($user->job === 5)<p>デザイン・クリエイター</p>@endif
                    @if($user->job === 6)<p>マーケティング</p>@endif
                    @if($user->job === 7)<p>エンジニア・技術職</p>@endif
                    @if($user->job === 8)<p>リーガル</p>@endif
                    @if($user->job === 9)<p>会計＆財務</p>@endif
                    @if($user->job === 10)<p>M&A_投資</p>@endif
                    @if($user->job === 11)<p>経営コンサル</p>@endif
                    @if($user->job === 12)<p>専門アドバイス</p>@endif
                    @if($user->job === 13)<p>事業開発</p>@endif
                    @if($user->job === 14)<p>経営企画</p>@endif
                    @if($user->job === 15)<p>事業マネジメント</p>@endif
                    @if($user->job === 16)<p>経営</p>@endif
                    @if($user->job === 17)<p>教師・コーチ</p>@endif
                    @if($user->job === 18)<p>研究職・公共サービス</p>@endif
                    @if($user->job === 19)<p>アスリート・アーティスト</p>@endif
                    @if($user->job === 20)<p>タレント・代議士</p>@endif


                </option>
                <option value="0">その他/該当なし</option> 
                <option value="1">学生</option>
                <option value="2">ビジネスオペレーション</option>
                <option value="3">ビジネスサービス</option>
                <option value="4">セールス</option>
                <option value="5">デザイン・クリエイター</option>
                <option value="6">マーケティング</option>
                <option value="7">エンジニア・技術職</option>
                <option value="8">リーガル</option>
                <option value="9">会計＆財務</option>
                <option value="10">M&A_投資</option>
                <option value="11">経営コンサル</option>
                <option value="12">専門アドバイス</option>
                <option value="13">事業開発</option>
                <option value="14">経営企画</option>
                <option value="15">事業マネジメント</option>
                <option value="16">経営</option>
                <option value="17">教師・コーチ</option>
                <option value="18">研究職・公共サービス</option>
                <option value="19">アスリート・アーティスト</option>
                <option value="20">タレント・代議士</option>
            </select>
                 
          </div>

          @if($user->id === auth()->user()->id)
            <div class="row justify-content-center -mt-8">
              <button type="submit" class=" flex justify-content-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                更新</button>
            </div>
          @else <p></p>
          @endif  

      </div>
    </form>
      



    </div>
   
  </div>




</x-app-layout>


</body>
</html>
