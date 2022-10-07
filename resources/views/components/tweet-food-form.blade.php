@props (['tags'])
<form action="/tweets-form" method="POST" class="card card-body shadow-2 mb-3" enctype="multipart/form-data">

  @csrf  
  {{-- セキュリティトークンを発行するためのメソッド。トークンがない投稿はLaravel上では受け付けられない。 --}}
<div class="hidden">
    <textarea class="form-control" id="text-area" rows="1" name="card_type_id">2</textarea>
</div>
<div class="flex justify-content-center">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
  <img src="/img/icon.png" alt="" style="width: 40px;" class="mt-2 mb-2" style="margin :0,0,0,auto;">
</div>



<div class="mb-2">
    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 1.6rem; text-align: center ">「らしさ」を彩る「スキ」な食事 & 飲み物 🍽</p>
    
    <div class="form-outline">
        <textarea class="form-control" id="text-area" rows="1" name="message" placeholder="料理名: カルボナーラ">{{old('message')}}</textarea>
          <!-- 以下を追記 -->
            @error('message')
            <div class="form-helper text-danger">{{$message}}</div>
            @enderror
            <!-- 追記終了 -->
    </div>

        <!-- 多田追記 -->
    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

  
      
    <div class="form-outline">
        <textarea class="form-control" id="text-area" rows="1" name="source" placeholder="店/場所の名前  : ラ・ボエム">{{old('source')}}</textarea>
    </div>       

    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>


    <div class="form-outline">
      <textarea class="form-control" id="text-area" rows="1" name="location" placeholder="ロケーション  : 表参道">{{old('location')}}</textarea>
  </div>

        <!-- 多田追記終了 -->
</div>


   {{-- タグ付け用チェックボックス ここから --}}
   
<div class="mb-2" >
    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;"> </p>
    
    <div class="form-outline mb-2">
        @foreach($tags as $tag)
        <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tag-checkbox{{$tag->id}}" name="tags[]" value="{{$tag->id}}" />
                <label class="form-check-label" for="tag-checkbox2">{{$tag->name}}</label>
        </div>
        @endforeach
    </div>
</div>

{{-- タグ付け用チェックボックス ここまで --}}

{{-- <div class="form-outline mb-2">
  <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox"  name="category" value="内食" />
          <label class="form-check-label" for="tag-checkbox2">手作り</label>
  </div>
          <input class="form-check-input" type="checkbox"  name="category" value="外食" />          
          <label class="form-check-label" for="tag-checkbox2">外食</label>
          <input class="form-check-input" type="checkbox"  name="category" value="旅先" />
          <label class="form-check-label" for="tag-checkbox2">旅先</label>
          <input class="form-check-input" type="checkbox"  name="category" value="ラップアップ" />
          <label class="form-check-label" for="tag-checkbox2">ラップアップ</label>
          <input class="form-check-input" type="checkbox"  name="category" value="記念日" />
          <label class="form-check-label" for="tag-checkbox2">記念日</label>
  
</div> --}}


<!-- 多田追記 -->   
    <select id="" name="when" class="border border-gray-900 text-gray-500 text-medium rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <option disabled selected style="">スキになった時期</option>
        <option value="10歳未満">10歳未満</option>
        <option value="10代">10代</option>
        <option value="20代">20代</option>
        <option value="30代">30代</option> 
        <option value="40代">40代</option>
        <option value="50代">50代</option>
        <option value="60代">60代</option>
        <option value="70代">70代</option>
        <option value="80代以上">80代以上</option>
    </select>

    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
    <select id="" name="withwho" class="border border-gray-900 text-gray-500 text-medium rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <option disabled selected style="display:none;">誰と</option>
        <option value="一人で">一人で</option>
        <option value="友人・知人と">友人・知人と</option>
        <option value="家族と">家族と</option> 
        <option value="会合・集まり">会合・集まり</option>
    </select>

    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>


    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

    <label for="image">画像</label>
    <input type="file" class="form-control-file" name='img' id="img">
                
    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

    <div class="form-outline">
        <textarea class="form-control" id="text-area" rows="1" name="url" placeholder="リンク先URL ?">{{old('url')}}</textarea>
    </div>
            
    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
    <div class="form-outline">
        <textarea class="form-control" id="text-area" rows="2" name="story" placeholder="一言コメント">{{old('story')}}</textarea>
    </div>

    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
    <select id="" name="rate" class="">
        <option disabled selected style="display:none;">ジブン度 ★: 1〜5</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option> 
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

    <label for="default-toggle" class="inline-flex relative items-center cursor-pointer">
        <input type="checkbox" name="published" value="1" id="default-toggle" class="sr-only peer">
        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">公開</span>
    </label>

    



    <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

    <!-- 多田追記終了 -->

    <div class="row justify-content-center">
      <button type="submit" class=" flex justify-content-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        保存</button>
    </div>

</form>