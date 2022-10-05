<?php

namespace App\Http\Controllers;

use App\Models\CardLike; //cardlikeを追記
use App\Models\Tag;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('profile/'.auth()->user()->id); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function store(Request $request)
    {
        // ディレクトリ名

          // アップロードされたファイル名を取得
          $file_name = $request->img->getClientOriginalName();

          // 取得したファイル名で保存
          $img =$request->img->storeAs('',$file_name,'public');

            // $img = $request->img->getRealPath();
            // $img = base64_encode(file_get_contents($img));


          // ファイル情報をDBに保存
          $user=User::where('id',auth()->user()->id);
          $user->update(['img'=> $img]);

        // $img = $request->img->getRealPath();
        // $img = base64_encode(file_get_contents($img));
        // User::insert([
        //     "img" => $img]);

            
        return redirect('/profile');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)
        //多田追記了

        ->first(); //Eager Loadの描き方

        return view('profile', [
            'user' => $user
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user); 
        return view('profile-edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) // ここも変わってる点注意！
    {
            
        $user->update([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'search_id' => $request->search_id,
            'email' => $request->email,
            'gender' => $request->gender,
            'age' => $request->age,
            'industry' => $request->industry
    ]);
        $this->authorize('update', $user); 
        return redirect()->route('profile.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
