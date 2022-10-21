<x-app-layout>
  <div class="container mt-4">    
      <div class="row justify-content-center">
          <div class="col-12 col-sm-12 col-md-10 col-lg-8">
              
              @if($users->count() === 0)
                  <p>検索結果がありませんでした</p>
              @else
              {{-- friendsテーブルのステータス1,2,3にfrom-toのいずれかに自分と相手の組み合わせがある場合は出てこなくしたい --}}
                  @foreach($users as $user)

                  <div class="flex flex-col">
                      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                          <div class="overflow-hidden">
                            <table class="min-w-full">
                              <thead class="border-b hidden">
                                <tr>
                                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  </th>
                                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  </th>
                                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  </th>
                                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                  </th>
                                </tr>
                              </thead>
                              <tbody>

                                <tr class="bg-white border-b">
                                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                      <img class="w-10 h-10 rounded-full" src="{{ '/storage/' . $user->img}}" alt="avatar">
                                  </td>
                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                      {{ $user->nickname }}
                                  </td>
                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                      @if($user->gender === 1)<span>男性</span>@elseif($user->gender === 2)<span>女性</span>@else<span>指定なし</span>@endif
                                      ：@if($user->age === 1)<span>10歳未満</span>@endif
                                      @if($user->age === 2)<span>10代</span>@endif
                                      @if($user->age === 3)<span>20代</span>@endif
                                      @if($user->age === 4)<span>30代</span>@endif
                                      @if($user->age === 5)<span>40代</span>@endif
                                      @if($user->age === 6)<span>50代</span>@endif
                                      @if($user->age === 7)<span>60代</span>@endif
                                      @if($user->age === 8)<span>70代</span>@endif
                                      @if($user->age === 9)<span>80代以上</span>@endif
                                      ： <span class=" text-sm">@if($user->job === 0)その他/該当なし@endif
                                        @if($user->job === 1)学生@endif
                                        @if($user->job === 2)ビジネスオペレーション@endif
                                        @if($user->job === 3)ビジネスサービス@endif
                                        @if($user->job === 4)セールス@endif
                                        @if($user->job === 5)デザイン・クリエイター@endif
                                        @if($user->job === 6)マーケティング@endif
                                        @if($user->job === 7)エンジニア・技術職@endif
                                        @if($user->job === 8)リーガル@endif
                                        @if($user->job === 9)会計＆財務@endif
                                        @if($user->job === 10)M&A_投資@endif
                                        @if($user->job === 11)経営コンサル@endif
                                        @if($user->job === 12)専門アドバイス@endif
                                        @if($user->job === 13)事業開発@endif
                                        @if($user->job === 14)経営企画@endif
                                        @if($user->job === 15)事業マネジメント@endif
                                        @if($user->job === 16)経営@endif
                                        @if($user->job === 17)教師・コーチ@endif
                                        @if($user->job === 18)研究職・公共サービス@endif
                                        @if($user->job === 19)アスリート・アーティスト@endif
                                        @if($user->job === 20)タレント・代議士@endif 
                                      </span>
                                    

                                  </td>
                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                      <form action="/friend-index" method="POST">
                                          @csrf  
                                      <div class="flex space-x-2 justify-center">
                                          <input type="text" class="hidden" name="user_id_to" value="{{ $user->id }}">
                                          <input type="text" class="hidden" name="status" value="1">
                                          <button
                                            type="submit"
                                            data-mdb-ripple="true"
                                            data-mdb-ripple-color="light"
                                            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                            友達になる</button>
                                        </div>
                                      </form>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  @endforeach
              @endif
          </div>
      </div>
  </div>
</x-app-layout>