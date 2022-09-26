<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_id = Auth::User()->id;

        $friendsfrom = Friend::with('user')
        ->where([
            ['user_id_from', $user_id],
            ['status', 2]
            ])
        ->orderBy('created_at', 'desc')
        ->get();

        $friendsto = Friend::with('user')
        ->where([
            ['user_id_to', $user_id],
            ['status', 2]
            ])
        ->orderBy('created_at', 'desc')
        ->get();



        $friendsgo = Friend::with('user')
            ->where([
                ['user_id_from', $user_id],
                ['status', 1]
                ])
            ->orderBy('created_at', 'desc')
            ->get();


        $friendscome = Friend::with('user')
            ->where([
                ['user_id_to', $user_id],
                ['status', 1]
                ])
            ->orderBy('created_at', 'desc')
            ->get();


        return view('friend-index', compact('friendsfrom','friendsto','friendsgo','friendscome'));
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
        $friend = Friend::create([
            
            'user_id_from' => auth()->user()->id,  
            'user_id_to' => $request['user_id_to'],
            'status' => $request['status']
        ]); 
                
        return redirect()->route('friend.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        // dd($request);

        $friend = Friend::with('user');//user_id_to,user_id_fromと連携させるのに必要？
        $friend = Friend::find($request->id);//updateするfriendを特定するためにidが必要
        $friend->update([
            'status' => $request->status,
    ]);



    return redirect()->route('friend.index');
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


    public function search(Request $request)
    {
        // キーワードを取得   
        $keyword = $request->keyword;

        //         // dd($keyword);
        $user_id = Auth::User()->id;    //ログインしているユーザーのユーザーIDを取得

        $friendsfrom = Friend::with('user')
        ->where([
            ['user_id_from', $user_id]
            ])->get();                  //  user_id_fromにログインユーザーIDが入っているデータを全て配列として取得
        
        foreach($friendsfrom as $friendfrom)
        {
        $test1 = User::find($friendfrom->user_id_to)->search_id;
        // dd($test);
    
        if ( $keyword == $test1 ) {die('すでに友達リストに存在します');}   
        else
        {
            $friendsto = Friend::with('user')
            ->where([
                ['user_id_to', $user_id]
                ])
                ->get();


            foreach($friendsto as $friendto)
            {
            $test2 = User::find($friendto->user_id_from)->search_id;
                // dd($test);
                if ( $keyword == $test2 ) {die('すでに友達リストに存在します');}   
                else
                {
                    break 2;            //２重のforeachを抜けている
                }
            }
        }
    }

    $users = User::where('search_id', 'LIKE', $keyword)
    ->get();

    // dd($users);

    return view('/friend-search', [
    'users' => $users,
    'keyword' => $keyword
    ]);
    }
}
        
        
       
    



