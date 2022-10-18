<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">
                <form action="/tweets/{{$tweet->id}}" method="POST" class="card card-body shadow-2 mb-1" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-outline mb-2">
                        @if($tweet->card_type_id==1)
                            <textarea class="form-control" id="text-area" rows="1" name="message" placeholder=" ">{{ $tweet->message }}</textarea>
                            <label class="form-label" for="text-area">コトバを入力</label>
                        @elseif($tweet->card_type_id==2)
                            <textarea class="form-control" id="text-area" rows="1" name="message" placeholder=" ">{{ $tweet->message }}</textarea>
                            <label class="form-label" for="text-area">食事 or 飲み物</label>
                        @else
                            <textarea class="form-control" id="text-area" rows="1" name="message" placeholder=" ">{{ $tweet->message }}</textarea>
                            <label class="form-label" for="text-area">メディア</label>

                        @endif        
                    </div>
                    
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        

                    <div class="form-outline">
                        @if($tweet->card_type_id==1)
                            <div class="form-outline mb-2">
                                <textarea class="form-control" id="text-area" rows="1" name="bywho" placeholder="">{{ $tweet->bywho }}</textarea>
                                <label class="form-label" for="text-area">誰のコトバ？</label>
                            </div>
                        @elseif($tweet->card_type_id==3)
                        <div class="form-outline mb-2">
                            <textarea class="form-control" id="text-area" rows="1" name="bywho" placeholder="">{{ $tweet->bywho }}</textarea>
                            <label class="form-label" for="text-area">著者/制作者?</label>
                        </div>
                        @endif
                        

                        {{-- <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p> --}}

                        @if ($tweet->card_type_id==3)
                        @else
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="1" name="source" placeholder="">{{ $tweet->source }}</textarea>
                             @if($tweet->card_type_id==1)    
                                <label class="form-label" for="text-area">コトバの出所</label>
                            @elseif ($tweet->card_type_id==2)
                                <label class="form-label" for="text-area">店/場所の名前</label>
                            @endif
                        </div>
                        @endif

                        @if($tweet->card_type_id==2)
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>    
                        <div class="form-outline mb-2">
                            <textarea class="form-control" id="text-area" rows="1" name="location" placeholder="">{{ $tweet->location }}</textarea>
                            <label class="form-label" for="text-area">ロケーション？</label>
                        </div>
                        @else  
                        @endif
    
                    </div>       
                    <!-- 多田追記終了 -->



                    <!-- タグづけ用 -->
                    {{-- @if($tweet->card_type_id==1) --}}
                    <div class="form-outline mb-2">
                        @foreach($tags as $tag)
                            <div class="form-check form-check-inline">
                                <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="tag-checkbox{{$tag->id}}"
                                        name="tags[]"
                                        value="{{$tag->id}}"
                                        {{  (in_array($tag->id, $selectedTags)) ?'checked':'' }}
                                        {{-- チェックボックスをチェックさせて表示させる方法 --}}
                                />
                                <label class="form-check-label" for="tag-checkbox2">{{$tag->name}}</label>
                            </div>
                        @endforeach
                    </div>


                    <!-- 多田追記 -->
                        <select id="" name="when" class="border border-gray-900 text-gray-500 text-medium rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="{{ $tweet->when}}">
                               @if(empty($tweet->when))<p>スキになった時期</p>@else<p>{{ $tweet->when }}</p>@endif</option>
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

                        @if($tweet->card_type_id==2)
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <label class="form-label" for="">誰と</label>
                        <select id="" name="withwho" class="border border-gray-900 text-gray-500 text-medium rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option> @if(empty($tweet->withwho))<p>誰と</p>@else<p>{{ $tweet->withwho }}</p>@endif</option>
                            <option value="一人で">一人で</option>
                            <option value="友人・知人と">友人・知人と</option>
                            <option value="家族と">家族と</option> 
                            <option value="会合・集まり">会合・集まり</option>
                        </select>
                        @endif

                        @if($tweet->card_type_id==1||$tweet->card_type_id==2||$tweet->card_type_id==3)
                        <div class="mb-2">
                            <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">影響の種類</p>
                            @php
                                if(!empty($tweet->impact))
                                    {
                                    $impacts=explode(",", $tweet->impact);
                                foreach( $impacts as $impact ){
                                }
                                    }
                                else{
                                    $impact=("");
                                }
                                @endphp
                                現在の内容
                                <span class="badge badge-pill badge-primary">{{$impact}}</span>

                            <div class="form-outline mb-2">
                                <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="癒し/安心" />
                                        <label class="form-check-label" for="tag-checkbox2">癒し/安心</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="憧れ/目標" />
                                    <label class="form-check-label" for="tag-checkbox2">憧れ/目標</label>
                                </div>
                    
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="やる気/モチベ/心の支え" />
                                    <label class="form-check-label" for="tag-checkbox2">やる気/モチベ/心の支え</label>
                                </div>
                    
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="モノゴト捉え方＆考え方" />
                                    <label class="form-check-label" for="tag-checkbox2">モノゴト捉え方＆考え方</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="育児/家庭" />
                                    <label class="form-check-label" for="tag-checkbox2">育児/家庭</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="健康/若さ" />
                                    <label class="form-check-label" for="tag-checkbox2">健康/若さ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="人間関係/恋愛" />
                                    <label class="form-check-label" for="tag-checkbox2">人間関係/恋愛</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="スポーツ&トレーニング"" />
                                    <label class="form-check-label" for="tag-checkbox2">スポーツ&トレーニング"</label>
                                </div>
                                <br>
                    
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="就職/転職" />
                                    <label class="form-check-label" for="tag-checkbox2">就職/転職</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="進学/留学" />
                                    <label class="form-check-label" for="tag-checkbox2">進学/留学</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="impact" name="impact[]" value="スキルUP/資格" />
                                    <label class="form-check-label" for="tag-checkbox2">スキルUP/資格</label>
                                </div>
                            </div>
                        </div>
                        @endif

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;"></p>
                        
                            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ '/storage/' . $tweet['img']}}" alt="">
                            <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">更新前画像　</p>


                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                            <input type="file" class="form-control-file" name='img' id="img" value="{{ $tweet->img}}">
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="1" name="url" placeholder="?">{{ $tweet->url}}</textarea>
                            <label class="form-label" for="text-area">リンク先URL</label>
                        </div>
                            
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="3" name="story" placeholder="">{{ $tweet->story}}</textarea>
                            <label class="form-label" for="text-area">一言コメント</label>
                        </div>

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <select id="select" name="rate" class="border border-gray-900 text-gray-500 text-medium rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        
                            <option value="{{ $tweet->rate}}">  
                            @if(empty($tweet->rate))<p>★ジブン度: 1〜5</p>
                            @else<p>ジブン度：{{ $tweet->rate }}</p>@endif</option>
                           

                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option> 
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>


                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

                        <label for="default-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" 
                            {{-- publishedの値が1の時checkedを表示させる記述 --}}
                            {{ old('published', $tweet->published) === 1 ? 'checked' : '' }} 
                            name="published" value="1" 
                            id="default-toggle" class="sr-only peer">
                            
                        
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">公開</span>
                        </label>
                
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                

                    <!-- 多田追記終了 -->




                <div class="d-flex gap-3">
                    <a href="/tweets-index" class="btn btn-dark btn-block shadow-0 rounded-lg text-sm w-full  px-5 py-2.5">戻る</a>
                    
                        <button type="submit" class=" flex justify-content-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            更新</button>
                        </div>
                
                    
                    {{-- <button type="submit" class="btn btn-primary btn-block shadow-0 mt-0">更新</button> --}}

                    </div>
                 </form>
            </div>
        </div>
     </div>
</x-app-layout>