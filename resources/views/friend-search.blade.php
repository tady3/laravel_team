<x-app-layout>
    <div class="container mt-4">    
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8">
                
                @if($users->count() === 0)
                    <p>検索結果がありませんでした</p>
                @else
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
                                        @if($user->gender === 1)<span>Male</span>@elseif($user->gender === 2)<span>Female</span>@else<span>Other</span>@endif
                                        ：@if($user->age === 1)<span>10歳未満</span>@endif
                                        @if($user->age === 2)<span>10代</span>@endif
                                        @if($user->age === 3)<span>20代</span>@endif
                                        @if($user->age === 4)<span>30代</span>@endif
                                        @if($user->age === 5)<span>40代</span>@endif
                                        @if($user->age === 6)<span>50代</span>@endif
                                        @if($user->age === 7)<span>60代</span>@endif
                                        @if($user->age === 8)<span>70代</span>@endif
                                        @if($user->age === 9)<span>80代以上</span>@endif
                                        ： {{$user->industry}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <form action="">
                                        <div class="flex space-x-2 justify-center">
                                            <input type="text" class="hidden" name="user_id_from" value="{{auth()->user()->id}}">
                                            <input type="text" class="hidden" name="user_id_to" value="{{ $user->gender }}">
                                            <input type="text" class="hidden" name="status" value="1">
                                            <button
                                              type="submit"
                                              data-mdb-ripple="true"
                                              data-mdb-ripple-color="light"
                                              class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                            >友達になる</button>
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