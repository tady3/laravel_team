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
 
    <div class="border-b-2 block md:flex">
  
      <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
  
        <div class="w-full p-8 mx-2 flex justify-center" style="position: relative;">
          
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ '/storage/' . $user['img']}}" alt="">
            @if($user->id === auth()->user()->id)
              <a href="/profile-upload">
                <div style="position: absolute; top: 75%;left: 60%; background-color: white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
              </a>
            @else <p></p>
            @endif
            
        </div>
      



          <form action="/profile/{{$user->id}}" method="POST">
            @csrf
            @method('PUT')


          <div class="mb-6">
            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account name</label>
            <input type="text" id="base-input" name="name" value="{{$user->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User name</label>
            <input type="text" id="base-input" name="nickname" value="{{$user->nickname}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">SearchID</label>
            <input type="text" id="base-input" name="search_id" value="{{$user->search_id}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
            <input type="text" id="base-input" name="email" value="{{$user->email}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gender</label>
            <select id="base-input" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="{{$user->gender}}"> @if($user->gender === 1)<p>Male</p>@elseif($user->gender === 2)
                  <p>Female</p>@else<p>Other</p>@endif</option>
                
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option>
              
            </select>

            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Age</label>
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

            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">industry</label>
            <input type="text" id="base-input" name="industry" value="{{$user->industry}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>

          @if($user->id === auth()->user()->id)
            <div class="row justify-content-center -mt-8">
              <button type="submit" class=" flex justify-content-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                update</button>
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
