<x-app-layout>

<div class="container mt-4">
        <div class="row justify-content-center">
        <form method="GET" action="/friend-search">  
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg--50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="　search_idで友達候補を検索" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color:#252f5a">Search</button>
            </div>
        </form>
        </div>


        <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>
        <h1 class="font-weight-bold" style="font-size: 1.4rem;">友達</h1>
        <div class="flex flex-col">

            <div class="overflow-x-auto sm:-mx-6 lg:-mx-6">
            <div class="py-1 inline-block min-w-6 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                <table class="">
                    </thead>
                    
                    {{-- 自分から誘って友達になった人 --}}
                    <tbody>
                    @foreach ($friendsfrom as $friend)
                    <tr class="bg-white border-b">
                        
                            <td class="px-1 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <img class="w-10 h-10 rounded-full" src="{{ '/storage/' .  \App\Models\User::find($friend->user_id_to)->img }}" alt="avatar">
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <a href="/tweets-index/{{ \App\Models\User::find($friend->user_id_to)->id}}">
                                {{ \App\Models\User::find($friend->user_id_to)->nickname }}
                                </a>
                            </td>
                        
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            
                            <form action="/friend-index/{friend_id}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex space-x-2 justify-center">
                                    <input value="{{ $friend->id }}" type="hidden" name="id" />
                                    <input value="{{ auth()->user()->id}}" type="hidden" name="user_id_from" />
                                    <input type="text" class="hidden" name="status" value="3">
                                    <button
                                    type="submit"
                                    data-mdb-ripple="true"
                                    data-mdb-ripple-color="light"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style="background-color:#252f5a">
                                    削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <div>
                    </div>

                    {{-- 相手から誘われて友達になった人 --}}
                    @foreach ($friendsto as $friend)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="{{ '/storage/' .  \App\Models\User::find($friend->user_id_to)->img }}" alt="avatar">
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <a href="/tweets-index/{{ \App\Models\User::find($friend->user_id_from)->id}}">
                            {{ \App\Models\User::find($friend->user_id_from)->nickname }}
                            </a>
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            
                            <form action="/friend-index/{friend_id}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex space-x-2 justify-center">
                                    <input value="{{ $friend->id }}" type="hidden" name="id" />
                                    <input value="{{ auth()->user()->id}}" type="hidden" name="user_id_from" />
                                    <input type="text" class="hidden" name="status" value="3">
                                    <button
                                    type="submit"
                                    data-mdb-ripple="true"
                                    data-mdb-ripple-color="light"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style="background-color:#252f5a">
                                    削除</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>

         {{-- こちらが友達に誘っている人 --}}
        <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>
        <div><h1 class="font-weight-bold" style="font-size: 1.4rem;">{{ auth()->user()->nickname}}が誘っている人</h1>
        @foreach ($friendsgo as $friend)
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-6">
            <div class="py-1 inline-block min-w-6 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                <table class="">
                    <tbody>


                
                    <tr class="bg-white border-b">
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="{{ '/storage/' .  \App\Models\User::find($friend->user_id_to)->img }}" alt="avatar">
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{ \App\Models\User::find($friend->user_id_to)->nickname }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            
                            <form action="/friend-index/{friend_id}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex space-x-2 justify-center">
                                    <input value="{{ $friend->id }}" type="hidden" name="id" />
                                    <input value="{{ auth()->user()->id}}" type="hidden" name="user_id_from" />
                                    <input type="text" class="hidden" name="status" value="3">
                                    <button
                                    type="submit"
                                    data-mdb-ripple="true"
                                    data-mdb-ripple-color="light"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style="background-color:#252f5a">
                                    取消</button>
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

    <p class="font-weight-bold" style="font-size: 1.2rem;">　</p>
    <div><h1 class="font-weight-bold" style="font-size: 1.4rem;">{{ auth()->user()->nickname}}を誘っている人</h1>
        @foreach ($friendscome as $friend)

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-1 inline-block min-w-6 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                <table class="">

                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="{{ '/storage/' .  \App\Models\User::find($friend->user_id_from)->img }}" alt="avatar">
                        </td>
                        <td class=" text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap ">
                            {{ \App\Models\User::find($friend->user_id_from)->nickname }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <form action="/friend-index/{friend_id}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex space-x-2 justify-center">
                                    <input value="{{ $friend->id }}" type="hidden" name="id" />
                                    <input value="{{ auth()->user()->id}}" type="hidden" name="user_id_to" />
                                    <input type="text" class="hidden" name="status" value="2">
                                    <button
                                    type="submit"
                                    data-mdb-ripple="true"
                                    data-mdb-ripple-color="light"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    承認</button>
                                </div>
                            </form>
                        </td>

                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <form action="/friend-index/{friend_id}" method="POST">
                                @csrf
                                @method('PUT')  
                                <div class="flex space-x-2 justify-center">
                                    <input value="{{ $friend->id }}" type="hidden" name="id" />
                                    <input value="{{ auth()->user()->id}}" type="hidden" name="user_id_to" />
                                    <input type="text" class="hidden" name="status" value="3">

                                    <button
                                    type="submit"
                                    data-mdb-ripple="true"
                                    data-mdb-ripple-color="light"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style="background-color:#252f5a">
                                    拒否</button>
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




    </div>
</div>
</div>







</x-app-layout>