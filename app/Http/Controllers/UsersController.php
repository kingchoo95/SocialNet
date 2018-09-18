<?php

namespace App\Http\Controllers;

use App\User;
use App\follower;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
       $users = User::where('users.id', '!=', Auth::user()->id)->get();
         $followers = Follower::where('user_id', Auth::user()->id)->get();
           
       
               //->join('followers', 'users.id', '=', 'fololowers.user_id')
               // ->select('users.*', 'id')
                
        /*
         
        foreach ($users as $user) {
            
             foreach($followers as $follower){

                if( $user->id == $follower->followers_id){
                        array_push($usersfollowing, $users);
                }


             }

        }

      //$userswithoutfollowing = array_diff($usersfollowing,$users);
        */






        return view('user',['users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $numfollowers = Follower::where('user_id',$user->id)->count();

        $follower = Follower::where
                ([
                    ['followers_id','=',Auth::user()->id
                ],
                [
                    'user_id','=',$user->id]
                ])->first();
        
        $user = User::where('id', $user->id)->first();
        //$user = User::find($user->id)->first();
       // return dd($user);
        return view('profile',['user' => $user,'numfollowers' => $numfollowers, 'follower'=>$follower]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        

        $user = User::where('id', $user->id)->first();
       
        return view('edit',['user' => $user]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        

                $userUpdate = User::where('id',$user->id)
                ->update([
                    'name' =>$request->input('name'),
                    'bio' =>$request->input('bio'),
                    'gender' =>$request->input('gender'),
                    'email' =>$request->input('email'),
                    'date_of_birth' =>$request->input('date_of_birth')
                    
                ]);

                if($userUpdate){
                    return redirect()->route('users.show',['user'=>$user->id])
                    ->with('success', 'Your Profile is updated!');
                }
                return back()->withInput();

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        
    }
}
