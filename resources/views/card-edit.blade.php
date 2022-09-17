<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">
                <form action="/tweets/{{$tweet->id}}" method="POST" class="card card-body shadow-2 mb-1" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-outline mb-2">
                        <textarea class="form-control" id="text-area" rows="1" name="message" placeholder="コトバを書く: ">{{ $tweet->message }}</textarea>
                        <label class="form-label" for="text-area">メッセージを入力</label>
                    </div>
                    
                    <!-- 多田追記 -->
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="1" name="bywho" placeholder="誰のコトバ ? :">{{ $tweet->bywho }}</textarea>
                        </div>

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="1" name="source" placeholder="コトバの出所 ? :">{{ $tweet->source }}</textarea>
                        </div>       
                    <!-- 多田追記終了 -->



                    <!-- タグづけ用 -->
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
                                />
                                <label class="form-check-label" for="tag-checkbox2">{{$tag->name}}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- 多田追記 -->
                        <select id="" name="when" class="">
                            <option value="{{ $tweet->when}}">
                                
                               @if(empty($tweet->when))<p>心に刺さった時期</p>@else<p>{{ $tweet->when }}</p>@endif</option>


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
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;"></p>
                        
                            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ '/storage/' . $tweet['img']}}" alt="">
                            <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">更新前画像　</p>


                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                            <input type="file" class="form-control-file" name='img' id="img" value="{{ $tweet->img}}">
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="1" name="url" placeholder="リンク先URL ?">{{ $tweet->url}}</textarea>
                        </div>
                            
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <div class="form-outline">
                            <textarea class="form-control" id="text-area" rows="2" name="story" placeholder="コトバへの思い/コメント">{{ $tweet->story}}</textarea>
                        </div>

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                        <select id="" name="rate" class="">
                            <option value="{{ $tweet->rate}}">  
                            @if(empty($tweet->rate))<p>推し度★: 1〜5</p>@else<p>{{ $tweet->rate }}</p>@endif</option>

                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option> 
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>

                        <label for="default-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" name="published" value="1" 
                            {{ old('published') == '1' ? 'checked' : '' }} id="default-toggle" class="sr-only peer">
                            
                            
                            
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">友達に公開</span>
                        </label>
                
                        <p class="mb-1 text-gray-400 font-weight-bold" style="font-size: 0.8rem;">　</p>
                

                    <!-- 多田追記終了 -->




                    <div class="d-flex gap-3">
                        <a href="/tweets-index" class="btn btn-dark btn-block shadow-0">キャンセル</a>
                        <button type="submit" class="btn btn-primary btn-block shadow-0 mt-0">更新</button>
                    </div>
                </form>
            </div>
        </div>
    <div class="container mt-4">
</x-app-layout>